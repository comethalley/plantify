<?php

namespace App\Http\Controllers;
use App\Notifications\NewRequestNotification;
use App\Http\Controllers\Controller;
use App\Models\User;
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

class RequestController extends Controller
{
    public function index1()
    {
        $user = Auth::user();

        // Fetch supply types
        $supplyTools = SupplyType::where('supply_id', 1)->pluck('type', 'id');
        $supplySeedlings = SupplyType::where('supply_id', 2)->pluck('type', 'id');

        // Fetch request_tbl data and join with users table and supply_type_tbl for tool and seedling
        $request_tbl = DB::table('request_tbl')
            ->leftJoin('users', 'request_tbl.requested_by', '=', 'users.id')
            ->leftJoin('supply_type_tbl as tool', 'request_tbl.supply_tool', '=', 'tool.id')
            ->leftJoin('supply_type_tbl as tool1', 'request_tbl.supply_tool1', '=', 'tool1.id')
            ->leftJoin('supply_type_tbl as tool2', 'request_tbl.supply_tool2', '=', 'tool2.id')
            ->leftJoin('supply_type_tbl as seedling', 'request_tbl.supply_seedling', '=', 'seedling.id')
            ->leftJoin('supply_type_tbl as seedling1', 'request_tbl.supply_seedling1', '=', 'seedling1.id')
            ->leftJoin('supply_type_tbl as seedling2', 'request_tbl.supply_seedling2', '=', 'seedling2.id')

            ->when($user, function ($query) use ($user) {
                return $query->where('request_tbl.requested_by', '=', $user->id);
            })
            ->select(
                'request_tbl.*',
                'users.firstname as requested_by_firstname',
                'users.lastname as requested_by_lastname',
                'tool.type as supply_tool',
                'tool1.type as supply_tool1',
                'tool2.type as supply_tool2',
                'seedling.type as supply_seedling',
                'seedling1.type as supply_seedling1',
                'seedling2.type as supply_seedling2'
            )
            ->get();

        return view('pages.tools.index', compact('supplyTools', 'supplySeedlings', 'request_tbl'));
    }

    public function addTools(Request $request)
    {
        try {
            $request->validate([
                'supply_tool' => 'nullable|string|max:255',
                'supply_tool1' => 'nullable|string|max:255',
                'supply_tool2' => 'nullable|string|max:255',

                'supply_seedling' => 'nullable|string|max:255',
                'supply_seedling1' => 'nullable|string|max:255',
                'supply_seedling2' => 'nullable|string|max:255',

                'count_tool' => 'nullable|numeric',
                'count_tool1' => 'nullable|numeric',
                'count_tool2' => 'nullable|numeric',

                'count_seedling' => 'nullable|numeric',
                'count_seedling1' => 'nullable|numeric',
                'count_seedling2' => 'nullable|numeric',

                'letter_content' => 'nullable|file|mimes:pdf|max:2048',
                'status' => 'string|max:255',
            ]);

            $loggedInUserId = Auth::id();

            if (!$loggedInUserId) {
                return response()->json(['success' => false, 'errors' => ['authentication' => ['User is not authenticated.']]], 401);
            }

            $loggedInUser = User::findOrFail($loggedInUserId);

            $contentLetterPath = $request->file('letter_content')->store('pdfs', 'public');

            RequestN::create([
                'supply_tool' => $request->input('supply_tool'),
                'supply_tool1' => $request->input('supply_tool1'),
                'supply_tool2' => $request->input('supply_tool2'),

                'supply_seedling' => $request->input('supply_seedling'),
                'supply_seedling1' => $request->input('supply_seedling1'),
                'supply_seedling2' => $request->input('supply_seedling2'),

                'count_tool' => $request->input('count_tool'),
                'count_tool1' => $request->input('count_tool1'),
                'count_tool2' => $request->input('count_tool2'),

                'count_seedling' => $request->input('count_seedling'),
                'count_seedling1' => $request->input('count_seedling1'),
                'count_seedling2' => $request->input('count_seedling2'),

                'requested_by' => $loggedInUserId, // Store the user's ID
                'letter_content' => $contentLetterPath,
                'status' => $request->input('status', 'Requested'),
            ]);
            $admins = User::whereIn('role_id', [1, 2])->get();

            // Notify each admin
            foreach ($admins as $admin) {
                $admin->notify(new NewRequestNotification($admin));
            }
            return response()->json(['success' => true]);
        } 
        
       
        catch (\Exception $e) {
            Log::error($e);
            return response()->json(['success' => false, 'errors' => ['exception' => [$e->getMessage()]]], 500);
        }
        
    }

    public function getRequestDetails($id)
    {
        $request = RequestN::findOrFail($id);

        $remarkrequests = RemarkRequest::where('request_id', $request->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'request_id' => $request->id,
            'remarks' => $remarkrequests->pluck('remarks'),
            'remark_status' => $remarkrequests->pluck('remark_status'),
            'validated_by' => $remarkrequests->pluck('validated_by'),
            'created_at' => $remarkrequests->pluck('created_at'),
            'date_return' => $remarkrequests->pluck('date_return'),
            'select_picked' => $remarkrequests->pluck('select_picked'),

        ]);
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

    public function SetDateStatus($id, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'select_picked' => 'required|date', 
            ]);

            $request = RequestN::findOrFail($id);

            $request->status = 'Picked';

            $request->save();

            $user = Auth::user();

            RemarkRequest::create([
                'request_id' => $request->id,
                'remarks' => 'For Request Picked Date',
                'remark_status' => 'Picked',
                'validated_by' => $user->firstname . ' ' . $user->lastname,
                'select_picked' => $validatedData['select_picked'] 
            ]);

            return response()->json(['success' => true, 'message' => 'Farm status updated successfully']);
        } catch (\Exception $e) {
            \Log::error('Error updating farm status to "Cancel" for farm ID ' . $id . ': ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error updating farm status to "Set Date"']);
        }
    }

    public function SetDateStatus1($id, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'select_picked' => 'required|date', 
            ]);

            $request = RequestN::findOrFail($id);

            $request->status = 'Waiting-for-Return';

            $request->save();

            $user = Auth::user();

            RemarkRequest::create([
                'request_id' => $request->id,
                'remarks' => 'For Request Picked Date',
                'remark_status' => 'Waiting-for-Return',
                'validated_by' => $user->firstname . ' ' . $user->lastname,
                'select_picked' => $validatedData['select_picked'] 
            ]);

            return response()->json(['success' => true, 'message' => 'Farm status updated successfully']);
        } catch (\Exception $e) {
            \Log::error('Error updating farm status to "Cancel" for farm ID ' . $id . ': ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error updating farm status to "Set Date"']);
        }
    }
}
