<?php

namespace App\Http\Controllers;

use \App\Http\Controllers\Traits\HasError;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Mail\MailSender;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
class VerifyController extends Controller {

    use HasError;

    public function __construct() {
        $this->middleware('auth');
    }

    public function verify() {
        return view('auth.verify');
    }

    public function verifyPost(Request $request) {
        $input = $request->all();
        $rules = ([
            'code' => 'required|numeric'
        ]);


        $error = static::getErrorMessageSweet($input, $rules);

        if ($error) {
            return $error;
        }
        $code = User::whereVerified_code($request->code)->first();
        if (is_object($code)) {
            $code->code = true;
            $code->save();
            return redirect('/office');
        } else {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'Invalid Verification Code');
            return redirect()->back();
        }
    }

    public function activate(Request $request) {
        if ($request->user) {
            $user = User::whereVerified_code($request->user)->first();
            if (is_object($user)) {
                $user->code = true;
                $user->save();
                return redirect('/office');
            } else {
                session()->flash('message.level', 'error');
                session()->flash('message.color', 'red');
                session()->flash('message.content', 'Invalid Verification Code');
                return redirect('verify');
            }
        } else {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'Invalid Verification Code');
            return redirect('verify');
        }
    }

    public function resend() {
        $verify_code_rand = strtolower(Str::random(32));
        $verified_code = $verify_code_rand;
        $code = User::whereId(Auth::user()->id)->first();
        if (is_object($code)) {
            $code->verified_code = $verified_code;
            $code->save();
            $subject = 'Verification code resend';
            $message = "Verification code has been resend to you";
            $greeting = "Hello $code->first_name $code->last_name ,";
            $link = url('account-activate?user=' . $code->verified_code);
             $link_name = "Verify";
            Mail::to($code->email)->send(new MailSender($subject, $greeting, $message, $link, $link_name));
            session()->flash('message.level', 'success');
            session()->flash('message.color', 'green');
            session()->flash('message.content', 'Code successfully resend to your email');
            return redirect()->back();
        } else {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'Invalid User');
            return redirect()->back();
        }
    }

}
