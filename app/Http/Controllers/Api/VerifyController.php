<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use \App\Http\Controllers\Traits\HasError;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Mail\MailSender;
use Illuminate\Support\Facades\Mail;

class VerifyController extends Controller {

    use HasError;

    public function verifyPost(Request $request) {
        $input = $request->all();
        $rules = ([
            'code' => 'required|numeric'
        ]);
        $error = static::getErrorMessage($input, $rules);

        if ($error) {
            return $error;
        }
        $code = User::whereVerified_code($request->code)->first();
        if (is_object($code)) {
            if ($code->code == true) {
                return ([
                    'status' => 200,
                    'message' => 'Account already Verified',
                    'user' => $code->makeVisible(['token'])
                ]);
            }
            $code->code = true;
            $code->save();
            return ([
                'status' => 200,
                'message' => 'Account Verified',
                'user' => $code->makeVisible(['token'])
            ]);
        } else {
            return ([
                'status' => 401,
                'message' => 'Invalid Verification Code'
            ]);
        }
    }

    public function resend() {
        $verify_code_rand = random_int(1000, 9999);
        $verified_code = $verify_code_rand;
        $code = User::whereId(Auth::user()->id)->first();
        if (is_object($code)) {
            $code->verified_code = $verified_code;
            $code->save();
            $subject = 'Verification code resend';
            $message = "Your new verification code is : $code->verified_code";
            $greeting = "Hello $code->first_name $code->last_name ,";
            Mail::to($code->email)->send(new MailSender($subject, $greeting, $message, '', ''));
            return ([
                'status' => 200,
                'message' => 'Otp successfully resend to your email'
            ]);
        } else {
            return [
                'status' => 401,
                'message' => 'Invalid User'
            ];
        }
    }

}
