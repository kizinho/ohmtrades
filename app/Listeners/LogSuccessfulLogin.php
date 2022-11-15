<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\User;

class LogSuccessfulLogin {

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request) {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  StoreActivities  $event
     * @return void
     */
    public function handle(Login $event) {
        $ip = request()->getClientIp();
        $user = $event->user;
        User::whereId($user->id)->update(['last_login' => Carbon::now(), 'last_ip' => $ip]);
    }

}
