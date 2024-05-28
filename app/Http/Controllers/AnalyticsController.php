<?php


namespace App\Http\Controllers;

use App\Models\CalendarPlanting;
use App\Models\Expense;
use App\Models\Farm;
use App\Models\Harvest;
use App\Models\Barangay;
use App\Models\Farmer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\Auth;

class AnalyticsController extends Controller
{
    public function downloadPdf()
    {
        $data = $this->count();
        $userFirstName = Auth::user()->firstname;
        $userLastName = Auth::user()->lastname;
        $farmsDataResponse = $this->getFarmsData(request(), 1); // Replace 1 with the ID of the farm you want to retrieve data for

        $farmsData = json_decode($farmsDataResponse->getContent(), true); // Decode the JSON content into an associative array

        $pdf = new Fpdf();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        // Add Image above the title
        $pdf->Image('assets/images/plantifeedpics/center1.png', 10, 10, 70);
        $pdf->Ln();
        $pdf->SetY(40);
        // Title
        $pdf->Cell(0, 10, 'Users and Harvest Report', 0, 1, 'C');
        $pdf->Ln();

        // Add user's first name and last name
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'Prepared by: ' . $userFirstName . ' ' . $userLastName, 0, 1);
        $pdf->Cell(0, 10, 'Date: ' . date('Y-m-d'), 0, 1);
        $pdf->Ln();

        // General information
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'This report shows analytics for our farms.', 0, 1);

        // Check if the user's role is not 4
        if (Auth::user()->role_id != 4) {
            $pdf->Cell(
                0,
                10,
                $data['farmLeaderCount'] . ' farm leaders. ' .
                    $data['farmerCount'] . ' total farmers. ' .
                    $data['totalUserCount'] . ' users. ' .
                    $data['farmCount'] . ' farms accounted for.',
                0,
                1
            );
        }
        $pdf->Ln();

        // Monthly farm data
        foreach ($farmsData['monthlyData'] as $month => $data) {
            $pdf->SetFont('Arial', '', 12);
            if ($data['harvested'] > 0 || $data['destroyed'] > 0) {
                $pdf->SetFillColor(224, 224, 31); // Light blue background
                $pdf->Cell(0, 10, $month . ': Harvested ' . $data['harvested'] . ' units, destroyed ' . $data['destroyed'] . ' units.', 0, 1, '', true);
            } else {
                $pdf->Cell(0, 10, $month . ': No data available.', 0, 1);
            }
        }

        // Total harvested and destroyed units
        $pdf->Cell(0, 10, 'Total harvested units: ' . $farmsData['totalHarvested'] . '.', 0, 1);
        $pdf->Cell(0, 10, 'Total destroyed units: ' . $farmsData['totalDestroyed'] . '.', 0, 1);
        $pdf->Ln();

        // Set the header to indicate that the content is a PDF file
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="analytics.pdf"');

        // Output the PDF to the browser
        $pdf->Output('D');
    }

    public function getFarmsData(Request $request, $id)
    {
        $year = $request->has('year') ? $request->year : now()->year;

        if ($request->has('yearRange')) {
            // Handle the year range request for annual data
            return $this->getAnnualFarmsData($request, $id);
        }

        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $monthlyData = array_fill_keys($months, ['harvested' => 0, 'destroyed' => 0]);

        // Fetch the farm data for the selected year
        $farms = DB::table('createplantings')
            ->where('farm_id', $id)
            ->whereYear('start', $year)
            ->get();

        // Aggregate harvested and destroyed data for each month
        foreach ($farms as $farm) {
            $month = Carbon::parse($farm->start)->format('F');
            if (array_key_exists($month, $monthlyData)) {
                $monthlyData[$month]['harvested'] += $farm->harvested;
                $monthlyData[$month]['destroyed'] += $farm->destroyed;
            }
        }

        // Remove months with both harvested and destroyed values equal to zero
        $monthlyData = array_filter($monthlyData, function ($data) {
            return $data['harvested'] != 0 || $data['destroyed'] != 0;
        });

        // Sum the 'harvested' and 'destroyed' columns for the selected year
        $totalHarvested = array_sum(array_column($monthlyData, 'harvested'));
        $totalDestroyed = array_sum(array_column($monthlyData, 'destroyed'));

        return response()->json([
            'farms' => $farms,
            'totalHarvested' => $totalHarvested,
            'totalDestroyed' => $totalDestroyed,
            'monthlyData' => $monthlyData
        ]);
    }

    private function getAnnualFarmsData(Request $request, $id)
    {
        $startYear = 2024; // Adjust as necessary
        $endYear = 2028; // Adjust as necessary

        $annualData = [];

        // Fetch the farm data for the range of years
        $farms = DB::table('createplantings')
            ->where('farm_id', $id)
            ->whereBetween(DB::raw('YEAR(start)'), [$startYear, $endYear])
            ->get();

        // Aggregate harvested and destroyed data for each year
        foreach ($farms as $farm) {
            $year = Carbon::parse($farm->start)->year;
            if (!isset($annualData[$year])) {
                $annualData[$year] = ['harvested' => 0, 'destroyed' => 0];
            }
            $annualData[$year]['harvested'] += $farm->harvested;
            $annualData[$year]['destroyed'] += $farm->destroyed;
        }

        // Remove years with both harvested and destroyed values equal to zero
        $annualData = array_filter($annualData, function ($data) {
            return $data['harvested'] != 0 || $data['destroyed'] != 0;
        });

        return response()->json([
            'farms' => $farms,
            'annualData' => $annualData
        ]);
    }




    public function index()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $expensesData = collect();
        $plantingData = collect();
        $farmsData = collect();
        $barangayOptions = [];

        // Define barangayName and farmName variables
        $barangayName = null;
        $farmName = null;

        $totalHarvested = DB::table('createplantings')->where('status', 'Harvested')->sum('harvested');
        $totalDestroyed = DB::table('createplantings')->where('status', 'Withered')->sum('destroyed');
        $totalPlanted = DB::table('createplantings')->where('status', 'Planted')->sum('seed');
        // dd($totalHarvested);

        // Fetch the user's associated farm if the user is a farm leader (role_id == 3 or 4)
        if ($user) {
            if ($user->role_id == 3) {
                // If the user is a farm leader, fetch the farm associated with the farm leader
                $userFarm = Farm::where('farm_leader', $user->id)->first();
                if ($userFarm) {
                    $farmName = $userFarm->farm_name;
                }
            } elseif ($user->role_id == 4) {
                // If the user is a farmer, retrieve the farm associated with the farmer
                $farmer = Farmer::where('farmleader_id', $user->id)->first();
                if ($farmer && $farmer->farm) {
                    $farmName = $farmer->farm->farm_name;
                }
            }
        }
        // Fetch barangay options for dropdown
        $barangays = Barangay::all(['id', 'barangay_name'])->toArray();
        foreach ($barangays as $barangay) {
            $barangayOptions[] = [
                'value' => $barangay['id'],
                'text' => $barangay['barangay_name']
            ];
        }

        // Fetch other data based on user's role
        if ($user->role_id == 1 || $user->role_id == 2) {
            $plantingData = CalendarPlanting::all(['title', 'start', 'harvested', 'destroyed', 'start'])->toJson();
            $farmsData = Farm::with('barangays')->get()->toJson();
        } elseif ($user->role_id == 3 || $user->role_id == 4) {
            $farmsData = Farm::where('id', $user->id)->with('barangays')->get()->toJson();
            $farmleader = User::select('users.*', 'farms.id AS farm_id')
                ->leftJoin('farms', 'farms.farm_leader', '=', 'users.id')
                ->where('users.id', $user->id)
                ->first();

            if ($farmleader) {
                $plantingData = CalendarPlanting::where('farm_id', $farmleader->farm_id)
                    ->get(['title', 'start', 'harvested', 'destroyed'])
                    ->toJson();
            } else {
                $plantingData = collect()->toJson();
            }
        }

        $destroyedCrops = DB::table('createplantings')->where('status', 'Withered')->get();

        return view('pages.analytics', compact('destroyedCrops', 'totalHarvested', 'totalDestroyed', 'totalPlanted', 'plantingData', 'farmsData', 'barangayOptions', 'barangayName', 'farmName'));
    }


    public function getFarms($barangayName)
    {
        $farms = Farm::where('barangay_name', $barangayName)->get();

        return response()->json(['farms' => $farms]);
    }


    public function count()
    {
        $farmLeaderCount = User::where('role_id', 3)->count();
        $farmerCount = User::where('role_id', 4)->count();
        $totalUserCount = User::count();
        $farmCount = Farm::distinct()->count('id');

        return [
            'farmLeaderCount' => $farmLeaderCount,
            'farmerCount' => $farmerCount,
            'totalUserCount' => $totalUserCount,
            'farmCount' => $farmCount
        ];
    }

    public function harvestedCrops()
    {
        $topHarvestedCrops = DB::table('createplantings')
            ->select('title', DB::raw('SUM(harvested) AS total_harvested'))
            ->where('status', 'Harvested')
            ->groupBy('title')
            ->orderByDesc('total_harvested')
            ->limit(5)
            ->distinct()
            ->get();


        return response()->json(['topHarvestedCrops' => $topHarvestedCrops]);
    }

    public function witheredCrops()
    {
        $topDestroyedCrops = DB::table('createplantings')
            ->select('title', DB::raw('SUM(destroyed) AS total_destroyed'))
            ->where('status', 'Withered')
            ->groupBy('title')
            ->orderByDesc('total_destroyed')
            ->limit(5)
            ->distinct()
            ->get();

        return response()->json(['topDestroyedCrops' => $topDestroyedCrops]);
    }

    public function highestYield()
    {
        $farmWithHighestYield = DB::table('createplantings')
            ->select('createplantings.farm_id', 'farms.farm_name', DB::raw('SUM(createplantings.harvested) AS total_harvested'))
            ->leftJoin('farms', 'farms.id', '=', 'createplantings.farm_id')
            ->where('createplantings.status', 'Harvested')
            ->groupBy('createplantings.farm_id', 'farms.farm_name')
            ->orderByDesc('total_harvested')
            ->limit(5)
            ->get();


        //dd($farmWithHighestYield);

        return response()->json(['farmWithHighestYield' => $farmWithHighestYield]);
    }

    public function harvestingMetrics()
    {
        $query = "
    WITH RECURSIVE months AS (
        SELECT '2023-01-01' AS first_day
        UNION ALL
        SELECT DATE_ADD(first_day, INTERVAL 1 MONTH)
        FROM months
        WHERE first_day < '2024-12-01'
    )
    SELECT 
        YEAR(months.first_day) AS year, 
        MONTHNAME(months.first_day) AS month, 
        COALESCE(SUM(cp.harvested), 0) AS total_harvested,
        COALESCE(SUM(cp.destroyed), 0) AS total_destroyed
    FROM 
        months
    LEFT JOIN 
        createplantings cp 
        ON DATE_FORMAT(cp.end, '%Y-%m') = DATE_FORMAT(months.first_day, '%Y-%m')
        AND cp.status = 'Harvested'
    GROUP BY 
        YEAR(months.first_day), MONTHNAME(months.first_day)
    ORDER BY 
        year, FIELD(month, 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    ";

        $harvestingMetrics = DB::select(DB::raw($query));

        return response()->json(['harvestingMetrics' => $harvestingMetrics]);
    }
}
