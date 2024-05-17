<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Farm;
use App\Models\SupplyType;
use App\Models\RequestN;
use App\Models\RemarkRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Codedge\Fpdf\Fpdf\Fpdf;

class ToolController extends Controller
{
    public function index()
    {
        // Fetch all requested statuses from the database
        $request_tbl = RequestN::with('requestedBy', 'farm', 'supplyTool', 'supplyTool1', 'supplyTool2', 'supplySeedling', 'supplySeedling1', 'supplySeedling2')
                        ->where('status', 'Requested')
                        ->orWhere('status', 'Unavailable')
                        ->get();
        $all_requests = RequestN::all();

        // Fetch tool requests
        $tool_requests = RequestN::whereNotNull('supply_tool')
            ->orWhereNotNull('supply_tool1')
            ->orWhereNotNull('supply_tool2')
            ->get();

        // Fetch seedling requests
        $seedling_requests = RequestN::whereNotNull('supply_seedling')
            ->orWhereNotNull('supply_seedling1')
            ->orWhereNotNull('supply_seedling2')
            ->get();

        // Fetch other types of requests
        $available_requests = $this->getAvailableRequests();
        $approval_requests = $this->getApprovalRequests();
        $disapproved_requests = $this->getDisapprovedRequests();
        $picked_requests = $this->getPickingRequests();
        $return_requests = $this->getReturnedRequests();

        // Pass all data to the view
        return view('pages.tools.request', compact(
            'request_tbl',
            'available_requests',
            'approval_requests',
            'disapproved_requests',
            'picked_requests',
            'return_requests',
            'all_requests',
            'tool_requests',
            'seedling_requests'
        ));
    }

    public function downloadPdf()
{
    // Retrieve all requests
    $all_requests = RequestN::with('requestedBy', 'supplyTool', 'supplyTool1', 'supplyTool2', 'supplySeedling', 'supplySeedling1', 'supplySeedling2')->get();
    
    // Retrieve the most common tool and seed requested
    $mostCommonTool = RequestN::select(DB::raw('COALESCE(supply_tool, supply_tool1, supply_tool2) AS tool'), DB::raw('SUM(COALESCE(count_tool, 0) + COALESCE(count_tool1, 0) + COALESCE(count_tool2, 0)) AS total_count'))
                        ->whereNotNull('supply_tool')
                        ->orWhereNotNull('supply_tool1')
                        ->orWhereNotNull('supply_tool2')
                        ->groupBy('tool')
                        ->orderByRaw('total_count DESC')
                        ->first();

    // Retrieve the most common seed requested
    $mostCommonSeed = RequestN::select(DB::raw('COALESCE(supply_seedling, supply_seedling1, supply_seedling2) AS seedling'), DB::raw('SUM(COALESCE(count_seedling, 0) + COALESCE(count_seedling1, 0) + COALESCE(count_seedling2, 0)) AS total_count'))
                        ->whereNotNull('supply_seedling')
                        ->orWhereNotNull('supply_seedling1')
                        ->orWhereNotNull('supply_seedling2')
                        ->groupBy('seedling')
                        ->orderByRaw('total_count DESC')
                        ->first();

    // Combine the most common tools from all fields
    $mostCommonTools = [$mostCommonTool];

    // Combine the most common seeds from all fields
    $mostCommonSeeds = [$mostCommonSeed];

    // Retrieve the names of the most common tools and seeds
    $mostCommonToolNames = $mostCommonTool ? SupplyType::whereIn('id', [$mostCommonTool->tool])->pluck('type')->implode(', ') : '';
    $mostCommonSeedNames = $mostCommonSeed ? SupplyType::whereIn('id', [$mostCommonSeed->seedling])->pluck('type')->implode(', ') : '';

    // Retrieve total counts for most common tools and seeds
    $mostCommonToolTotalCount = $mostCommonTool ? $mostCommonTool->total_count : 0;
    $mostCommonSeedTotalCount = $mostCommonSeed ? $mostCommonSeed->total_count : 0;

    // Other data
    $userFirstName = Auth::user()->firstname;
    $userLastName = Auth::user()->lastname;

    // Create PDF instance
    $pdf = new Fpdf();
    $pdf->AddPage('P'); // Portrait orientation
    $pdf->SetFont('Arial', 'B', 16);

    // Add Image above the title
    $imagePath = 'assets/images/plantifeedpics/center1.png';
    $imageWidth = 70;
    $pageWidth = $pdf->GetPageWidth();
    $x = ($pageWidth - $imageWidth) / 2;
    $pdf->Image($imagePath, $x, 10, $imageWidth);
    $pdf->Ln();
    $pdf->SetY(40);

    // Title
    $pdf->Cell(0, 10, 'Supply and Seed Requests Report', 0, 1, 'C');
    $pdf->Ln();

    // Add user's first name and last name
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Prepared by: ' . $userFirstName . ' ' . $userLastName, 0, 1);
    $pdf->Cell(0, 10, 'Date: ' . date('Y-m-d'), 0, 1);
    $pdf->Ln();

    // General information
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'This report shows all requests for tools and seeds.', 0, 1);
    $pdf->Ln();

    // Most common tool and seed
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Most Common Tool(s): ' . $mostCommonToolNames . ' (Total Requests: ' . $mostCommonToolTotalCount . ')', 0, 1);
    $pdf->Cell(0, 10, 'Most Common Seed(s): ' . $mostCommonSeedNames . ' (Total Requests: ' . $mostCommonSeedTotalCount . ')', 0, 1);
    $pdf->Ln();

    // Narrative content
    $pdf->SetFont('Arial', '', 12);
    foreach ($all_requests as $request) {
        $tools = $this->formatTools($request);
        $toolsQty = $this->formatToolQty($request);
        $seeds = $this->formatSeeds($request);
        $seedsQty = $this->formatSeedQty($request);
        $requestedBy = $request->requestedBy->firstname . ' ' . $request->requestedBy->lastname;
        $status = $request->status;
        $dateCreated = \Carbon\Carbon::parse($request->created_at)->format('Y-m-d H:i:s');

        $narrative = "Request ID {$request->id} was made by {$requestedBy} on {$dateCreated}. "
                    . "The request includes the following tools: {$tools} with quantities: {$toolsQty}. "
                    . "Additionally, the following seeds were requested: {$seeds} with quantities: {$seedsQty}. "
                    . "The current status of this request is {$status}.";

        $pdf->MultiCell(0, 10, $narrative);
        $pdf->Ln();
    }

    // Set the header to indicate that the content is a PDF file
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="requests_report.pdf"');

    // Output the PDF to the browser
    $pdf->Output('D');
}


    private function formatTools($request)
    {
        $tools = [];
        if ($request->supplyTool) $tools[] = $request->supplyTool->type;
        if ($request->supplyTool1) $tools[] = $request->supplyTool1->type;
        if ($request->supplyTool2) $tools[] = $request->supplyTool2->type;
        return implode(', ', $tools);
    }

    private function formatToolQty($request)
    {
        $qty = [];
        if ($request->count_tool) $qty[] = strtoupper($request->count_tool);
        if ($request->count_tool1) $qty[] = strtoupper($request->count_tool1);
        if ($request->count_tool2) $qty[] = strtoupper($request->count_tool2);
        return implode(', ', $qty);
    }

    private function formatSeeds($request)
    {
        $seeds = [];
        if ($request->supplySeedling) $seeds[] = $request->supplySeedling->type;
        if ($request->supplySeedling1) $seeds[] = $request->supplySeedling1->type;
        if ($request->supplySeedling2) $seeds[] = $request->supplySeedling2->type;
        return implode(', ', $seeds);
    }

    private function formatSeedQty($request)
    {
        $qty = [];
        if ($request->count_seedling) $qty[] = strtoupper($request->count_seedling);
        if ($request->count_seedling1) $qty[] = strtoupper($request->count_seedling1);
        if ($request->count_seedling2) $qty[] = strtoupper($request->count_seedling2);
        return implode(', ', $qty);
    }

    public function viewPdfRequest($id)
    {
        try {
            $request = RequestN::findOrFail($id);

            // Assuming the 'title_land' attribute contains the file path
            $pdfPath = $request->letter_content;

            // Construct the full path to the PDF file in your storage
            $pdfFullPath = storage_path('app/public/' . $pdfPath);

            // Check if the file exists in storage
            if (file_exists($pdfFullPath)) {
                // Read the content of the PDF file
                $pdfData = file_get_contents($pdfFullPath);

                // Set appropriate headers for PDF response
                $headers = [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="request_document.pdf"',
                ];

                // Send the PDF data as a response using the response() helper function
                return response($pdfData, 200, $headers);
            } else {
                // Handle the case where the PDF file is not found
                return response()->json(['error' => 'PDF file not found'], 404);
            }
        } catch (\Exception $e) {
            // Handle any other exceptions that might occur
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            $id = $request->input('id');
            $status = $request->input('status');
            $remarks = $request->input('remarks');
            $selectedDate = $request->input('selectedDate'); // Get the selected date
    
            // Update status in request_tbl
            $request = RequestN::findOrFail($id);
            $request->status = $status;
            $request->save();
    
            // Save status, remarks, and selected date to remarkrequests table
            $remarkRequest = new RemarkRequest();
            $remarkRequest->request_id = $id;
            $remarkRequest->remarks = $remarks;
            $remarkRequest->remark_status = $status;
            $remarkRequest->date_return = $selectedDate; // Save selected date
            $remarkRequest->validated_by = Auth::user()->id;
            $remarkRequest->save();
    
            // Update user's status based on the request status (if needed)
            // ...
    
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }    

    
    public function getAvailableRequests()
    {
        try {
            $available_requests = RequestN::whereIn('status', ['Available'])->get();
    
            return $available_requests;
        } catch (\Exception $e) {
            // Handle any errors
            Log::error($e);
            return [];
        }
    }

    public function getApprovalRequests()
    {
        try {
            $approval_requests = RequestN::whereIn('status', ['Approved', 'Waiting-for-approval'])->get();
    
            return $approval_requests;
        } catch (\Exception $e) {
            Log::error($e);
            return [];
        }
    }

    public function getDisapprovedRequests()
    {
        try {
            $disapproved_requests = RequestN::whereIn('status', ['Disapproved'])->get();
    
            return $disapproved_requests;
        } catch (\Exception $e) {
            Log::error($e);
            return [];
        }
    }

    public function getPickingRequests()
    {
        try {
            $picked_requests = RequestN::whereIn('status', ['Ready-to-be-pick', 'Confirmed-pick-date', 'Picked'])->get();
    
            return $picked_requests;
        } catch (\Exception $e) {
            Log::error($e);
            return [];
        }
    }

    public function getReturnedRequests()
    {
        try {
            $returned_requests = RequestN::whereIn('status', ['Waiting-for-return', 'Returned', 'Failed-to-return'])->get();
    
            return $returned_requests;
        } catch (\Exception $e) {
            Log::error($e);
            return [];
        }
    }

    public function setPickingDate(Request $request)
    {
        $requestId = $request->input('requestId');
        $pickingDate = $request->input('picked_date');

        // Update the request record in the database with the picking date
        $request = RequestN::findOrFail($requestId);
        $request->picked_date = $pickingDate;
        $request->status = 'Confirmed-pick-date';
        $request->save();

        return response()->json(['success' => true]);
    }

    public function setReturnDate(Request $request)
    {
        $requestId = $request->input('requestId');
        $returnDate = $request->input('date_return');
    
        // Update the request record in the database with the return date
        $request = RequestN::findOrFail($requestId);
        $request->date_return = $returnDate;
        $request->status = 'Waiting-for-return';
        $request->save();
    
        return response()->json(['success' => true]);
    }
}