<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Farm;
use App\Models\User;
use App\Models\Barangay;
use App\Models\FarmArchive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class FarmController extends Controller
{
//View PDF - IMG ///

public function viewImage2($id)  
    {
        try {
            // Find the farm by ID
            $farms = Farm::findOrFail($id); 
    
            // Assuming the 'picture_land' attribute contains the file path for the image
            $imagePath = $farms->picture_land2;
    
            // Construct the full path to the image file in your storage
            $imageFullPath = storage_path('app/public/' . rtrim($imagePath, '/'));
    
            // Log the image full path
            Log::info('Image Full Path:', compact('imageFullPath'));
    
            // Check if the file exists in storage
            if (File::exists($imageFullPath)) {
                // Read the content of the image file
                $imageData = File::get($imageFullPath);
    
                // Determine the image mime type (e.g., 'image/png', 'image/jpeg', etc.)
                $imageMimeType = File::mimeType($imageFullPath);
    
                // Log the detected MIME type
                Log::info('Detected MIME type:', ['imageMimeType' => $imageMimeType]);
    
                // Set appropriate headers for image response
                $headers = [
                    'Content-Type' => $imageMimeType,
                    'Content-Disposition' => 'inline; filename="farm_image"',
                ];
    
                // Send the image data as a response using the Response facade
                return Response::make($imageData, 200, $headers);
            } else {
                // Handle the case where the image file is not found
                return response()->json(['error' => 'Image file not found'], 404);
            }
        } catch (\Exception $e) {
            // Handle any other exceptions that might occur
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

public function viewImage1($id)  
    {
        try {
            // Find the farm by ID
            $farms = Farm::findOrFail($id); 
    
            // Assuming the 'picture_land' attribute contains the file path for the image
            $imagePath = $farms->picture_land1;
    
            // Construct the full path to the image file in your storage
            $imageFullPath = storage_path('app/public/' . rtrim($imagePath, '/'));
    
            // Log the image full path
            Log::info('Image Full Path:', compact('imageFullPath'));
    
            // Check if the file exists in storage
            if (File::exists($imageFullPath)) {
                // Read the content of the image file
                $imageData = File::get($imageFullPath);
    
                // Determine the image mime type (e.g., 'image/png', 'image/jpeg', etc.)
                $imageMimeType = File::mimeType($imageFullPath);
    
                // Log the detected MIME type
                Log::info('Detected MIME type:', ['imageMimeType' => $imageMimeType]);
    
                // Set appropriate headers for image response
                $headers = [
                    'Content-Type' => $imageMimeType,
                    'Content-Disposition' => 'inline; filename="farm_image"',
                ];
    
                // Send the image data as a response using the Response facade
                return Response::make($imageData, 200, $headers);
            } else {
                // Handle the case where the image file is not found
                return response()->json(['error' => 'Image file not found'], 404);
            }
        } catch (\Exception $e) {
            // Handle any other exceptions that might occur
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function viewImage($id)  
    {
        try {
            // Find the farm by ID
            $farms = Farm::findOrFail($id); 
    
            // Assuming the 'picture_land' attribute contains the file path for the image
            $imagePath = $farms->picture_land;
    
            // Construct the full path to the image file in your storage
            $imageFullPath = storage_path('app/public/' . rtrim($imagePath, '/'));
    
            // Log the image full path
            Log::info('Image Full Path:', compact('imageFullPath'));
    
            // Check if the file exists in storage
            if (File::exists($imageFullPath)) {
                // Read the content of the image file
                $imageData = File::get($imageFullPath);
    
                // Determine the image mime type (e.g., 'image/png', 'image/jpeg', etc.)
                $imageMimeType = File::mimeType($imageFullPath);
    
                // Log the detected MIME type
                Log::info('Detected MIME type:', ['imageMimeType' => $imageMimeType]);
    
                // Set appropriate headers for image response
                $headers = [
                    'Content-Type' => $imageMimeType,
                    'Content-Disposition' => 'inline; filename="farm_image"',
                ];
    
                // Send the image data as a response using the Response facade
                return Response::make($imageData, 200, $headers);
            } else {
                // Handle the case where the image file is not found
                return response()->json(['error' => 'Image file not found'], 404);
            }
        } catch (\Exception $e) {
            // Handle any other exceptions that might occur
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function viewPdf($id)
{
    
    try {
        
        $farms = Farm::findOrFail($id);

        // Assuming the 'title_land' attribute contains the file path
        $pdfPath = $farms->title_land;

        // Construct the full path to the PDF file in your storage
        $pdfFullPath = storage_path('app/public/' . $pdfPath);

        // Check if the file exists in storage
        if (file_exists($pdfFullPath)) {
            // Read the content of the PDF file
            $pdfData = file_get_contents($pdfFullPath);

            // Set appropriate headers for PDF response
            $headers = [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="farm_document.pdf"',
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

// index farm-management//
    public function index()
    {
        $barangays = Barangay::all();
    
        $farmLeaders = User::where('status', 1)
                           ->where('role_id', 3)
                           ->select('id', 'firstname', 'lastname')
                           ->get();
    
        return view('pages.farms.index', [
            'barangays' => $barangays,
            'farmLeaders' => $farmLeaders,
        ]);
    }


    public function viewArchiveFarms()
    {
        $archivefarms = FarmArchive::all();
        return view('pages.farms.xfarms')->with('archivefarms', $archivefarms);
    }

public function archiveFarm(Request $request, $id)
    {
        // Find the Barangay to be archived
        $farms = Farm::findOrFail($id);

        // Create a new entry in the "barangays_archive" table
        FarmArchive::create([
            'old_id' => $farms->id,
            'barangay_name' => $farms->barangay_name,
            'farm_name' => $farms->farm_name,
            'address' => $farms->address,
            'area' => $farms->area,
            'farm_leader' => $farms->farm_leader,
            'status' => $farms->status,
            'title_land' => $farms->title_land,
            'picture_land' => $farms->picture_land,
            'picture_land1' => $farms->picture_land1,
            'picture_land2' => $farms->picture_land2,
            // Add other attributes as needed
        ]);

        // Delete the Barangay from the "barangays" table
        $farms->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Barangay archived successfully.');
    }


    public function updateStatus(Request $request, $id)
    {
        // Validate the request if needed
        $request->validate([
            'status' => 'required|in:For-Investigation,For-Visiting,Approved,Disapproved,Waiting-for-Approval,Resubmit,',
        ]);

        // Find the farm by ID
        $farms = Farm::find($id);

        if (!$farms) {
            // Handle the case when the farm is not found
            return response()->json(['error' => 'Farm not found'], 404);
        }

        // Update the status
        $farms->status = $request->input('status');
        $farms->save();

        // You can return a response as needed
        return response()->json(['message' => 'Status updated successfully']);
    }


//view farm-management//

public function filterByStatus(Request $request)
{
    $status = $request->input('status');

    if (strtolower($status) == 'all') {
        $farms = Farm::all();
    } else {
        $farms = Farm::where('status', $status)->get();
    }

    return response()->json(['farms' => $farms]);
}

public function filterByStatus1(Request $request)
{
    $barangay_name = $request->input('barangay_name');

    if (strtolower($barangay_name) == 'all') {
        $farms = Farm::all();
    } else {
        $farms = Farm::where('barangay_name', $barangay_name)->get();
    }

    return response()->json(['farms' => $farms]);
}

public function viewFarms(Request $request)
{
    $barangayName = $request->input('barangay_name');


    $farms = DB::table('farms')
        ->join('barangays', 'farms.barangay_name', '=', 'barangays.barangay_name')
        ->where('farms.barangay_name', '=', $barangayName)
        ->select('farms.*')
        ->get();

    return view('pages.farms.view', compact('farms', 'barangayName'));
}

public function viewFarms3(Request $request)
{
    // Get the barangay_name from the request
    $barangayName = $request->input('barangay_name');

    // Get the authenticated user
    $user = Auth::user();

    if ($user) {
        // If the user is a farm leader, retrieve farms based on their farm_leader value and barangay_name
        $farms = DB::table('farms')
            ->join('barangays', 'farms.barangay_name', '=', 'barangays.barangay_name')
            ->where('farms.farm_leader', '=', $user->firstname . ' ' . $user->lastname)
            ->where('farms.barangay_name', '=', $barangayName)
            ->select('farms.*')
            ->get();
    } else {
        // If the user is not authenticated, you may want to handle this case accordingly
        // For now, let's assume there's a default behavior, like fetching all farms for a specific barangay
        $farms = DB::table('farms')
            ->join('barangays', 'farms.barangay_name', '=', 'barangays.barangay_name')
            ->where('farms.barangay_name', '=', $barangayName)
            ->select('farms.*')
            ->get();
    }

    return view('pages.farms.view1', compact('farms', 'barangayName'));
}

public function addFarms(Request $request)
    {
        try {
            $request->validate([
                'barangay_name' => 'required|string|max:255',
                'farm_name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'area' => 'required|numeric',
                'farm_leader' => 'required|exists:users,id',
                'title_land' => 'required|file|mimes:pdf,png,jpg|max:2048',
                'picture_land' => 'required|file|mimes:jpeg,png|max:2048',
                'picture_land1' => 'nullable|file|mimes:jpeg,png|max:2048',
                'picture_land2' => 'nullable|file|mimes:jpeg,png|max:2048',
                'status' => 'string|max:255',
            ]);

            // Retrieve user details based on the selected farm_leader
            $selectedUser = User::findOrFail($request->input('farm_leader'));

            // Extract first name and last name from the user details
            $farmLeaderFirstName = $selectedUser->firstname;
            $farmLeaderLastName = $selectedUser->lastname;

            $barangayName = $request->input('barangay_name');
            $farmName = $request->input('farm_name');
            $address = $request->input('address');
            $area = $request->input('area');
            $status = $request->input('status', 'Created');

            $titleLandContent = file_get_contents($request->file('title_land')->getRealPath());
            $pictureLandContent = file_get_contents($request->file('picture_land')->getRealPath());

            $titleLandPath = $request->file('title_land')->store('pdfs', 'public');
            $pictureLandPath = $request->file('picture_land')->store('images', 'public');

            $pictureLandPath1 = $request->hasFile('picture_land1') ? $request->file('picture_land1')->store('images', 'public') : null;
            $pictureLandPath2 = $request->hasFile('picture_land2') ? $request->file('picture_land2')->store('images', 'public') : null;

        Farm::create([
            'barangay_name' => $request->input('barangay_name'),
            'farm_name' => $request->input('farm_name'),
            'address' => $request->input('address'),
            'area' => $request->input('area'),
            'farm_leader' => $farmLeaderFirstName . ' ' . $farmLeaderLastName,
            'status' => $request->input('status', 'Created'),
            'title_land' => $titleLandPath,
            'picture_land' => $pictureLandPath,
            'picture_land1' => $pictureLandPath1,
            'picture_land2' => $pictureLandPath2,
        ]);

        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        \Log::error($e);
        return response()->json(['success' => false, 'errors' => ['exception' => [$e->getMessage()]]], 500);
    }
}

}

