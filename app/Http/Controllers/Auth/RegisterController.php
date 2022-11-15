<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class RegisterController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

    public function showRegistrationForm() {
        session()->flash('message.level', 'error');
        session()->flash('message.color', 'red');
        session()->flash('message.content', 'you need a referral link to register');
        return redirect('login');
    }

    public function showRegistrationNew() {
        $data['sponsor'] = null;
        return view('auth.register', $data);
    }

    public function showRegistration($ref) {
        //save the sponsor whenever user registered we captioned it 
        $user_ref = Session::get('sponsor');
        if (!empty($ref)) {
            $owner = User::whereUsername($ref)->first();
            if (!is_object($owner)) {
                $data['sponsor'] = null;
                return view('auth.register', $data);
            }
            $data['sponsor'] = $ref;
            session(['sponsor' => $ref]);
            $first = $owner->first_name;
            $last = $owner->last_name;
            $data['name'] = ucfirst($first) . ' ' . ucfirst($last);
            return view('auth.register', $data);
        } elseif (!empty($user_ref)) {
            $owner = User::whereUsername($user_ref)->first();
            if (!is_object($owner)) {
                $data['sponsor'] = null;
                return view('auth.register', $data);
            }
            $first = $owner->first_name;
            $last =$owner->last_name;
            $data['name'] = ucfirst($first) . ' ' . ucfirst($last);
            return view('auth.register', $data);
        } else {
            $data['sponsor'] = null;
            return view('auth.register', $data);
        }
    }

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data) {
        return User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
        ]);
    }

}
