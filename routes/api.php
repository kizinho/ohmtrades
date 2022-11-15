<?php

use Illuminate\Support\Facades\Route;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */
//unprotected
Route::group(['prefix' => 'v1'], function () {
    Route::post('confirm', 'Api\UserController@comfirm');
    Route::post('sign-up', 'Api\UserController@register');
    Route::post('login', 'Api\UserController@login');
    Route::post('password-reset', 'Api\UserController@passwordReset');
    Route::post('password-reset-verify', 'Api\UserController@passwordResetVerify');
    Route::post('confirm-reset-password', 'Api\UserController@comfirm');
    Route::post('verify', 'Api\VerifyController@verifyPost');
    Route::post('two-factor-token', 'Api\UserController@postValidateToken');


    //protected
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('resend', 'Api\VerifyController@resend');
        Route::get('home', 'Api\HomeController@index');
        //plan
        Route::get('plan', 'Api\HomeController@plan');
        Route::get('/get-coin', 'Api\HomeController@getCoinCal');
        Route::post('/select-gateway', 'Api\HomeController@gateway');
        Route::get('/deposit-plan', 'Api\HomeController@createPayment');
        //education plan
        Route::get('education-plan', 'Api\HomeController@educationPlan');
        Route::get('/get-education-license', 'Api\HomeController@getEducationLicense');
        Route::post('/select-education-plan-gateway', 'Api\HomeController@userEducationPlan');
        //user deposit
        Route::post('/user-deposit', 'Api\HomeController@userDepositPost');
        //wallet
        Route::get('/user-addresses', 'Api\HomeController@address');
        Route::post('/add-wallet', 'Api\HomeController@addWallet');
        Route::post('/confirm-wallet', 'Api\HomeController@wallet');
        Route::get('/add-preferable/{slug}', 'Api\HomeController@addPref');
        Route::get('/remove-preferable/{slug}', 'Api\HomeController@removePref');
        Route::get('/remove-wallet/{slug}', 'Api\HomeController@removeCoin');
        //transaction
        Route::get('/transactions', 'Api\HomeController@transactions');
        Route::get('/deposit_history', 'Api\HomeController@depositHistory');
        Route::get('/plan_deposit_history', 'Api\HomeController@planDepositHistory');
        Route::get('/education_license_history', 'Api\HomeController@depositHistoryEducationLicense');
        Route::get('/withdraw_history', 'Api\HomeController@withdrawHistory');
        //news
        Route::get('/signals-news', 'Api\HomeController@singalNews');
        Route::get('read/{slug}', 'Api\HomeController@read');
        //referal
        Route::get('/referrals', 'Api\HomeController@referals');
        //user profile
        Route::get('/profile', 'Api\HomeController@edit');
        Route::post('/profile', 'Api\HomeController@editProfile');
        //2factor
        Route::get('/2fa/enable', 'Api\Google2FAController@enableTwoFactor');
        Route::get('/2fa/disable', 'Api\Google2FAController@disableTwoFactor');
    });
});
