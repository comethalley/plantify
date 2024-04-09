<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Libraries\PlantifyLibrary;
use App\Mail\MailInvitation;
use App\Models\Barangay;
use App\Models\CalendarPlanting;
use App\Models\Expense;
use App\Models\Farm;
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

    public function viewfarmLeaders($id)
    {
        try {
            User::findOrFail($id);

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
            return response()->json(['farmLeaders' => $farmLeaders], 200);
        } catch (ModelNotFoundException $e) {

            return response()->json(['error' => 'UOM not found'], 404);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Internal Server Error'], 500);
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

    public function archiveFarmLeader(Request $request, $id)
    {
        try {
            $user = User::where('id', $id)
                ->where('status', 1)
                ->firstOrFail();

            $user->update([
                'status' => 0,
            ]);

            if ($user) {
                return response()->json(['message' => 'Farm Leader Archive Successfully'], 200);
            } else {
                return response()->json(['error' => 'Internal Server Error'], 500);
            }
        } catch (ModelNotFoundException $e) {

            return response()->json(['error' => 'Admin not found'], 404);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function signup(Request $request)
    {
        $data = $request->validate([
            'firstname'  => 'required|string|max:55',
            'lastname'  => 'required|string|max:55',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' =>  Hash::make($data['password']),
            'role_id' => 5,
            'status' => 1,
        ]);

        // Store user data in the session
        $request->session()->put('user', $user);

        auth()->login($user);

        return redirect("/dashboard/analytics");
    }


    public function createAdmin(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'firstname'  => 'required|string|max:55',
                'lastname'  => 'required|string|max:55',
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
                'firstname'  => $data['firstname'],
                'lastname'  => $data['lastname'],
                'email' => $data['email'],
                'password' => Hash::make($generate_password),
                'role_id' => 2,
                'status' => 1
            ]);


            if ($admins) {
                $id = $admins->id;
                $hash = $this->plantifyLibrary->generatehash($id);
                $emailInvitation = $this->emailInvitation($data['email'], $data['firstname'], $generate_password, $hash);
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
        try {
            $validator = Validator::make($request->all(), [
                'firstname'  => 'required|string|max:55',
                'lastname'  => 'required|string|max:55',
                'email' => 'required|email|unique:users,email',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $data = $validator->validated();
            $generate_password = $this->generate_password(10);

            $farmLeaders = User::create([
                'firstname'  => $data['firstname'],
                'lastname'  => $data['lastname'],
                'email' => $data['email'],
                'password' => Hash::make($generate_password),
                'role_id' => 3,
                'status' => 1
            ]);

            if ($farmLeaders) {
                $id = $farmLeaders->id;
                $hash = $this->plantifyLibrary->generatehash($id);
                $emailInvitation = $this->emailInvitation($data['email'], $data['firstname'], $generate_password, $hash);
                if ($emailInvitation) {

                    return response()->json(['message' => 'Admin Invited Successfully', 'data' => $farmLeaders], 200);
                }
            } else {
                return response()->json(['error' => 'Admin cant add Internal Server Error'], 500);
            }
        } catch (\Exception $e) {

            return response()->json(['error' => 'Internal Server Error'], 500);
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

        return redirect('/login');
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
        return view('pages.users.farmleaders');
    }

    public function getFarmers()
    {
        return view('pages.users.farmers');
    }

    public function landingpage()
    {
        return view('landingpage');
    }
}
