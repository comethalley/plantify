<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Libraries\PlantifyLibrary;
use App\Mail\MailInvitation;
use App\Models\Barangay;
use App\Models\CalendarPlanting;
use App\Models\Expense;
use App\Models\Farm;
use App\Models\Farmer;
use App\Models\User;
use App\Models\PlantifeedModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\FarmLocation;



class AuthController extends Controller
{
    protected $plantifyLibrary;

    public function __construct(PlantifyLibrary $plantifyLibrary)
    {
        $this->plantifyLibrary = $plantifyLibrary;
    }

    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $user = auth()->user();
        $barangays = Barangay::all(['id', 'barangay_name'])->toArray();
        $expensesData = collect();
        $plantingData = collect();
        $farmsData = collect();

        if ($user->role_id == 1) {
            // Fetch data for super admin role
            $expensesData = Expense::all(['description', 'amount', 'created_at', 'budget_id'])->toJson();
            $plantingData = CalendarPlanting::all(['title', 'start', 'harvested', 'destroyed', 'start'])->toJson();
            //$farmsData = Farm::with('barangays')->get()->toJson();
        } elseif ($user->role_id == 3) {
            // Fetch data for farm leader role
            $expensesData = Expense::where('budget_id', 3)->where('id', $user->id)->get(['description', 'amount', 'created_at'])->toJson();

            $farmsData = Farm::where('id', $user->id)->with('barangays')->get()->toJson();
        }

        $barangayOptions = [];
        foreach ($barangays as $barangay) {
            $barangayOptions[] = [
                'value' => $barangay['id'],
                'text' => $barangay['barangay_name']
            ];
        }

        return view('pages.analytics', compact('expensesData', 'plantingData', 'farmsData', 'barangayOptions'));
    }

    public function viewLogin()
    {
        return view('pages.login');
    }
    public function viewSignup()
    {
        return view('pages.signup');
    }

    public function farmLeaders()
    {
        $farmLeaders = DB::table('users')
            ->where('status', 1)
            ->where('role_id', 3)
            ->select(
                "id",
                'firstname',
                "lastname",
                "email"
            )
            ->get();
        return response()->json(['farmLeaders' => $farmLeaders], 200);
    }

    public function farmers()
    {
        $id = Auth::user()->id;
        $role = DB::table('users')
            ->where('id', $id)
            ->select(
                "role_id",
            )
            ->first();

        if ($role->role_id == 1 || $role->role_id == 2) {
            $farmLeaders = DB::table('farmers')
                ->where('users.status', 1)
                ->leftJoin('users', 'farmers.farmer_id', '=', 'users.id')
                ->select(
                    "users.id",
                    'users.firstname',
                    "users.lastname",
                    "users.email"
                )
                ->get();
        } else {
            $farmLeaders = DB::table('users')
                ->where('users.status', 1)
                ->where('farmers.farmleader_id', $id)
                ->leftJoin('farmers', 'farmers.farmer_id', '=', 'users.id')
                ->select(
                    "users.id",
                    'users.firstname',
                    "users.lastname",
                    "users.email"
                )
                ->get();
        }

        // dd($farmLeaders);
        return response()->json(['farmLeaders' => $farmLeaders, 'role' => $role], 200);
    }


    public function getAllAdmin()
    {
        $admins = DB::table('users')
            ->where('status', 1)
            ->where('role_id', 2)
            ->select(
                "id",
                'firstname',
                "lastname",
                "email",
            )
            ->get();
        return response()->json(['admins' => $admins], 200);
    }


    public function getAllArchiveUsers()
    {
        $restore = DB::table('users')
            ->where('users.status', 0)
            ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
            ->select(
                "users.id",
                'users.firstname',
                "users.lastname",
                "users.email",
                "roles.description"

            )
            ->get();
        return response()->json(['restore' => $restore], 200);
    }

    public function viewAdmin($id)
    {
        try {
            User::findOrFail($id);

            $admins = DB::table('users')
                ->where('status', 1)
                ->where('role_id', 2)
                ->where('id', $id)
                ->select(
                    "id",
                    'firstname',
                    "lastname",
                    "email",
                )
                ->first();
            return response()->json(['admin' => $admins], 200);
        } catch (ModelNotFoundException $e) {

            return response()->json(['error' => 'UOM not found'], 404);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function viewUsers($id)
    {
        try {
            User::findOrFail($id);

            $restore = DB::table('users')
                ->where('status', 0)
                ->where('id', $id)
                ->select(
                    "id",
                    'firstname',
                    "lastname",
                    "email",
                )
                ->first();
            return response()->json(['restore' => $restore], 200);
        } catch (ModelNotFoundException $e) {

            return response()->json(['error' => 'User not found'], 404);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function viewfarmLeaders($id)
    {

        $user = User::findOrFail($id);

        $farmLeaders = DB::table('users')
            ->where('status', 1)
            ->where('role_id', 3)
            ->where('id', $id)
            ->select(
                "id",
                'firstname',
                "lastname",
                "email",
            )
            ->first();

        if (!$farmLeaders) {
            return response()->json(['error' => 'Farm Leader not found'], 404);
        }


        // Find the farm associated with the farm leader
        $farm = Farm::where('farm_leader', $farmLeaders->id)->first();
        if ($farm) {
            // $farmLocation = FarmLocation::where('address', $farm->address)->first();
            return response()->json([
                'farmLeaders' => $farmLeaders,
                // 'farmLocation' => $farmLocation,
                'farm' => $farm
            ], 200);
        } else {
            return response()->json([
                'farmLeaders' => $farmLeaders,
                // 'farmLocation' => null,
                'farm' => null
            ], 200);
        }
    }





    public function updateAdmin(Request $request, $id)
    {
        try {
            $user = User::where('id', $id)
                ->where('status', 1)
                ->firstOrFail();

            $validator = Validator::make($request->all(), [
                'firstname'  => 'required|string|max:55',
                'lastname'  => 'required|string|max:55',
                'email' => 'required|email|unique:users,email,' . $user->id
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $data = $validator->validated();

            $user->update([
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'email' => $data['email'],
            ]);

            if ($user) {
                return response()->json(['message' => 'Measurement Updated Successfully'], 200);
            } else {
                return response()->json(['error' => 'Internal Server Error'], 500);
            }
        } catch (ModelNotFoundException $e) {

            return response()->json(['error' => 'Admin not found'], 404);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function updateFarmLeader(Request $request, $id)
    {
        try {
            $user = User::where('id', $id)
                ->where('status', 1)
                ->firstOrFail();

            $validator = Validator::make($request->all(), [
                'firstname'  => 'required|string|max:55',
                'lastname'  => 'required|string|max:55',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'farm_name' => 'required|string|max:255', // Added validation for farm_name
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $data = $validator->validated();

            // Update the farm leader's details
            $user->update([
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'email' => $data['email'],
            ]);

            // Update the associated farm's name
            if ($user->farm) {
                $user->farm->update(['farm_name' => $data['farm_name']]);
            }

            return response()->json(['message' => 'Farm Leader Updated Successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Farm Leader not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }


    public function archiveAdmin(Request $request, $id)
    {
        try {
            $user = User::where('id', $id)
                ->where('status', 1)
                ->firstOrFail();

            $user->update([
                'status' => 0,
            ]);

            if ($user) {
                return response()->json(['message' => 'Admin Archive Successfully'], 200);
            } else {
                return response()->json(['error' => 'Internal Server Error'], 500);
            }
        } catch (ModelNotFoundException $e) {

            return response()->json(['error' => 'Admin not found'], 404);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function restoreUser(Request $request, $id)
    {
        try {
            $user = User::where('id', $id)
                ->where('status', 0)
                ->firstOrFail();

            $user->update([
                'status' => 1,
            ]);

            if ($user) {
                return response()->json(['message' => 'Admin Archive Successfully'], 200);
            } else {
                return response()->json(['error' => 'Internal Server Error'], 500);
            }
        } catch (ModelNotFoundException $e) {

            return response()->json(['error' => 'User not found'], 404);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }


    public function archiveFarmLeader(Request $request, $id)
    {
        // Find the farm leader
        $user = User::where('id', $id)
            ->where('status', 1)
            ->firstOrFail();

        // Find the farm associated with the farm leader
        $farm = Farm::where('farm_leader', $user->id)->first();

        if ($farm) {
            // Find the farmers associated with the farm leader's ID
            $farmers = Farmer::where('farmleader_id', $user->id)->get();

            if ($farmers != "") {
                foreach ($farmers as $farmer) {
                    $farmerUser = User::findOrFail($farmer->farmer_id);
                    $farmerUser->update([
                        'status' => 0,
                    ]);
                }
            }

            $farmLocation = FarmLocation::where('address', $farm->address)->first();
            if ($farmLocation) {
                $farmLocation->update([
                    'status' => 0,
                ]);
            }
            // archive the farm
            $farm->update([
                'status' => 0,
            ]);
        }

        $user->update([
            'status' => 0,
        ]);

        return response()->json(['message' => 'Farm Leader Archived Successfully'], 200);
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:55',
            'lastname' => 'required|string|max:55',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'string', 'confirmed', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
        ], [
            'password.required' => 'Password is required.',
            'password.confirmed' => 'Password confirmation does not match.',
            'password.min' => 'Password must be at least :min characters.',
            'password.regex' => 'Password format is incorrect. It must contain at least one uppercase letter, one lowercase letter, and one digit.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $data = $validator->validated();

        $user = User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' =>  Hash::make($data['password']),
            'role_id' => 5,
            'status' => 1,
        ]);

        $newlyInsertedId = $user->id;

        $hash = $this->plantifyLibrary->generatehash($newlyInsertedId);


        // Store user data in the session
        // $request->session()->put('user', $user);

        // auth()->login($user);

        // return redirect("/dashboard/analytics");

        return redirect('/verification-code?l=' . $hash);
    }


    public function createAdmin(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                //'firstname'  => 'required|string|max:55',
                //'lastname'  => 'required|string|max:55',
                'email' => 'required|email|unique:users,email',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $data = $validator->validated();

            // print_r($data);
            // exit;
            $generate_password = $this->generate_password(10);


            // print_r($emailInvitation);
            // exit;

            $admins = User::create([
                'firstname'  => '',
                'lastname'  => '',
                'email' => $data['email'],
                'password' => Hash::make($generate_password),
                'role_id' => 2,
                'status' => 1
            ]);


            if ($admins) {
                $id = $admins->id;
                $hash = $this->plantifyLibrary->generatehash($id);
                $emailInvitation = $this->emailInvitation($data['email'], $data['email'], $generate_password, $hash);
                if ($emailInvitation) {

                    return response()->json(['message' => 'Admin Invited Successfully', 'data' => $admins], 200);
                }
            } else {
                return response()->json(['error' => 'Admin cant add Internal Server Error'], 500);
            }
        } catch (\Exception $e) {

            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function createFarmLeader(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'barangay_name' => 'required|string|max:255',
            'farm_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'area' => 'required|numeric',
            'email' => 'required|email|unique:users,email',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();

        // Create a new farm leader record
        $generate_password = $this->generate_password(10);

        $farmLeader = User::create([
            'firstname' => '', // You may want to add first name and last name fields in the form
            'lastname' => '',
            'email' => $data['email'],
            'password' => Hash::make($generate_password),
            'role_id' => 3, // Assuming role_id 3 represents a farm leader role
            'status' => 1, // Assuming status 1 represents an active user
        ]);

        // Get the ID of the farm leader
        $farmLeaderId = $farmLeader->id;

        // Create a new farm record and associate it with the farm leader
        $farm = Farm::create([
            'barangay_name' => $data['barangay_name'],
            'farm_name' => $data['farm_name'],
            'address' => $data['address'],
            'area' => $data['area'],
            'status' => "Created",
            'farm_leader' => $farmLeaderId, // Assuming 'farm_leader' is the field name in the farms table
        ]);

        // Create a new farm location record
        $farmLocation = new FarmLocation();
        $farmLocation->latitude = $data['latitude'];
        $farmLocation->longitude = $data['longitude'];
        $farmLocation->location_name = $data['farm_name'];
        $farmLocation->address = $data['address'];
        $farmLocation->status = 1;
        $farmLocation->save();

        // If both farm, farm leader, and farm location are successfully created, send email invitation
        if ($farm && $farmLeader && $farmLocation) {
            $hash = $this->plantifyLibrary->generatehash($farmLeaderId);
            $emailInvitation = $this->emailInvitation($data['email'], $data['email'], $generate_password, $hash);
            if ($emailInvitation) {
                return response()->json(['message' => 'Admin Invited Successfully', 'data' => $farmLeaderId], 200);
            }
        }
    }



    public function createFarmers(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                // 'firstname'  => 'required|string|max:55',
                // 'lastname'  => 'required|string|max:55',
                'email' => 'required|email|unique:users,email',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $id = Auth::user()->id;

            $data = $validator->validated();
            $generate_password = $this->generate_password(10);

            $farmLeaders = User::create([
                'firstname'  => '',
                'lastname'  => '',
                'email' => $data['email'],
                'password' => Hash::make($generate_password),
                'role_id' => 4,
                'status' => 1
            ]);

            $newlyInsertedId = $farmLeaders->id;

            $farmers = Farmer::create([
                'farmleader_id'  => $id,
                'farmer_id'  => $newlyInsertedId,
                'status' => 1
            ]);

            if ($farmLeaders && $farmers) {
                $id = $farmLeaders->id;
                $hash = $this->plantifyLibrary->generatehash($id);
                $emailInvitation = $this->emailInvitation($data['email'], $data['email'], $generate_password, $hash);
                if ($emailInvitation) {

                    return response()->json(['message' => 'Admin Invited Successfully', 'data' => $farmLeaders], 200);
                }
            } else {
                return response()->json(['error' => 'Admin cant add Internal Server Error'], 500);
            }
        } catch (\Exception $e) {

            return response()->json(['error' => 'Internal Server Error', $e], 500);
        }
    }

    public function generate_password($length = 10)
    {
        // Define a character set for the password
        $charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

        // Generate a random password
        $password = "";
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = mt_rand(0, strlen($charset) - 1);
            $password .= $charset[$randomIndex];
        }

        return $password;
    }

    public function emailInvitation($email, $firstname, $generate_password, $hash)
    {
        $data = [
            "subject" => "Plantify Invitation Mail",
            "firstname" => $firstname,
            "email" => $email,
            // "password" => $generate_password,
            "body" => "Join the urban green revolution !",
            "hash" => $hash
        ];
        // return json_encode($data);

        try {
            Mail::to($email)->send(new MailInvitation($data));
            return response()->json(['Great! Successfully sent in your mail']);
        } catch (Exception $e) {
            $error = Log::error($e->getMessage());
            return response()->json($error);
        }
        // return $email;
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            "email" => ['required', 'email'],
            'password' => 'required'
        ]);

        $user = Auth::getProvider()->retrieveByCredentials($validated);

        if (!$user || !Auth::getProvider()->validateCredentials($user, $validated)) {
            return back()->withErrors(['email' => 'Login failed'])->onlyInput('email');
        }

        if (!$user->hasVerifiedEmail()) {
            return back()->withErrors(['email' => 'Please verify your email before logging in']);
        }

        // Check if user status is active
        if ($user->status == 0) {
            return back()->withErrors(['email' => 'Your account is inactive. Please contact CUAI.']);
        }
        // Check if user status is active
        if ($user->status == 3) {
            return back()->withErrors(['email' => 'Your account is deactivate. Please return the tool to activate your account or contact CUAI.']);
        }

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();

            $user = Auth::user();
            $request->session()->put('user', $user);

            return redirect('/dashboard/analytics')->with('message', 'Welcome back!');
        }

        return back()->withErrors(['email' => 'Login failed'])->onlyInput('email');
    }


    public function logout(Request $request)
    {
        // /** @var \App\Models\User $user */
        // $user = $request->user();
        // $user->currentAccessToken()->delete();
        // return response('', 204);

        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }



    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);

        $data = $request->validate([
            'firstname'  => 'required|string|max:55',
            'lastname'  => 'required|string|max:55',
            'email' => 'required|email',
            'role_id' => 'required|integer|digits:1'
        ]);
        $user->update([
            'firstname'  => $data['firstname'],
            'lastname'  => $data['lastname'],
            'email' => $data['email'],
            'role_id' => $data['role_id']
        ]);

        return response(compact('user'));
    }

    public function archive(Request $request, $id)
    {

        $user = User::findOrFail($id);

        $user->update([
            'status'  => 0
        ]);

        return response(compact('user'));
    }

    public function test()
    {
        return view('pages.index');
    }

    public function getAdmin()
    {
        return view('pages.users.admin');
    }

    public function getFarmerLeader()
    {
        $barangays = Barangay::all();
        return view('pages.users.farmleaders', ['barangays' => $barangays]);
    }


    public function getFarmers()
    {
        return view('pages.users.farmers');
    }

    public function getArchived()
    {
        return view('pages.users.restore');
    }

    public function landingpage()
    {
        if (auth()->check()) {
            return redirect()->route('dashboard.analytics');
        }
        return view('landingpage');
    }
}
