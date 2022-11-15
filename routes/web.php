<?php

use Illuminate\Support\Facades\Route;

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */


Route::get('/guest_get-coin', [App\Http\Controllers\FrontController::class, 'getCoin'])->name('guest_get-coin');
Route::get('/', [App\Http\Controllers\FrontController::class, 'index'])->name('welcome');
Route::get('plans', [App\Http\Controllers\FrontController::class, 'plan'])->name('plans');
Route::get('pdf', [App\Http\Controllers\FrontController::class, 'pdf'])->name('pdf');
Route::get('education-pack', [App\Http\Controllers\FrontController::class, 'education'])->name('education-pack');
Route::get('/reset', 'FrontController@reset');
Route::get('about-us', function () {
    return view('pages.about');
});
Route::get('team', function () {
    return view('pages.team');
});

Route::get('faq', function () {
    return view('pages.faq');
});

Route::get('risks', function () {
    return view('pages.risks');
});

Route::get('terms-condition', function () {
    return view('pages.terms-condition');
});
Route::get('become-a-user', function () {
    return view('pages.become-a-user');
});
Route::get('terms-conditions', function () {
    return view('pages.terms-condition');
});
Route::get('terms-of-use', function () {
    return view('pages.terms-of-use');
});


Route::get('privacy-policy', function () {
    return view('pages.privacy-policy');
});
Route::get('become-a-user', function () {
    return view('pages.become-a-user');
});
Route::get('contact-us', function () {
    return view('pages.contact-us');
});
Route::get('ecosystem', function () {
    return view('pages.ecosystem');
});
Route::get('services', function () {
    return view('pages.services');
});
Route::get('referral', function () {
    return view('pages.become-a-partner');
});
Route::get('forex', function () {
    return view('pages.forex');
});

Route::get('faq-categories', [App\Http\Controllers\FrontController::class, 'faq'])->name('faq-categories');
Route::post('contact', 'FrontController@contact');
//my routes
Route::post('confirm', 'UserController@comfirm')->name('confirm');
Route::post('sign-up', 'UserController@register');
Route::get('verify', 'VerifyController@verify')->name('verify');
Route::get('resend', 'VerifyController@resend')->name('resend');
Route::post('verify', 'VerifyController@verifyPost');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/office', [App\Http\Controllers\HomeController::class, 'index'])->name('office');
Route::post('/select-gateway', [App\Http\Controllers\HomeController::class, 'gateway']);
Route::get('/select-gateway', [App\Http\Controllers\HomeController::class, 'gateway'])->name('select-gateway');
Route::get('/deposit-plan', [App\Http\Controllers\HomeController::class, 'createPayment'])->name('deposit-plan');
Route::get('/deposit-plan-payment', [App\Http\Controllers\HomeController::class, 'createPaymentDeposit'])->name('deposit-plan-payment');
Route::post('/deposit-re', [App\Http\Controllers\HomeController::class, 'createDeposit']);
Route::get('/get-plan', [App\Http\Controllers\HomeController::class, 'getPlan'])->name('get-plan');
Route::get('/get-coin', [App\Http\Controllers\HomeController::class, 'getCoin'])->name('get-coin');
//withdraw
Route::get('/withdraw', [App\Http\Controllers\HomeController::class, 'withdraw'])->name('withdraw');
Route::post('/withdraw', [App\Http\Controllers\HomeController::class, 'withdrawPost']);
Route::post('/withdraw-fund', [App\Http\Controllers\HomeController::class, 'withdrawFund'])->name('withdraw-fund');
Route::post('/withdraw-capital', [App\Http\Controllers\HomeController::class, 'withdrawCapital'])->name('withdraw-capital');

//reinvest
Route::post('/reinvest', [App\Http\Controllers\HomeController::class, 'reinvest'])->name('reinvest');
//deposit  history

Route::get('/fund_deposit_history', [App\Http\Controllers\HomeController::class, 'fundDepositHistory'])->name('fund_deposit_history');
Route::get('/transactions', [App\Http\Controllers\HomeController::class, 'transactions'])->name('transactions');
Route::get('/deposit_list', [App\Http\Controllers\HomeController::class, 'depositList'])->name('deposit_list');
Route::get('/deposit_history', [App\Http\Controllers\HomeController::class, 'depositHistory'])->name('deposit_history');
Route::post('/get_history', [App\Http\Controllers\HomeController::class, 'getHistory'])->name('get_history');
Route::get('/account/capital', [App\Http\Controllers\HomeController::class, 'userCapital'])->name('account/capital');
//deposit
//proof
Route::post('/upload-proof', [App\Http\Controllers\HomeController::class, 'uploadProof']);

Route::get('/deposits', [App\Http\Controllers\HomeController::class, 'deposit'])->name('deposits');
Route::get('/account/deposit', [App\Http\Controllers\HomeController::class, 'userDeposit'])->name('account/deposit');
Route::post('/account/deposit', [App\Http\Controllers\HomeController::class, 'userDepositPost']);
//education license
Route::get('account/education-pack', [App\Http\Controllers\HomeController::class, 'userEducationLicense'])->name('account/education-pack');
Route::get('/get-education-license', [App\Http\Controllers\HomeController::class, 'getEducationLicense'])->name('get-education-license');
Route::post('/select-education-plan', [App\Http\Controllers\HomeController::class, 'userEducationPlan']);
Route::get('/account/education-license-history', [App\Http\Controllers\HomeController::class, 'depositHistoryEducationLicense'])->name('account/education-license-history');
Route::get('read/{slug}', 'HomeController@read');
Route::get('/news', [App\Http\Controllers\HomeController::class, 'news'])->name('news');
Route::get('/2fa/enable', 'Google2FAController@enableTwoFactor');
Route::get('/2fa/disable', 'Google2FAController@disableTwoFactor');
Route::get('/2fa/validate', 'Auth\LoginController@getValidateToken');
Route::post('/2fa/validate', ['middleware' => 'throttle:5', 'uses' => 'Auth\LoginController@postValidateToken']);
Route::post('/2fa/pin', 'Google2FAController@pin');

//withdraw history
Route::get('/withdraw_history', [App\Http\Controllers\HomeController::class, 'withdrawHistory'])->name('withdraw_history');
//earnings history
Route::get('/earnings', [App\Http\Controllers\HomeController::class, 'earnings'])->name('earnings');
Route::get('/referrals', [App\Http\Controllers\HomeController::class, 'referals'])->name('referrals');
//edit account
Route::get('/profile/personal', [App\Http\Controllers\HomeController::class, 'edit'])->name('profile/personal');

Route::get('/account/profile/addresses', [App\Http\Controllers\HomeController::class, 'address'])->name('account/profile/addresses');

Route::get('/account/add/{slug}', [App\Http\Controllers\HomeController::class, 'addPref'])->name('account/add');
Route::get('/account/remove/{slug}', [App\Http\Controllers\HomeController::class, 'removePref'])->name('account/remove');

Route::get('/account/remove-withdraw-address/{slug}', [App\Http\Controllers\HomeController::class, 'removeCoin'])->name('account/remove-withdraw-address');
Route::get('/edit_account', [App\Http\Controllers\HomeController::class, 'edit'])->name('edit_account');
Route::post('/edit_account', [App\Http\Controllers\HomeController::class, 'editPost']);
Route::post('/profile/personal', [App\Http\Controllers\HomeController::class, 'editPost']);
Route::post('/confirm-wallet', [App\Http\Controllers\HomeController::class, 'addWallet']);
Route::get('/account-address-wallet', [App\Http\Controllers\HomeController::class, 'wallet'])->name('account-address-wallet');
Route::get('/success-address', [App\Http\Controllers\HomeController::class, 'walletSuccess'])->name('success-address');
Route::get('/get-coin', [App\Http\Controllers\HomeController::class, 'getCoinCal'])->name('get-coin');
//adimn
Route::group(['middleware' => 'can:isAdmin'], function () {
    //compounding
    Route::get('/compounding', 'AdminController@compounding')->name('compounding');
    Route::post('/compounding', 'AdminController@postCompounding');
    //settigs
    Route::get('/settings', 'AdminController@setting')->name('settings');
    Route::get('/mailing', 'AdminController@mailing')->name('mailing');
    Route::post('/mailing', 'AdminController@mailingPost');
    Route::post('/settings', 'AdminController@settingPost');
    //maintain mode
    Route::get('/maintenance', 'AdminController@maintenance')->name('maintenance');
    Route::post('/maintenance', 'AdminController@maintenancePost');
    Route::post('/maintenance-post', 'AdminController@maintenancePostUp')->name('maintenance-post');

//users
    Route::get('/users', 'AdminController@users')->name('users');
    Route::post('add-user', 'AdminController@create');
    Route::post('edit-user', 'AdminController@edit')->name('edit-user');
    Route::post('delete-user', 'AdminController@delete')->name('delete-user');
    Route::get('view-user/{id}', 'AdminController@viewUser')->name('view-user');
    Route::get('user-login/{id}', 'AdminController@login')->name('user-login');
    //kyc
    Route::post('accept-kyc', 'AdminController@kycAccept')->name('accept-kyc');
    Route::post('reject-kyc', 'AdminController@kycReject')->name('reject-kyc');
//deposit
    Route::get('/manage-deposit', 'AdminController@deposit')->name('manage-deposit');
    Route::post('/delete-deposit', 'AdminController@deleteDeposit')->name('delete-deposit');
    Route::post('/confirm-deposit', 'AdminController@confirm')->name('confirm-deposit');
    Route::post('/edit-deposit', 'AdminController@editDeposit')->name('edit-deposit');
//withdraw
    Route::get('/manage-withdraw', 'AdminController@withdraw')->name('manage-withdraw');
    Route::post('/delete-withdraw', 'AdminController@deleteWithdraw')->name('delete-withdraw');
    Route::post('/confirm-withdraw', 'AdminController@confirmWithdraw')->name('confirm-withdraw');
    Route::post('/reject-withdraw', 'AdminController@rejectWithdraw')->name('reject-withdraw');

    //fund deposit
    Route::get('/manage-fund-deposit', 'AdminController@fundDeposit')->name('manage-fund-deposit');
    Route::post('/delete-fund-deposit', 'AdminController@deleteFundDeposit')->name('delete-fund-deposit');
    Route::post('/confirm-fund-deposit', 'AdminController@confirmFundDeposit')->name('confirm-fund-deposit');
//Transactions 
    Route::get('/manage-transaction', 'AdminController@transaction')->name('manage-transaction');
//plan
    Route::get('/plan-setting', 'AdminController@planSetting')->name('plan-setting');
    Route::post('/delete-plan', 'AdminController@deletePlan')->name('delete-plan');
    Route::post('/edit-plan', 'AdminController@editPlan')->name('edit-plan');
    Route::post('/add-plan', 'AdminController@addPlan')->name('add-plan');
    //education license plan
    Route::get('/eduction-plan-setting', 'AdminController@educationPlanSetting')->name('eduction-plan-setting');
    Route::post('/delete-eduction-plan-setting', 'AdminController@deleteEducationPlanSetting')->name('delete-eduction-plan-setting');
    Route::post('/edit-eduction-plan-setting', 'AdminController@editEducationPlanSetting')->name('edit-eduction-plan-setting');
    Route::post('/add-eduction-plan-setting', 'AdminController@addEducationPlanSetting')->name('add-eduction-plan-setting');
    //send signals
    Route::get('send-signals', 'AdminController@sendSignal')->name('send-signals');
    Route::post('/delete-signals', 'AdminController@deleteSignal')->name('delete-signals');
    Route::post('/edit-signals', 'AdminController@editSignal')->name('edit-signals');
    Route::post('/add-signals', 'AdminController@addSignal')->name('add-signals');
    Route::get('edit-signals-single', 'AdminController@editSingleSignal')->name('edit-signals-single');



    Route::get('/manage-education-user-sub', 'AdminController@depositEducationLicense')->name('manage-education-user-sub');
    Route::post('/delete-deposit-education-license', 'AdminController@deleteDepositEducationLicense')->name('delete-deposit-education-license');
    Route::post('/confirm-deposit-education-license', 'AdminController@confirmEducationLicense')->name('confirm-deposit-education-license');
//compound
    Route::get('/compound-setting', 'AdminController@compoundSetting')->name('compound-setting');
    Route::post('/delete-compound', 'AdminController@deleteCompound')->name('delete-compound');
    Route::post('/edit-compound', 'AdminController@editCompound')->name('edit-compound');
    Route::post('/add-compound', 'AdminController@addCompound')->name('add-compound');
    //coin setting
    Route::get('/coin-setting', 'AdminController@coinSetting')->name('coin-setting');
    Route::post('/delete-coin', 'AdminController@deleteCoin')->name('delete-coin');
    Route::post('/edit-coin', 'AdminController@editCoin')->name('edit-coin');
    Route::post('/add-coin', 'AdminController@addCoin')->name('add-coin');
    //fund
    Route::post('/fund', 'AdminController@fund')->name('fund');
});

Route::get('/account-activate', [App\Http\Controllers\VerifyController::class, 'activate'])->name('account-activate');
//Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationNew'])->name('register');
Route::get('{ref}', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistration'])->name('register');
