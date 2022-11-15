<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Admin\Setting;
use Schema;
use Illuminate\Support\Facades\View;
use App\Models\Investment;
use App\Models\Withdraw;
use App\Models\User;
use App\Models\Plan;
use Illuminate\Support\Carbon;

class AppServiceProvider extends ServiceProvider {

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {

        Schema::defaultStringLength(191);
        date_default_timezone_set('Africa/Lagos');
        $setting = Setting::whereId(1)->first();
        View::share('settings', $setting);
        $low_deposit = Plan::whereId(1)->first();
        View::share('low', $low_deposit);
    }

}
