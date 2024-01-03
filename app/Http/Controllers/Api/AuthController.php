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
use Illuminate\Validation\Rules\Password;


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
        return view('pages.index');
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
            )
            ->get();
        return response()->json($farmLeaders);
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
}
