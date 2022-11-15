<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use \App\Http\Controllers\Traits\HasError;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Crypt;

class LoginController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles authenticating users for the application and
      | redirecting them to your home screen. The controller uses a trait
      | to conveniently provide its functionality to your applications.
      |
     */

    private $user;

    use AuthenticatesUsers,
        HasError;

    protected function loggedOut(Request $request) {
        return redirect('/login');
    }

    public function getValidateToken() {

        if (session('2fa:user:id')) {
            return view('2fa/validate');
        }

        return redirect('login');
    }

    public function postValidateToken(Request $request) {
        $this->validate($request, [
            'totp' => 'required|numeric'
        ]);
        $userId = Session::get('2fa:user:id');
        $user = \App\Models\User::whereId($userId)->first();
        $google2fa = new \PragmaRX\Google2FA\Google2FA();
        $secret = $request->totp;
        $user_secret = Crypt::decrypt($user->google2fa_secret);

        $timestamp = $google2fa->verifyKeyNewer($user_secret, $secret, $user->google2fa_ts);

        if ($timestamp !== false) {
            $user->update(['google2fa_ts' => $timestamp]);
            //login and redirect user
            Auth::loginUsingId($userId);
            Session::forget('2fa:user:id');
            return redirect()->intended($this->redirectTo);
        } else {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'Invalid 2fa code was entered');
            return Redirect::back();
        }
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/office';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('log_out');
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request) {
        $input = $request->all();
        $rules = ([
            'email' => ['required'],
            'password' => ['required', 'string']
        ]);
        $error = static::getErrorMessageSweet($input, $rules);

        if ($error) {
            return $error;
        }
        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'email';
        if (auth()->attempt(array($fieldType => $input['email'], 'password' => $input['password']))) {
            $user = Auth::user();
            if ($user->google2fa_secret_status == true) {
                Auth::logout();
                $request->session()->put('2fa:user:id', $user->id);
                return redirect('2fa/validate');
            }
            return redirect()->route('office');
        } else {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'error,  invalid data provided');
            return Redirect::back()->withInput();
        }
    }

}
