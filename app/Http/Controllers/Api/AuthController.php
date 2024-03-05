<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\MailInvitation;
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

    public function index()
    {
        // $users = DB::table('users')->where('status', 1)->select(
        //     "id",
        //     "email",
        //     'firstname',
        //     "lastname",
        // )->get();
        // return response()->json($users);
      
       // dd($notifications);
       $notifications = DB::select("SELECT users.id, users.firstname, users.lastname, users.email, COUNT(is_read) AS unread FROM users LEFT JOIN message_notifs ON users.id = message_notifs.from AND message_notifs.is_read = 0 WHERE users.id = ".Auth::id()." GROUP BY users.id, users.firstname, users.lastname, users.email");
       return view('pages.index', ['notifications' => $notifications]); 
    }

    public function viewLogin()
    {
        return view('pages.login');
    }
    public function viewSignup()
    {
        return view('pages.signup');
    }
    public function notifications()
    {
        $notifications = DB::select("SELECT users.id, users.firstname, users.lastname, users.email, COUNT(is_read) AS unread FROM users LEFT JOIN message_notifs ON users.id = message_notifs.from AND message_notifs.is_read = 0 WHERE users.id = ".Auth::id()." GROUP BY users.id, users.firstname, users.lastname, users.email");
        return view('pages.index', ['supplierSeeds' => $supplierSeeds]); 
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
            // 'role_id' => 'required|integer|digits:1'
        ]);

        // $generate_password = $this->generate_password(10);

        $email = $data['email'];
        $firstname = $data['firstname'];
        // $this->emailInvitation($email, $firstname, $generate_password);

        $user = User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' =>  Hash::make($data['password']),
            'role_id' => 1,
            'status' => 1,
        ]);

        auth()->login($user);

        return redirect("/");
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
            $generate_password = $this->generate_password(10);

            $admins = User::create([
                'firstname'  => $data['firstname'],
                'lastname'  => $data['lastname'],
                'email' => $data['email'],
                'password' => Hash::make($generate_password),
                'role_id' => 2,
                'status' => 1
            ]);

            if ($admins) {
                return response()->json(['message' => 'Admin Invited Successfully', 'data' => $admins], 200);
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
                return response()->json(['message' => 'Admin Invited Successfully', 'data' => $farmLeaders], 200);
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

    public function emailInvitation($email, $firstname, $generate_password)
    {
        $data = [
            "subject" => "Plantify Invitation Mail",
            "firstname" => $firstname,
            "email" => $email,
            "password" => $generate_password,
            "body" => "Join the urban green revolution !"
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

        if (auth()->attempt($validated)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'Welcome back!');
        }

        return back()->withErrors(['email' => 'Login failed'])->onlyInput('email');
        // /** @var \App\Models\User $user */
        // $user = Auth::user();
        // $token = $user->createToken('main')->plainTextToken;
        // return response(compact('user', 'token'));
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
}
