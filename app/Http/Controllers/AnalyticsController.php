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
    public function downloadPdf() {
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
            $pdf->Cell(0, 10, 
                $data['farmLeaderCount'] . ' farm leaders. ' . 
                $data['farmerCount'] . ' total farmers. ' . 
                $data['totalUserCount'] . ' users. ' . 
                $data['farmCount'] . ' farms accounted for.', 0, 1);
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


    public function index()
    {
        $user = auth()->user();
        
        // Check if the user is authenticated
        if (!$user) {
            // Handle the case where the user is not authenticated
            // For example, redirect them to the login page
            return redirect()->route('login');
        }
        
        $expensesData = collect();
        $plantingData = collect();
        $farmsData = collect();
        $barangayOptions = [];
        
        // Define barangayName and farmName variables
        $barangayName = null;
        $farmName = null;
        
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
        
        return view('pages.analytics', compact('expensesData', 'plantingData', 'farmsData', 'barangayOptions', 'barangayName', 'farmName'));
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
}
