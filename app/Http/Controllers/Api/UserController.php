<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Controllers\Traits\HasError;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use DB;
use Illuminate\Support\Str;
use App\Models\Reference;
use App\Mail\MailSender;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Crypt;

class UserController extends Controller {

    use HasError;

    public function register(Request $request) {
        $input = $request->all();
        $rules = ([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'confirm_password' => 'required|same:password'
        ]);

        $error = static::getErrorMessage($input, $rules);
        if ($error) {
            return $error;
        }

        DB::beginTransaction();
        try {
            $rand = strtoupper(Str::random(6));
            $verify_code = random_int(1000, 9999);
            $input['verified_code'] = $verify_code;
            $input['type'] = 'user';
            $input['ref_check'] = $rand;
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            if ($request->ref) {
                $owner = User::whereRef_check($request->ref)->first();
                if (!is_object($owner)) {
                    session()->forget('sponsor');
                    return ([
                        'status' => 422,
                        'message' => 'Invalid Ref User'
                    ]);
                }
                //creste
                Reference::create([
                    'user_id' => $owner->id,
                    'referred_id' => $user->id
                ]);
                //send mail
                $email = $owner->email;
                $greeting = "Hello $owner->first_name $owner->last_name ,";
                $subject = 'Referral Notification';
                $message = $user->first_name . ' ' . $user->last_name . ' registered with your referral link';
                Mail::to($email)->send(new MailSender($subject, $greeting, $message, '', ''));
            }

            $subject = 'Account activation';
            $message = "Please, complete your registration by using this code: $verify_code";
            $greeting = "Hello $user->first_name $user->last_name ,";
            Mail::to($user->email)->send(new MailSender($subject, $greeting, $message, '', ''));
            session()->forget('sponsor');
            Auth::login($user);
            $token = $user->createToken('fxgeneral')->accessToken;
            $storetoken = User::firstOrNew(array('email' => $user->email));
            $storetoken->token = $token;
            $storetoken->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return ([
            'status' => 200,
            'message' => 'Registration Completed',
            'user' => $storetoken->makeVisible(['token'])
        ]);
    }

    public function login(Request $request) {
        $remember_me = $request->has('remember') ? true : false;
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')], $remember_me)) {
            $user = Auth::user()->makeVisible('token');
            if ($user->google2fa_secret_status == true) {
                Auth::logout();
                Cache::put('2fa:user:id', $user->id, 2233 * 60);
                return ([
                    'status' => 400,
                    'message' => '2factor Check'
                ]);
            }
            if ($user->code == true) {
                DB::table('oauth_access_tokens')->where('user_id', $user->id)->where('expires_at', '<', Carbon::now())->delete();
                $check = DB::table('oauth_access_tokens')->where('user_id', $user->id)->first();
                if (empty($check)) {
                    $token = $user->createToken('fxgeneral')->accessToken;
                    $storetoken = User::firstOrNew(array('email' => $user->email));
                    $storetoken->token = $token;
                    $storetoken->save();
                } else {
                    DB::table('oauth_access_tokens')
                            ->where('user_id', $user->id)
                            ->update(['revoked' => 0]);
                    $token = $user->token;
                }
                return ([
                    'status' => 200,
                    'message' => 'Login Successfully',
                    'user' => Auth::user()->makeVisible('token')
                ]);
            } else {
                $verify_code = random_int(1000, 9999);
                $user->update([
                    'verified_code' => $verify_code
                ]);
                $subject = 'Account activation';
                $message = "Please, complete your registration by using this code: $verify_code";
                $greeting = "Hello $user->first_name $user->last_name ,";
                Mail::to($user->email)->send(new MailSender($subject, $greeting, $message, '', ''));
                return ([
                    'status' => 402,
                    'message' => 'Please Verify your email address, new code was sent to your email'
                ]);
            }
        } else {
            return ([
                'status' => 401,
                'message' => 'Invalid Data provided'
            ]);
        }
    }

    public function comfirm(Request $request) {
        $input = $request->all();
        $rules = ([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'password_confirmation' => 'required|same:password'
        ]);
        $error = static::getErrorMessage($input, $rules);

        if ($error) {
            return $error;
        }
        $user = User::whereEmail($request->email)->first();
        if (is_object($user)) {
            $password = bcrypt($input['password']);
            $user->password = $password;
            $user->save();
            return ([
                'status' => 200,
                'message' => 'Password Succesfully Changed'
            ]);
        } else {
            return ([
                'status' => 200,
                'message' => 'Invalid Email Provided'
            ]);
        }
    }

    public function postValidateToken(Request $request) {
        $input = $request->all();
        $rules = ([
            'totp' => 'required|numeric'
        ]);
        $error = static::getErrorMessage($input, $rules);

        if ($error) {
            return $error;
        }

        if (Cache::has('2fa:user:id')) {
            $userId = Cache::get('2fa:user:id');
        } else {
            return ([
                'status' => 401,
                'message' => '2factor failed'
            ]);
        }
        $user = \App\Models\User::whereId($userId)->first()->makeVisible('token');
        $google2fa = new \PragmaRX\Google2FA\Google2FA();
        $secret = $request->totp;
        $user_secret = Crypt::decrypt($user->google2fa_secret);

        $timestamp = $google2fa->verifyKeyNewer($user_secret, $secret, $user->google2fa_ts);

        if ($timestamp !== false) {
            $user->update(['google2fa_ts' => $timestamp]);
            //login and redirect user
            Auth::loginUsingId($userId);
            Cache::forget('2fa:user:id');
            return ([
                'status' => 200,
                'message' => 'Login Successfully',
                'user' => $user
            ]);
        } else {
            return [
                'status' => 401,
                'message' => 'Invalid OTP code was entered'
            ];
        }
    }

    public function passwordReset(Request $request) {
        $input = $request->all();
        $rules = ([
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        $error = static::getErrorMessage($input, $rules);

        if ($error) {
            return $error;
        }

        $user = User::whereEmail($request->email)->first();
        if (!is_object($user)) {
            return ([
                'status' => 401,
                'message' => 'Invalid User'
            ]);
        }

        $verify_code = random_int(1000, 9999);
        DB::table('password_resets')->insert([
            'token' => $verify_code,
            'email' => $request->email,
            'created_at' => Carbon::now()
        ]);

        $subject = 'Password Reset Code';
        $message = "Here is your password reset code: $verify_code";
        $greeting = "Hello $user->first_name $user->last_name ,";
        Mail::to($user->email)->send(new MailSender($subject, $greeting, $message, '', ''));
        return ([
            'status' => 200,
            'message' => 'Password reset token successful sent'
        ]);
    }

    public function passwordResetVerify(Request $request) {
        $input = $request->all();
        $rules = ([
            'code' => 'required|numeric'
        ]);
        $error = static::getErrorMessage($input, $rules);

        if ($error) {
            return $error;
        }

        $code = DB::table('password_resets')->whereToken($request->code)->first();

        if (!is_object($code)) {
            return ([
                'status' => 401,
                'message' => 'Invalid Token'
            ]);
        }
        DB::table('password_resets')->whereToken($request->code)->delete();
        return ([
            'status' => 200,
            'message' => 'Password reset token successful verified'
        ]);
    }

    
}
