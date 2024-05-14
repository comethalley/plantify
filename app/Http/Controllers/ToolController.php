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
use App\Notifications\ToolsAvailableNotification;
class ToolController extends Controller
{
    public function index()
    {
        // Fetch all requested statuses from the database
        $request_tbl = RequestN::with('requestedBy', 'farm', 'supplyTool', 'supplyTool1', 'supplyTool2', 'supplySeedling', 'supplySeedling1', 'supplySeedling2',)->where('status', 'Requested')->get();
        $all_requests = RequestN::with('requestedBy', 'farm', 'supplyTool', 'supplyTool1', 'supplyTool2', 'supplySeedling', 'supplySeedling1', 'supplySeedling2',)->get();

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

            // Update status in request_tbl
            $request = RequestN::findOrFail($id);
            $request->status = $status;
            $request->save();

            // Save status and remarks to remarkrequests table
            $remarkRequest = new RemarkRequest();
            $remarkRequest->request_id = $id;
            $remarkRequest->remarks = $remarks;
            $remarkRequest->remark_status = $status; // You can adjust this as needed
            $remarkRequest->validated_by = Auth::user()->id; // Assuming you have authentication and need to track who validated
            $remarkRequest->save();

            // Update user's status based on the request status
            $user = $request->requestedBy;
            if ($status === 'Failed-to-return') {
                // Set user's status to 0 if the request status is "Failed-to-return"
                $user->status = 3;
            } elseif ($status === 'Returned') {
                // Set user's status to 1 if the request status is "Returned"
                $user->status = 1;
            }
            $user->save();
            $tool->update(['available' => true]);

            // Notify the user
            $user = Auth::user();
            $user->notify(new ToolsAvailableNotification($tool));

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
            $picked_requests = RequestN::whereIn('status', ['Ready-to-be-pick', 'Picked'])->get();
    
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
        $request->status = 'Ready to be pick';
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