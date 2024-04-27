<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SupplyType;
use App\Models\RequestN;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RequestController extends Controller
{
    public function index1()
    {
        // $supplyTypes = SupplyType::where('supply_id', 1)->pluck('type', 'id');

        $supplyTypes = SupplyType::pluck('type', 'id');
        // $seedlings = SupplyTypes::where('supply_id', 2)->pluck('type', 'type');

        return view('pages.tools.index', compact('supplyTypes'));

    }

    public function addTools(Request $request)
{
    try {
        $request->validate([
            'supply_type' => 'required|string|max:255',
            'supply_count' => 'required|numeric',
            'letter_content' => 'required|file|mimes:pdf|max:2048',
            'status' => 'string|max:255',
            'date_return' => 'required|date',
        ]);

        // Get the ID of the authenticated user
        $loggedInUserId = Auth::id();

        // Validate if the user is logged in
        if (!$loggedInUserId) {
            return response()->json(['success' => false, 'errors' => ['authentication' => ['User is not authenticated.']]], 401);
        }

        // Find the logged-in user
        $loggedInUser = User::findOrFail($loggedInUserId);

        // Store the file
        $contentLetterPath = $request->file('letter_content')->store('pdfs', 'public');

        // Create the request with the logged-in user's ID
        RequestN::create([
            'supply_type' => $request->input('supply_type'),
            'supply_count' => $request->input('supply_count'),
            'requested_by' => $loggedInUserId, // Store the user's ID
            'letter_content' => $contentLetterPath,
            'status' => $request->input('status', 'Requested'),
            'date_return' => $request->input('date_return'),
        ]);

        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        \Log::error($e);
        return response()->json(['success' => false, 'errors' => ['exception' => [$e->getMessage()]]], 500);
    }
}
    }

