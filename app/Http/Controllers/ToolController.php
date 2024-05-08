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
use Carbon\Carbon;

class ToolController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Fetch all requested statuses from the database
        $request_tbl = RequestN::with('requestedBy', 'farm')->where('status', 'Requested')->get();
        $all_requests = RequestN::with('requestedBy', 'farm')->get();
    
        $available_requests = $this->getAvailableRequests();
        $approval_requests = $this->getApprovalRequests();
        $picked_requests = $this->getPickingRequests();
        $return_requests = $this->getReturnedRequests();
    
        // Fetch supply types if required by this view
        $supplyTools = SupplyType::where('supply_id', 1)->pluck('type', 'id');
        $supplySeedlings = SupplyType::where('supply_id', 2)->pluck('type', 'id');
    
        return view('pages.tools.request', compact('request_tbl', 'supplyTools', 'supplySeedlings', 'available_requests', 'approval_requests', 'picked_requests', 'return_requests', 'all_requests'));
    }

    public function updateStatus(Request $request)
    {
        try {
            $id = $request->input('id');
            $status = $request->input('status');
    
            $request = RequestN::findOrFail($id);
            $request->status = $status;
            $request->save();
    
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
    
    public function getLetterContent(Request $request)
    {
        try {
            $id = $request->input('id');
            $request = RequestN::findOrFail($id);
            $letterContent = $request->letter_content;

            return response()->json(['letter_content' => $letterContent]);
        } catch (\Exception $e) {
            // Handle any errors
            Log::error($e);
            return response()->json(['error' => 'Error fetching letter content'], 500);
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
            $approval_requests = RequestN::whereIn('status', ['Approved', 'Waiting for Approval'])->get();
    
            return $approval_requests;
        } catch (\Exception $e) {
            Log::error($e);
            return [];
        }
    }

    public function getPickingRequests()
    {
        try {
            $picked_requests = RequestN::whereIn('status', ['Ready to be picked', 'Picked'])->get();
    
            return $picked_requests;
        } catch (\Exception $e) {
            Log::error($e);
            return [];
        }
    }

    public function getReturnedRequests()
    {
        try {
            $returned_requests = RequestN::whereIn('status', ['Waiting to return', 'Returned', 'Failed to Return'])->get();
    
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
        $request->status = 'Ready to be Picked';
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
        $request->status = 'Waiting for return';
        $request->save();
    
        return response()->json(['success' => true]);
    }
}