<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Supply;
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
        $tools = Supply::where('supply_id', 1)->pluck('type', 'type');
        $seedlings = Supply::where('supply_id', 2)->pluck('type', 'type');

        return view('pages.tools.index', compact('tools', 'seedlings'));

    }

    public function addTools(Request $request)
    {
        try {
            $request->validate([
                'supply_type' => 'required|string|max:255',
                'supply_count' => 'required|numeric',
                'requested_by' => 'required|exists:users,id',
                'letter_content' => 'required|file|mimes:pdf|max:2048',
                'status' => 'string|max:255',
                'date_return' => 'required|date',

            ]);

            $selectedUser = User::findOrFail($request->input('farm_leader'));

            $contentLetterPath = $request->file('letter_content')->store('pdfs', 'public');

            RequestN::create([
                'supply_type' => $request->input('supply_type'),
                'supply_count' => $request->input('supply_count'),
                'requested_by' => $request->input('requested_by'),
                'letter_content' => $contentLetterPath,
                'status' => $request->input('status', 'Requested'),
                'farm_leader' => $selectedUser->id,
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['success' => false, 'errors' => ['exception' => [$e->getMessage()]]], 500);
        }
    }
}
