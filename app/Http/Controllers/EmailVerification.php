<?php

namespace App\Http\Controllers;

use App\Libraries\PlantifyLibrary;
use App\Models\EmailVerification as ModelsEmailVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Redirect;

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
            ]);
        }
        $email = $user->email;

        //sleep(300);
        //$this->emptyCode($user->id);

        return view('pages.email-verification', ['user' => $user]);
    }

    public function verifyEmail(Request $request)
    {
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
}
