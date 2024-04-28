<?php

namespace App\Http\Controllers;

use App\Libraries\PlantifyLibrary;
use App\Mail\MailForgot;
use App\Models\EmailVerification as ModelsEmailVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailInvitation;
use App\Mail\MailVerificationCode;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class EmailVerification extends Controller
{
    protected $plantifyLibrary;

    public function __construct(PlantifyLibrary $plantifyLibrary)
    {
        $this->plantifyLibrary = $plantifyLibrary;
    }

    public function emailVerification(Request $request)
    {
        $l = $request->query('l');
        $verifyhash = $this->plantifyLibrary->verifydatafromhashid($l);

        $user = User::select('id', 'email_verified_at')->find($verifyhash);

        if ($user && $user->email_verified_at != null) {


            return view('pages.change-password', ['user' => $user]);
        }

        try {
            $user = User::findOrFail($verifyhash);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('login')->with('error', 'User not found.');
        }
        $checkSendedCode  = ModelsEmailVerification::where('user_id', $user->id)->first();

        if ($checkSendedCode == "") {
            $generateCode = $this->generateCode();
            $emailCode = ModelsEmailVerification::create([
                'user_id' => $user->id,
                'email_code' => $generateCode,
                'status' => 0,
            ]);

            $this->sendEmailCode($user->email, $emailCode->email_code);
        }

        return view('pages.email-verification', ['user' => $user]);
    }

    public function verifyEmail(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'digit1' => 'required|string|digits:1',
            'digit2' => 'required|string|digits:1',
            'digit3' => 'required|string|digits:1',
            'digit4' => 'required|string|digits:1'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $verificationCode = $request['digit1'] . $request['digit2'] . $request['digit3'] . $request['digit4'];

        $emailVerification = ModelsEmailVerification::where('user_id', $id)->where('email_code', $verificationCode)->first();

        if ($emailVerification) {

            $user = User::findOrFail($id);
            $user->email_verified_at = Carbon::now();
            $user->save();
            return response()->json(['message' => 'Email Verified Successfully']);
        } else {
            return response()->json(['message' => 'Email verification failed. The verification code you provided may be invalid or expired. Please resend a new verification link.']);
        }
    }

    public function generateCode()
    {
        $randomNumber = mt_rand(1000, 9999);

        while (ModelsEmailVerification::where('email_code', $randomNumber)->exists()) {
            $randomNumber = mt_rand(1000, 9999);
        }

        return $randomNumber;
    }

    public function emptyCode($id)
    {
        $emailVerification = ModelsEmailVerification::where('user_id', $id)->first();
        if ($emailVerification) {
            $emailVerification->update([
                'email_code' => "",
            ]);
        }
    }

    public function resendCode($id)
    {
        $emailVerification = ModelsEmailVerification::where('user_id', $id)->first();
        if ($emailVerification) {
            $generateCode = $this->generateCode();
            $emailVerification->update([
                'email_code' => $generateCode,
            ]);
            $user = User::findOrFail($id);
            $response = $this->sendEmailCode($user->email, $emailVerification->email_code);
            return response()->json([$response]);
        }
    }

    public function sendEmailCode($email, $code)
    {
        $data = [
            "subject" => "Plantify Verification Mail",
            "code" => $code,
            "email" => $email,
            // "password" => $generate_password,
        ];
        // return json_encode($data);

        try {
            Mail::to($email)->send(new MailVerificationCode($data));
            return response()->json(['Great! Successfully sent in your mail']);
        } catch (Exception $e) {
            $error = Log::error($e->getMessage());
            return response()->json($error);
        }
        // return $email;
    }

    public function changePassword(Request $request, $id)
    {
        // $l = $request->query('l');
        // $verifyhash = $this->plantifyLibrary->verifydatafromhashid($l);

        $validator = Validator::make($request->all(), [
            'password' => [
                'required',
                'string',
                'confirmed',
                'min:8',
                'regex:/[A-Z]+/',
                'regex:/[a-z]+/',
                'regex:/[0-9]+/',
                'regex:/[!@#$%^&*(),.?":{}|<>]+/'
            ],
        ], [
            'password.required' => 'Password is required.',
            'password.string' => 'Password must be a string.',
            'password.confirmed' => 'Password confirmation does not match.',
            'password.min' => 'Password must be at least :min characters.',
            'password.regex' => 'Password format is incorrect. It must contain at least one uppercase letter, one lowercase letter, one digit, and one special character.'
        ]);
        // dd($validator);

        if ($validator->fails()) {
            $generateHash = $this->plantifyLibrary->generatehash($id);
            $url = url('/verify-email') . '?l=' . $generateHash;
            return redirect($url)->withErrors($validator)->withInput();
        }

        $user = User::findOrFail($id);

        $password = Hash::make($request->input('password'));

        $user->update([
            'password' => $password,
        ]);

        return redirect()->route('login')->with('error', 'User not found.');
    }

    public function showForgotPasswordForm()
    {
        return view('pages.forgot-password');
    }

    public function changePasswordView(Request $request)
    {
        $l = $request->query('l');
        $verifyhash = $this->plantifyLibrary->verifydatafromhashid($l);

        $user = User::where('id', $verifyhash)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'User not found.');
        }

        return view('pages.change-password', ['user' => $user]);
    }

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $email = $request->input('email');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $validator->errors()->add('email', 'Email not found');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $id = $user->id;

        $generateHash = $this->plantifyLibrary->generatehash($id);
        $url = url('/change-password') . '?l=' . $generateHash;

        $data = [
            "subject" => "Forgot Password Link",
            "email" => $email,
            "link" => $url,
            // "password" => $generate_password,
            "body" => "Join the urban green revolution !",
        ];

        Mail::to($email)->send(new MailForgot($data));

        Session::flash('success', 'Forgot password link has been sent to your email.');

        return redirect()->back();
    }
}
