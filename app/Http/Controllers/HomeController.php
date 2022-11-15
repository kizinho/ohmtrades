<?php

namespace App\Http\Controllers;

use App\Models\UserCoin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Investment;
use App\Models\Withdraw;
use App\Models\Plan;
use App\Models\Coin;
use \App\Http\Controllers\Traits\HasError;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Mail\PlanDepositMail;
use App\Models\Admin\Setting;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use App\Models\Reference;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Models\userTrackEarn;
use Illuminate\Support\Facades\Session;
use App\Models\UserWithdrawal;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\ErrorCorrectionLevel;
use App\Mail\MailSender;
use App\Models\EducationLicensePlan;
use App\Models\UserEducationLicensePlan;
use App\Models\EducationLicenseSignal;
use App\Models\DepositMessage;
use App\Models\DepositProof;
use \App\Http\Controllers\Traits\AffiliateProgram;

class HomeController extends Controller {

    use HasError,
        AffiliateProgram;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('register_verify');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $data['total_balance'] = UserWithdrawal::whereUser_id(Auth::user()->id)->sum('amount');
        $data['total_deposit'] = Investment::whereUser_id(Auth::user()->id)->whereStatus_deposit(1)->sum('amount');
        $data['active_deposit'] = Investment::whereUser_id(Auth::user()->id)->whereStatus_deposit(1)->whereStatus(0)->sum('amount');
        $data['pending_deposit'] = Investment::whereUser_id(Auth::user()->id)->whereStatus_deposit(0)->whereStatus(0)->sum('amount');
        $data['completed_deposit'] = Investment::whereUser_id(Auth::user()->id)->whereStatus_deposit(1)->whereStatus(1)->sum('amount');
        $data['last_deposit'] = Investment::whereUser_id(Auth::user()->id)->orderBy('created_at', 'desc')->take(1)->pluck('amount')->first();
        $data['total_withdraw'] = Withdraw::whereUser_id(Auth::user()->id)->sum('amount');
        $data['completed_withdraw'] = Withdraw::whereUser_id(Auth::user()->id)->whereStatus(1)->sum('amount');
        $data['active_withdraw'] = Withdraw::whereUser_id(Auth::user()->id)->whereStatus(0)->whereConfirm(1)->sum('amount');
        $data['pending_withdraw'] = Withdraw::whereUser_id(Auth::user()->id)->whereStatus(0)->sum('amount');
        $data['last_withdraw'] = Withdraw::whereUser_id(Auth::user()->id)->orderBy('created_at', 'desc')->take(1)->pluck('amount')->first();
        $data['earned'] = Transaction::whereUser_id(Auth::user()->id)->whereName_type('Weekly Profit')->whereStatus(true)->sum('amount');
        $data['monthly'] = Transaction::whereUser_id(Auth::user()->id)->whereName_type('Monthly Profit')->whereStatus(true)->sum('amount');
        $data['last_plan'] = Investment::whereUser_id(Auth::user()->id)->orderBy('created_at', 'desc')->take(1)->first();
        $data['bonus'] = Transaction::whereUser_id(Auth::user()->id)->whereType('Commissions')->whereStatus(true)->sum('amount');
        $data['name_ref'] = Reference::whereReferred_id(Auth::user()->id)->first();

        $data['deposits'] = Investment::whereNotNull('due_pay')->orderBy('created_at', 'desc')->paginate(10);

        $data['withdraws'] = Withdraw::orderBy('created_at', 'desc')->paginate(10);
        $data['active_invests'] = Investment::whereUser_id(Auth::user()->id)->orderBy('created_at', 'desc')->get();
        $data['transactions'] = Transaction::whereUser_id(Auth::user()->id)->orderBy('created_at', 'desc')->take(8)->get();
        $data['transactions_admin'] = Transaction::orderBy('created_at', 'desc')->take(12)->get();

        $data['user_coins'] = UserCoin::whereUser_id(Auth::user()->id)->get();
        $data['refs'] = Reference::whereUser_id(Auth::user()->id)->orderBy('created_at', 'desc')->with('userRef')->get();
        $data['ranking'] = Reference::whereUser_id(Auth::user()->id)->count();
        $data['paid'] = Investment::whereUser_id(Auth::user()->id)->whereStatus_deposit(1)->count();

        $data['refs'] = Reference::whereUser_id(Auth::user()->id)->orderBy('created_at', 'desc')->with('userRef')->get();
        $direct = 0;
        $indirect = 0;
        if (is_object($data['refs'])) {
            $second = [];
            foreach ($data['refs'] as $value) {
                foreach ($value->userRef as $valueFindNew) {
                    if (empty($valueFindNew->activeIn)) {
                        $indirect += 1;
                    } else {
                        $direct += 1;
                    }
                }



                $find = Reference::whereUser_id($value->referred_id)->orderBy('created_at', 'desc')->with('userRef')->get();
                if (!$find->isEmpty()) {
                    $second[] = $find;
                }
            }

            if (!empty($second)) {
                $data['second_refs'] = $second[0];

                $third = [];
                foreach ($data['second_refs'] as $value) {
                    foreach ($value->userRef as $valueFindNew) {
                        if (empty($valueFindNew->activeIn)) {
                            $indirect += 1;
                        } else {
                            $direct += 1;
                        }
                    }
                    $find = Reference::whereUser_id($value->referred_id)->orderBy('created_at', 'desc')->with('userRef')->get();
                    if (!$find->isEmpty()) {

                        $third[] = $find;
                    }
                }
                if (!empty($third)) {
                    $data['third_refs'] = $third[0];


                    $fourth = [];
                    foreach ($data['third_refs'] as $value) {
                        foreach ($value->userRef as $valueFindNew) {
                            if (empty($valueFindNew->activeIn)) {
                                $indirect += 1;
                            } else {
                                $direct += 1;
                            }
                        }
                        $find = Reference::whereUser_id($value->referred_id)->orderBy('created_at', 'desc')->with('userRef')->get();
                        if (!$find->isEmpty()) {

                            $fourth[] = $find;
                        }
                    }

                    if (!empty($fourth)) {
                        $data['fourth_refs'] = $fourth[0];

                        $five = [];
                        foreach ($data['fourth_refs'] as $value) {
                            foreach ($value->userRef as $valueFindNew) {
                                if (empty($valueFindNew->activeIn)) {
                                    $indirect += 1;
                                } else {
                                    $direct += 1;
                                }
                            }
                            $find = Reference::whereUser_id($value->referred_id)->orderBy('created_at', 'desc')->with('userRef')->get();
                            if (!$find->isEmpty()) {

                                $five[] = $find;
                            }
                        }

                        if (!empty($five)) {
                            $data['five_refs'] = $five[0];

                            $six = [];

                            foreach ($data['five_refs'] as $value) {
                                foreach ($value->userRef as $valueFindNew) {
                                    if (empty($valueFindNew->activeIn)) {
                                        $indirect += 1;
                                    } else {
                                        $direct += 1;
                                    }
                                }
                                $find = Reference::whereUser_id($value->referred_id)->orderBy('created_at', 'desc')->with('userRef')->get();
                                if (!$find->isEmpty()) {

                                    $six[] = $find;
                                }
                            }
                            if (!empty($six)) {
                                $data['six_refs'] = $six[0];

                                $seven = [];

                                foreach ($data['six_refs'] as $value) {
                                    foreach ($value->userRef as $valueFindNew) {
                                        if (empty($valueFindNew->activeIn)) {
                                            $indirect += 1;
                                        } else {
                                            $direct += 1;
                                        }
                                    }
                                    $find = Reference::whereUser_id($value->referred_id)->orderBy('created_at', 'desc')->with('userRef')->get();
                                    if (!$find->isEmpty()) {

                                        $seven[] = $find;
                                    }
                                }

                                if (!empty($seven)) {
                                    $data['seven_refs'] = $seven[0];
                                    $eight = [];

                                    foreach ($data['seven_refs'] as $value) {
                                        foreach ($value->userRef as $valueFindNew) {
                                            if (empty($valueFindNew->activeIn)) {
                                                $indirect += 1;
                                            } else {
                                                $direct += 1;
                                            }
                                        }
                                        $find = Reference::whereUser_id($value->referred_id)->orderBy('created_at', 'desc')->with('userRef')->get();
                                        if (!$find->isEmpty()) {

                                            $eight[] = $find;
                                        }
                                    }

                                    if (!empty($eight)) {
                                        $data['eight_refs'] = $eight[0];
                                        $nine = [];

                                        foreach ($data['eight_refs'] as $value) {
                                            foreach ($value->userRef as $valueFindNew) {
                                                if (empty($valueFindNew->activeIn)) {
                                                    $indirect += 1;
                                                } else {
                                                    $direct += 1;
                                                }
                                            }
                                            $find = Reference::whereUser_id($value->referred_id)->orderBy('created_at', 'desc')->with('userRef')->get();
                                            if (!$find->isEmpty()) {

                                                $nine[] = $find;
                                            }
                                        }

                                        if (!empty($nine)) {
                                            $data['nine_refs'] = $nine[0];
                                            $ten = [];

                                            foreach ($data['nine_refs'] as $value) {
                                                foreach ($value->userRef as $valueFindNew) {
                                                    if (empty($valueFindNew->activeIn)) {
                                                        $indirect += 1;
                                                    } else {
                                                        $direct += 1;
                                                    }
                                                }
                                                $find = Reference::whereUser_id($value->referred_id)->orderBy('created_at', 'desc')->with('userRef')->get();
                                                if (!$find->isEmpty()) {

                                                    $ten[] = $find;
                                                }
                                            }

                                            if (!empty($ten)) {
                                                $data['ten_refs'] = $ten[0];

                                                foreach ($data['ten_refs'] as $value) {
                                                    foreach ($value->userRef as $valueFindNew) {
                                                        if (empty($valueFindNew->activeIn)) {
                                                            $indirect += 1;
                                                        } else {
                                                            $direct += 1;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        $data['direct'] = $direct;
        $data['indirect'] = $indirect;



        //admin
        $data['users'] = User::count();
        $data['all_deposits'] = Investment::whereStatus_deposit(1)->count();
        $data['all_withdraws'] = Withdraw::count();
        $data['plans'] = Plan::count();
        $data['active_investment'] = Investment::where('due_pay', '>', Carbon::now())->count();
        $data['completed_investment'] = Investment::whereStatus(true)->count();
        $data['pending_investment'] = Investment::whereStatus_deposit(false)->count();
        $data['confirm_investment'] = Investment::whereStatus_deposit(true)->count();
        $data['withdraws_pending'] = Withdraw::whereStatus(false)->count();
        $data['withdraws_complete'] = Withdraw::whereStatus(true)->count();
        $data['admin_transactions'] = Transaction::orderBy('created_at', 'desc')->take(8)->get();

        $data['all_total_balance'] = number_format(UserWithdrawal::whereStatus(true)->sum('amount'), 2);
        $data['all_total_deposit'] = Investment::whereStatus_deposit(1)->sum('amount');
        $data['all_active_deposit'] = Investment::whereStatus_deposit(1)->whereStatus(0)->sum('amount');
        $data['all_earned'] = number_format(UserWithdrawal::whereType('Profit')->whereStatus(true)->sum('amount'), 2);
        $data['all_ref_balance'] = number_format(UserWithdrawal::whereType('Referral Bonus')->whereStatus(true)->sum('amount'), 2);

        $data['plans'] = Plan::all();

        //education signal
        $data['signals'] = EducationLicenseSignal::orderBy('created_at', 'desc')->get();
        $userSignalSub = UserEducationLicensePlan::whereUser_id(Auth::user()->id)->where('due_pay', '>', Carbon::now())->first();
        if (is_object($userSignalSub)) {
            $data['active'] = true;
        } else {
            $data['active'] = false;
        }

        return view('home', $data);
    }

    public function userCapital() {
        $userCapital = UserWithdrawal::whereUser_id(Auth::user()->id)->whereType('Main Balance')->whereStatus(false)->sum('amount');
        if ($userCapital == 0) {
            Mail::to(Auth::user()->email)->send(new MailSender('Captial investment', Auth::user()->first_name . ' ' . Auth::user()->last_name, 'no matured capital at the moment', '', ''));
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', "no matured capital at the moment ");
            return redirect()->back();
        }
        $userMoney = userTrackEarn::firstOrNew(array('user_id' => (Auth::user()->id)));
        $userMoney->amount = $userMoney->amount + $userCapital;
        $userMoney->save();
        UserWithdrawal::whereIn('user_id', [Auth::user()->id])->update([
            'status' => true,
            'main_invest' => true,
            'main_paid' => true,
        ]);

        Mail::to(Auth::user()->email)->send(new MailSender('Captial investment', Auth::user()->first_name . ' ' . Auth::user()->last_name, 'Your capital is now taken and please wait for the next withdrawal payment', '', ''));


        session()->flash('message.level', 'success');
        session()->flash('message.color', 'green');
        session()->flash('message.content', 'Your capital is now taken and please wait for the next withdrawal payment');
        return redirect('office');
    }

    public function transactions() {
        $data['transactions'] = Transaction::whereUser_id(Auth::user()->id)->orderBy('created_at', 'desc')->paginate(15);

        return view('user.all_transactions', $data);
    }

    public function news() {
        $userSignalSub = UserEducationLicensePlan::whereUser_id(Auth::user()->id)->where('due_pay', '>', Carbon::now())->first();
        if (is_object($userSignalSub)) {
            $data['signals'] = EducationLicenseSignal::orderBy('created_at', 'desc')->paginate(15);
            return view('user.education.details', $data);
        } else {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', "Please subscribe to Education License to view this page");
            return redirect('account/education-pack');
        }
    }

    public function read($slug) {
        $userSignalSub = UserEducationLicensePlan::whereUser_id(Auth::user()->id)->where('due_pay', '>', Carbon::now())->first();
        if (is_object($userSignalSub)) {
            $data['signal'] = EducationLicenseSignal::whereSlug($slug)->firstOrFail();
            return view('user.education.read', $data);
        } else {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', "Please subscribe to Education License to view the link");
            return redirect('office');
        }
    }

    public function deposit() {
        $data['coins'] = Coin::orderBy('created_at', 'asc')->whereStatus(true)->get();
        $data['plans'] = Plan::all()->except([12]);
        return view('user.deposit', $data);
    }

    public function success() {
        return view('user.success');
    }

    //education License
    public function userEducationLicense() {
        $data['plans'] = EducationLicensePlan::all();
        return view('user.education.buy_license', $data);
    }

    public function getEducationLicense(Request $request) {

        $plan = EducationLicensePlan::whereId($request->plan_id)->first();
        $general_coin = file_get_contents('https://api.coincap.io/v2/assets');
        $eth = $general_coin;
        $ethereum = json_decode($eth);
        $ethereum_final = $ethereum->data[1]->priceUsd;
        $data['eth'] = number_format(floatval($plan->amount / $ethereum_final), 6, '.', '');
        $all = file_get_contents("https://blockchain.info/ticker");
        $res = json_decode($all);
        $btcrate = $res->USD->last;
        $data['btc'] = number_format(floatval($plan->amount / $btcrate), 6, '.', '');
        $data['amount'] = number_format($plan->amount);
        $data['direct_bonus'] = number_format($plan->number_traders);
        $data['amount'] = number_format($plan->amount);
        $data['return'] = $plan->compound->name;
        $data['plan'] = $plan->id;
        return $data;
    }

    public function userEducationPlan(Request $request) {
        $input = $request->all();

        $rules = [
            'plan' => 'required'
        ];
        $error = static::getErrorMessageSweet($input, $rules);
        if ($error) {
            return $error;
        }
        $all = file_get_contents("https://blockchain.info/ticker");
        $res = json_decode($all);
        $btcrate = $res->USD->last;
        try {
            $general_coin = file_get_contents('https://api.blockchain.com/v3/exchange/tickers/ETH-USD');
        } catch (\Exception $e) {

            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'Checking amount in Crypto failed ');
            return redirect()->back();
        }
        $eth = $general_coin;
        $ethereum = json_decode($eth);
        $ethereum_final = $ethereum->last_trade_price;
        $amount = EducationLicensePlan::whereId($request->plan)->first();
        $data['eth_amount'] = number_format(floatval($amount->amount / $ethereum_final), 6, '.', '');
        $data['eth_name'] = "ETH";

        $data['btc_amount'] = number_format(floatval($amount->amount / $btcrate), 6, '.', '');
        $data['btc_name'] = "BTC";

        $data_payment = ([
            'amount' => $amount->amount,
            'type' => 'EducationLicense',
            'plan' => $request->plan,
            'btc_amount' => $data['btc_amount'],
            'eth_amount' => $data['eth_amount']
        ]);
        $request->session()->put('gateway', $data_payment);
        $data['gateway'] = Session::get('gateway');
        $data['coins'] = Coin::orderBy('created_at', 'asc')->whereStatus(true)->get();



        return view('user.select-gateway', $data);
    }

    ///deposit
    public function userDeposit() {
        return view('user.user-deposit');
    }

    public function userDepositPost(Request $request) {
        $input = $request->all();

        $rules = [
            'amount' => 'required|numeric'
        ];
        $error = static::getErrorMessageSweet($input, $rules);
        if ($error) {
            return $error;
        }
        $all = file_get_contents("https://blockchain.info/ticker");
        $res = json_decode($all);
        $btcrate = $res->USD->last;
        try {
            $general_coin = file_get_contents('https://api.blockchain.com/v3/exchange/tickers/ETH-USD');
        } catch (\Exception $e) {

            return [
                'status' => 'error',
                'message' => 'Server  Busy , Try Again'
            ];
        }
        $eth = $general_coin;
        $ethereum = json_decode($eth);
        $ethereum_final = $ethereum->last_trade_price;
        $data['eth_amount'] = number_format(floatval($request->amount / $ethereum_final), 6, '.', '');
        $data['eth_name'] = "ETH";

        $data['btc_amount'] = number_format(floatval($request->amount / $btcrate), 6, '.', '');
        $data['btc_name'] = "BTC";

        $data_payment = ([
            'amount' => $request->amount,
            'type' => 'deposit',
            'btc_amount' => $data['btc_amount'],
            'eth_amount' => $data['eth_amount']
        ]);
        $request->session()->put('gateway', $data_payment);
        $data['gateway'] = Session::get('gateway');
        $data['coins'] = Coin::orderBy('created_at', 'asc')->whereStatus(true)->get();



        return view('user.select-gateway', $data);
    }

    public function getPlan(Request $request) {
        $min = Plan::whereId($request->plan_id)->first();

        $data['min'] = $min->min;
        $data['sign'] = '$';
        $data['profit'] = '$' . $min->min * $min->percentage / 100;

        $data['amount'] = "$$min->min-$$min->max";
        $data['percentage'] = $min->percentage . '%';
        $data['p_id'] = $min->id;
        return $data;
    }

    public function getCoin(Request $request) {
        $usercoin = UserCoin::whereUser_id(Auth::user()->id)->first();
        if (is_object($usercoin)) {


            $data['usermoney'] = '$' . $usercoin->amount;
            $plan = Plan::whereId($request->plan_id)->first();

            if ($usercoin->amount < $plan->min) {
                $data['message_danger'] = 'You are not Eligble to Spend , Please Click Spend to Deposit  ';
                $data['status'] = 401;
            } else {
                $data['message_success'] = 'You are Eligble to Spend Fund from this Address , Please Click Spend to Invest';
                $data['status'] = 200;
            }
        } else {
            $data['message_danger'] = 'You Need to Add this Coin, Go to your Account Setting to add it ';
            $data['status'] = 401;
        }

        return $data;
    }

    public function address() {
        $data['user'] = User::whereId(Auth::user()->id)->with('coin')->first();
        $data['coinsEnable'] = Coin::whereStatus(true)->with('usercoinUser')->whereStatus(true)->get();
        return view('user.address', $data);
    }

    public function addWallet(Request $request) {
        $input = $request->all();
        $rules = [
            'preferable' => 'required',
            'wallet_type' => 'required',
            'address' => 'required'
        ];
        $error = static::getErrorMessageSweet($input, $rules);
        if ($error) {
            return $error;
        }

        //check perf
        if ($request->preferable == 1) {
            $userp = UserCoin::whereUser_id(Auth::user()->id)->wherePreferable(true)->first();
            if (is_object($userp)) {

                session()->flash('message.level', 'error');
                session()->flash('message.color', 'red');
                session()->flash('message.content', "you can't have more than 1 preferable wallet");
                return redirect('account/profile/addresses');
            }
        }
        $usercoin = UserCoin::firstOrNew(array('user_id' => (Auth::user()->id), 'coin_id' => $request->wallet_type));

        $usercoin->user_id = Auth::user()->id;
        $usercoin->coin_id = $request->wallet_type;
        $usercoin->preferable = $request->preferable;
        $usercoin->address = $request->address;
        $usercoin->save();
//        $data_address = ([
//            'user_id' => $request->id,
//            'wallet_type' => $request->wallet_type,
//            'preferable' => $request->preferable,
//            'address' => $request->address,
//            'verify_code' => $verify_code
//        ]);
//        $request->session()->put('address', $data_address);
        //send mail
        $coin = $usercoin->coin->name;
        $subject = 'New Wallet address added';
        $message = "You have successfully added $coin address to your account.";
        $name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        $greeting = "Hello $name ,";
        Mail::to(Auth::user()->email)->send(new MailSender($subject, $greeting, $message, '', ''));
        return redirect('account/profile/addresses');
    }

    public function walletSuccess() {
        return view('user.address-success');
    }

    public function wallet(Request $request) {
        $address = Session::get('address');
        if (empty($address)) {

            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'Adding of new wallet failed');
            return redirect('account/profile/addresses');
        }
        if ($address['verify_code'] == $request->confirm) {


            $usercoin = UserCoin::firstOrNew(array('user_id' => (Auth::user()->id), 'coin_id' => $address['wallet_type']));

            $usercoin->user_id = Auth::user()->id;
            $usercoin->coin_id = $address['wallet_type'];
            $usercoin->preferable = $address['preferable'];
            $usercoin->address = $address['address'];
            $usercoin->save();

            session()->flash('message.level', 'success');
            session()->flash('message.color', 'green');
            session()->flash('message.content', 'Withdraw address was successfully added');
            return redirect('account/profile/addresses');
        } else {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'Adding of new wallet failed');
            return redirect('account/profile/addresses');
        }
    }

    public function addPref($slug) {
        $userp = UserCoin::whereUser_id(Auth::user()->id)->wherePreferable(true)->first();
        if (is_object($userp)) {

            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', "You have preferable wallet please remove it to add this one");
            return redirect('account/profile/addresses');
        }
        $coin = UserCoin::whereId($slug)->first();
        if (is_object($coin)) {
            $coin->update([
                'preferable' => true
            ]);
            $mm = $coin->coin->name;
            session()->flash('message.level', 'success');
            session()->flash('message.color', 'green');
            session()->flash('message.content', "Your $mm Wallet has been set to receive fund");
            return redirect('account/profile/addresses');
        } else {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'Add wallet receiving fund failed');
            return redirect('account/profile/addresses');
        }
    }

    public function removePref($slug) {

        $coin = UserCoin::whereId($slug)->first();
        if (is_object($coin)) {
            $coin->update([
                'preferable' => false
            ]);
            $mm = $coin->coin->name;
            session()->flash('message.level', 'success');
            session()->flash('message.color', 'green');
            session()->flash('message.content', "Your $mm Wallet has been disabled to receive fund");
            return redirect('account/profile/addresses');
        } else {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'Removing wallet receiving fund failed');
            return redirect('account/profile/addresses');
        }
    }

    public function removeCoin($slug) {
        $coin = UserCoin::whereId($slug)->first();
        if (is_object($coin)) {
            $coin->update([
                'address' => null,
                'preferable' => false
            ]);
            $mm = $coin->coin->name;
            session()->flash('message.level', 'success');
            session()->flash('message.color', 'green');
            session()->flash('message.content', "Your $mm Wallet removed by you");
            return redirect('account/profile/addresses');
        } else {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'Removing wallet failed');
            return redirect('account/profile/addresses');
        }
    }

    public function gateway(Request $request) {
//        $today = Carbon::now();
//        $timestamp = strtotime($today);
//        $day = date('D', $timestamp);
//        if (!in_array($day, array('Sun', 'Sat'))) {
//            session()->flash('message.level', 'error');
//            session()->flash('message.color', 'red');
//            session()->flash('message.content', 'You can only buy Plan on Saturdays and Sundays');
//            return redirect()->back();
//        }
        $input = $request->all();
        if ($request->type_old != 'renew') {
            $rules = [
                'plan' => 'required|numeric',
                'amount' => 'required|numeric',
                'type' => 'required'
            ];
            $error = static::getErrorMessageSweet($input, $rules);
            if ($error) {
                return $error;
            }
        }
        $plan = Plan::whereId($request->plan)->first();
        if ($request->type == 'license') {
            $plan = Plan::whereId($request->plan)->first();
            if ($request->amount < $plan->min) {
                session()->flash('message.level', 'error');
                session()->flash('message.color', 'red');
                session()->flash('message.content', 'Amount is less than the minimum amount for this plan');
                return redirect()->back();
            }
            if ($plan->max != 0) {
                if ($request->amount > $plan->max) {

                    session()->flash('message.level', 'error');
                    session()->flash('message.color', 'red');
                    session()->flash('message.content', 'Amount is too high for this Plan');
                    return redirect()->back();
                }
            }

            if ($plan->name == 'NFP TRADES') {
                if ($plan->getFridaysAttribute() == false) {
                    session()->flash('message.level', 'error');
                    session()->flash('message.color', 'red');
                    session()->flash('message.content', 'You can only buy this plan every first friday of the month');
                    return redirect()->back();
                }
            }
        }
        if ($request->type == "EducationLicense") {
            $edu = UserEducationLicensePlan::whereUser_id(Auth::user()->id)->where('due_pay', '>', Carbon::now())->first();
            if (is_object($edu)) {
                session()->flash('message.level', 'error');
                session()->flash('message.color', 'red');
                session()->flash('message.content', 'You have active plan please wait for it to expired');
                return redirect('account/education-pack');
            }
        }

        if ($request->type_old == 'old') {
            $money = userTrackEarn::whereUser_id(Auth::user()->id)->first();
            if (is_object($money)) {
                $useramount = $money->amount;
            } else {
                $useramount = 0;
            }
            if ($request->amount > $useramount) {
                $data['fund'] = 'fund';
            } else {
                $data['fund'] = 'invest';
            }
            if ($data['fund'] == 'fund') {

                session()->flash('message.level', 'error');
                session()->flash('message.color', 'red');
                session()->flash('message.content', 'not enough fund in your current balance to cover the purchase');
                return redirect('deposits');
            }
            $userInvest = Investment::whereUser_id(Auth::user()->id)->wherePlan_id($request->plan)->whereIs_taken(false)->whereStatus(false)->whereStatus_deposit(true)->orderBy('created_at', 'desc')->first();
            if (!is_object($userInvest)) {
                session()->flash('message.level', 'error');
                session()->flash('message.color', 'red');
                session()->flash('message.content', 'you must first buy new plan before adding existing plan to it');
                return redirect('deposits');
            }

            $userInvest->update([
                'amount' => $userInvest->amount + $request->amount
            ]);
            $pp = $userInvest->plan->name;
            Transaction::create([
                'user_id' => Auth::user()->id,
                'transaction_id' => $userInvest->transaction_id,
                'type' => 'Plan',
                'name_type' => 'Deposit',
                'deposit_investment_charge' => 0,
                'status' => true,
                'amount' => $request->amount,
                'amount_profit' => 0,
                'description' => "You add new amount to existing Plan  $$request->amount Under  $pp"
            ]);

            $money->update([
                'amount' => $money->amount - $request->amount,
                'initial_capital' => $money->initial_capital + $request->amount,
            ]);

            session()->flash('message.level', 'success');
            session()->flash('message.color', 'success');
            session()->flash('message.content', 'Plan Successfully Purchased');
            return redirect('office');
        }
        if ($request->type_old == 'renew') {
            $userInvest = Investment::whereUser_id(Auth::user()->id)->whereId($request->id)->whereIs_taken(false)->whereStatus(true)->whereStatus_deposit(true)->orderBy('created_at', 'desc')->first();
            if (!is_object($userInvest)) {
                session()->flash('message.level', 'error');
                session()->flash('message.color', 'red');
                session()->flash('message.content', 'you cant  renew this contract ');
                return redirect()->back();
            }
            $current = Carbon::now();
            $plan = Plan::whereId($userInvest->plan->id)->first();
            $due_p = $current->addHours($plan->compound->compound);
            $due_pay = $due_p->addDays(1);

            $userInvest->due_pay = $due_pay;
            $userInvest->status = false;
            $userInvest->earn = 0;
            $userInvest->run_count = 0;
            $userInvest->save();
            $pp = $userInvest->plan->name;
            Transaction::create([
                'user_id' => Auth::user()->id,
                'transaction_id' => $userInvest->transaction_id,
                'type' => 'Plan',
                'name_type' => 'Deposit',
                'deposit_investment_charge' => 0,
                'status' => true,
                'amount' => $userInvest->amount,
                'amount_profit' => 0,
                'description' => "Your contract renewed  $$request->amount Under  $pp"
            ]);


            session()->flash('message.level', 'success');
            session()->flash('message.color', 'success');
            session()->flash('message.content', 'Contract Successfully Renewed');
            return redirect('office');
        }
        $all = file_get_contents("https://blockchain.info/ticker");
        $res = json_decode($all);
        $btcrate = $res->USD->last;
        try {
            $general_coin = file_get_contents('https://api.blockchain.com/v3/exchange/tickers/ETH-USD');
        } catch (\Exception $e) {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'Checking amount in Crypto failed ');
            return redirect()->back();
        }

        try {
            $general_coin_usdt = file_get_contents('https://api.blockchain.com/v3/exchange/tickers/USDT-USD');
        } catch (\Exception $e) {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'Checking amount in Crypto failed ');
            return redirect()->back();
        }


        $usdt = $general_coin_usdt;
        $usdt_price = json_decode($usdt);
        $usdt_final = $usdt_price->last_trade_price;
        $data['usdt_amount'] = number_format(floatval($request->amount / $usdt_final), 1, '.', '');
        $data['usdt_name'] = "USDT (trc20)";

        $eth = $general_coin;
        $ethereum = json_decode($eth);
        $ethereum_final = $ethereum->last_trade_price;
        $data['eth_amount'] = number_format(floatval($request->amount / $ethereum_final), 6, '.', '');
        $data['eth_name'] = "ETH";


        $data['btc_amount'] = number_format(floatval($request->amount / $btcrate), 6, '.', '');
        $data['btc_name'] = "BTC";

        $data_payment = ([
            'amount' => $request->amount,
            'type' => $request->type,
            'plan_id' => $request->plan,
            'btc_amount' => $data['btc_amount'],
            'eth_amount' => $data['eth_amount'],
            'usdt_amount' => $data['usdt_amount']
        ]);
        $request->session()->put('gateway', $data_payment);
        $data['gateway'] = Session::get('gateway');
        $data['coins'] = Coin::orderBy('created_at', 'asc')->whereStatus(true)->get();

        return view('user.select-gateway', $data);
    }

    public function createPayment(Request $request) {
        $gateway = Session::get('gateway');
        $setting = Setting::whereId(1)->first();


        $data_payment = ([
            'gateway' => $request->gateway,
            'gateway_amount' => $request->gateway_amount,
        ]);
        $data['payment_details'] = array_merge($gateway, $data_payment);
        if (empty($gateway)) {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'Invalid payment occured');
            return redirect()->back();
        }
        $input = $request->all();
        $rules = [
            'gateway' => 'required',
            'gateway_value' => 'required',
            'gateway_amount' => 'required'
        ];

        $error = static::getErrorMessageSweet($input, $rules);
        if ($error) {
            return $error;
        }


        $coin = Coin::whereSlug($request->gateway)->first();
        if (!is_object($coin)) {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'Something went wrong');
            return redirect()->back();
        }
        $checkuser = UserCoin::firstOrNew(array('user_id' => (Auth::user()->id), 'coin_id' => $coin->id));
        $checkuser->user_id = Auth::user()->id;
        $checkuser->coin_id = $coin->id;
        $checkuser->save();
        $data['sendaddress'] = $coin->address;
        $text = $request->gateway_value . ':' . $coin->address . '?amount=' . $request->gateway_amount;
        $qrCode = new QrCode($text);
        $qrCode->setSize(300);
        $qrCode->setWriterByName('png');
        $qrCode->setEncoding('UTF-8');
        $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH());
        $qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
        $qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);
        $qrCode->setLogoPath(public_path() . '/' . $setting['logo']);
        $qrCode->setLogoSize(166, 49);
        $qrCode->setValidateResult(false);
        $qrcode_image = $qrCode->writeDataUri();
        $data['image_qrcode'] = $qrcode_image;
        if ($gateway['type'] == "deposit") {
            if ($request->gateway_value == "bitcoin") {
                if ($request->gateway_amount !== $gateway['btc_amount']) {
                    session()->flash('message.level', 'error');
                    session()->flash('message.color', 'red');
                    session()->flash('message.content', 'Invalid payment occured');
                    return redirect()->back();
                }
            } elseif ($request->gateway_value == "ethereum") {
                if ($request->gateway_amount !== $gateway['eth_amount']) {
                    session()->flash('message.level', 'error');
                    session()->flash('message.color', 'red');
                    session()->flash('message.content', 'Invalid payment occured');
                    return redirect()->back();
                }
            } elseif ($request->gateway_value == "usdt") {
                if ($request->gateway_amount !== $gateway['usdt_amount']) {
                    session()->flash('message.level', 'error');
                    session()->flash('message.color', 'red');
                    session()->flash('message.content', 'Invalid payment occured');
                    return redirect()->back();
                }
            } else {
                session()->flash('message.level', 'error');
                session()->flash('message.color', 'red');
                session()->flash('message.content', 'Invalid payment,, occured');
                return redirect()->back();
            }


            $user_withdraw = UserWithdrawal::firstOrNew(array('user_id' => (Auth::user()->id), 'amount_check' => $request->gateway_amount));
            $user_withdraw->amount = $gateway['amount'];
            $user_withdraw->user_id = Auth::user()->id;
            $user_withdraw->coin_id = $checkuser->id;
            $user_withdraw->type = "Fund Deposit";
            $user_withdraw->amount_check = $request->gateway_amount;
            $user_withdraw->status = 0;
            $user_withdraw->main_invest = false;
            $user_withdraw->transaction_id = strtolower(Str::random(10));
            $user_withdraw->main_paid = false;
            $user_withdraw->deposit_user_paid = false;
            $user_withdraw->user_deposit = true;
            $user_withdraw->save();
            //create transcations history
            Transaction::create([
                'user_id' => Auth::user()->id,
                'transaction_id' => $user_withdraw->transaction_id,
                'type' => 'Fund Deposit',
                'name_type' => 'Fund Deposit',
                'deposit_investment_charge' => 0,
                'coin_id' => $checkuser->id,
                'amount' => $gateway['amount'],
                'amount_profit' => 0,
                'description' => "You have deposited  $user_withdraw->amount  to your wallet"
            ]);


            //send message to admin
            $name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
            $greeting = "Hello Admin";
            $amount = $gateway['amount'];
            $text = "$name deposited  $$amount";
            Mail::to($setting->send_notify_email)->send(new MailSender('New Deposit', $greeting, $text, '', ''));


            $data['user_money'] = $user_withdraw;
            $data['coin'] = $coin;
            $data['type'] = $gateway['type'];
            return view('user.made-payment', $data);
        } else {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'Invalid payment occured');
            return redirect()->back();
        }
    }

    public function createPaymentDeposit(Request $request) {
        $gateway = Session::get('gateway');
        $setting = Setting::whereId(1)->first();
        $data_payment = ([
            'gateway' => $request->gateway,
            'gateway_amount' => $request->gateway_amount,
        ]);
        $data['payment_details'] = array_merge($gateway, $data_payment);
        if (empty($gateway)) {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'Invalid payment occured');
            return redirect()->back();
        }
        $input = $request->all();
        $rules = [
            'gateway' => 'required',
            'gateway_value' => 'required',
            'gateway_amount' => 'required'
        ];

        $error = static::getErrorMessageSweet($input, $rules);
        if ($error) {
            return $error;
        }

        $coin = Coin::whereSlug($request->gateway)->first();
        if (!is_object($coin)) {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'Something went wrong');
            return redirect()->back();
        }
        $checkuser = UserCoin::firstOrNew(array('user_id' => (Auth::user()->id), 'coin_id' => $coin->id));
        $checkuser->user_id = Auth::user()->id;
        $checkuser->coin_id = $coin->id;
        $checkuser->save();

        $txt = strtolower(Str::random(10));
        $data['sendaddress'] = $coin->address;
        $text = $request->gateway_value . ':' . $coin->address . '?amount=' . $request->gateway_amount;
        $qrCode = new QrCode($text);
        $qrCode->setSize(300);
        $qrCode->setWriterByName('png');
        $qrCode->setEncoding('UTF-8');
        $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH());
        $qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
        $qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);
        $qrCode->setLogoPath(public_path() . '/' . $setting['logo']);
        $qrCode->setLogoSize(166, 49);
        $qrCode->setValidateResult(false);
        $qrcode_image = $qrCode->writeDataUri();
        $data['image_qrcode'] = $qrcode_image;


        if ($request->gateway_value == "bitcoin") {
            if ($request->gateway_amount !== $gateway['btc_amount']) {
                session()->flash('message.level', 'error');
                session()->flash('message.color', 'red');
                session()->flash('message.content', 'Invalid payment occured');
                if ($gateway['type'] == "EducationLicense") {
                    return redirect('account/education-license');
                } else {
                    return redirect('deposits');
                }
            }
        } elseif ($request->gateway_value == "ethereum") {
            if ($request->gateway_amount !== $gateway['eth_amount']) {
                session()->flash('message.level', 'error');
                session()->flash('message.color', 'red');
                session()->flash('message.content', 'Invalid payment occured');
                if ($gateway['type'] == "EducationLicense") {
                    return redirect('account/education-license');
                } else {
                    return redirect('deposits');
                }
            }
        } elseif ($request->gateway_value == "usdt") {

            if ($request->gateway_amount !== $gateway['usdt_amount']) {
                session()->flash('message.level', 'error');
                session()->flash('message.color', 'red');
                session()->flash('message.content', 'Invalid payment occured');
                if ($gateway['type'] == "EducationLicense") {
                    return redirect('account/education-license');
                } else {
                    return redirect('deposits');
                }
            }
        } else {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'Invalid payment,, occured');
            if ($gateway['type'] == "EducationLicense") {
                return redirect('account/education-license');
            } else {
                return redirect('deposit');
            }
        }
        if ($gateway['type'] == "EducationLicense") {
            $edu = UserEducationLicensePlan::whereUser_id(Auth::user()->id)->where('due_pay', '>', Carbon::now())->first();
            if (is_object($edu)) {
                session()->flash('message.level', 'error');
                session()->flash('message.color', 'red');
                session()->flash('message.content', 'You have active plan please wait for it to expired');
                return redirect('account/education-license');
            }
        }


        $money = userTrackEarn::whereUser_id(Auth::user()->id)->first();
        if (is_object($money)) {
            $useramount = $money->amount;
        } else {
            $useramount = 0;
        }
        if ($request->amount > $useramount) {
            $data['fund'] = 'fund';
        } else {
            $data['fund'] = 'fund';
        }

        $current = Carbon::now();
        if ($gateway['type'] == "EducationLicense") {
            $edu_plan = EducationLicensePlan::whereId($gateway['plan_id'])->first();
            $due_p = $current->addHours($edu_plan->compound->compound);
        } else {

            $plan = Plan::whereId($gateway['plan_id'])->first();
            $due_p = $current->addHours($plan->compound->compound);
        }
        //substract
        if ($data['fund'] == 'invest') {

            $sub = userTrackEarn::whereUser_id(Auth::user()->id)->first();
            $amountd = $request->amount;
            if ($gateway['type'] == "EducationLicense") {
                $sub->update([
                    'amount' => $sub->amount - $amountd
                ]);
            } else {
                $sub->update([
                    'amount' => $sub->amount - $amountd,
                    'initial_capital' => $sub->initial_capital + $amountd
                ]);
            }


            $status_deposit = true;
            $due = $due_p;
            $due_pay = $due->addDays(1);
            $txt = strtolower(Str::random(10));
        } else {
            $status_deposit = false;
            $due_pay = null;
        }

        $current_pay = Carbon::now();
        $due_time = $current_pay->addHours($setting->time_pay);
        $time_pay = $due_time->addMinutes(2);
        if ($gateway['type'] == "EducationLicense") {
            $user_education_license = UserEducationLicensePlan::firstOrNew(array('user_id' => (Auth::user()->id), 'amount' => $edu_plan->amount));
            $user_education_license->amount_check = $request->gateway_amount;
            $user_education_license->amount = $edu_plan->amount;
            $user_education_license->user_id = Auth::user()->id;
            $user_education_license->education_license_id = $edu_plan->id;
            $user_education_license->status = 0;
            $user_education_license->transaction_id = strtolower(Str::random(10));
            $user_education_license->due_pay = $due_pay;
            $user_education_license->status_deposit = $status_deposit;
            $user_education_license->status = 0;
            $user_education_license->save();
            //create transcations history
            Transaction::create([
                'user_id' => Auth::user()->id,
                'transaction_id' => $user_education_license->transaction_id,
                'type' => 'Education Pack Deposit',
                'name_type' => 'Education Pack Deposit',
                'deposit_investment_charge' => 0,
                'amount' => $edu_plan->amount,
                'status' => $status_deposit,
                'amount_profit' => 0,
                'description' => "You have deposited $user_education_license->amount for Education Pack"
            ]);
        } else {
            //create investment
            $invest = Investment::firstOrNew(array('user_id' => (Auth::user()->id), 'amount_check' => $request->gateway_amount));
            $invest->transaction_id = $txt;
            $invest->user_id = Auth::user()->id;
            $invest->plan_id = $gateway['plan_id'];
            $invest->amount = $gateway['amount'];
            $invest->amount_check = $request->gateway_amount;
            $invest->deposit_investment_charge = 0;
            $invest->run_count = 0;
            $invest->coin_id = $checkuser->id;
            $invest->due_pay = $due_pay;
            $invest->time_pay = $time_pay;
            $invest->status_deposit = $status_deposit;
            $invest->settled_status = 0;
            $invest->status = 0;
            $invest->save();


            $profit = $invest->amount * $plan->percentage / 100;
            $amm = number_format($invest->amount);
            //transcation log
            Transaction::create([
                'user_id' => Auth::user()->id,
                'transaction_id' => $invest->transaction_id,
                'type' => 'Plan',
                'name_type' => 'Deposit',
                'deposit_investment_charge' => 0,
                'status' => $status_deposit,
                'amount' => $invest->amount,
                'amount_profit' => $profit,
                'description' => "You Bought Plan  $$amm Under  $plan->name"
            ]);
        }

//        //send user email
        if ($data['fund'] == 'invest') {

            if ($gateway['type'] == "Education License") {
                //referral
                $reward = $user_education_license->amount;

                $firstUserReward = $setting->level_eduction_license_1 / 100 * $reward;
                $allReward = $setting->level_eduction_license_2_7 / 100 * $reward;
                $newUserReward = $allReward;
                $user_ref = Reference::whereReferred_id($user_education_license->user_id)->first();
                if (is_object($user_ref)) {
                    $userSignalSub = UserEducationLicensePlan::whereUser_id($user_ref->user_id)->where('due_pay', '>', Carbon::now())->first();
                    if (is_object($userSignalSub)) {

                        //first reward
                        $newFirstUserReward = $firstUserReward;
                        $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($user_ref->user_id)));
                        $userMoney->user_id = $user_ref->user_id;
                        $userMoney->amount = $userMoney->amount + $newFirstUserReward;
                        $userMoney->save();
                        //transcation log
                        Transaction::create([
                            'user_id' => $user_ref->user_id,
                            'transaction_id' => $user_education_license->transaction_id,
                            'type' => 'Commissions',
                            'name_type' => 'Referral Bonus  Educational Pack',
                            'amount' => $newFirstUserReward,
                            'amount_profit' => $newFirstUserReward,
                            'description' => 'Referral Bonus Under Educational Pack ' . $user_education_license->plan->name . ' license',
                            'status' => true
                        ]);
                        $message = 'USD' . $newFirstUserReward . "  Educational Pack Referral Bonus has been successfully sent to you with  Transaction ID Is : #$user_education_license->transaction_id";
                        $first = $user_ref->user->email;
                        $last = $user_ref->user->username;
                        $greeting = "Hello $first $last";
                        Mail::to($user_ref->user->email)->send(new MailSender('Referral Bonus  Educational Pack', $greeting, $message, '', ''));
                        //second reward
                        $user_ref_second = Reference::whereReferred_id($user_ref->user_id)->first();
                        if (is_object($user_ref_second)) {

                            $userSignalSub = UserEducationLicensePlan::whereUser_id($user_ref_second->user_id)->where('due_pay', '>', Carbon::now())->first();
                            if (is_object($userSignalSub)) {


                                $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($user_ref_second->user_id)));
                                $userMoney->user_id = $user_ref_second->user_id;
                                $userMoney->amount = $userMoney->amount + $newUserReward;
                                $userMoney->save();
                                //transcation log
                                Transaction::create([
                                    'user_id' => $user_ref_second->user_id,
                                    'transaction_id' => $user_education_license->transaction_id,
                                    'type' => 'Commissions',
                                    'name_type' => 'Referral Bonus',
                                    'amount' => $newUserReward,
                                    'amount_profit' => $newUserReward,
                                    'description' => 'Referral Bonus Under  Educational Pack' . $user_education_license->plan->name,
                                    'status' => true
                                ]);
                                $message_second = 'USD' . $newUserReward . " Educational Pack Second step Referral Bonus has been successfully sent to you with Transaction ID Is : #$user_education_license->transaction_id";
                                $first = $user_ref_second->user->first_name;
                                $last = $user_ref_second->user->last_name;
                                $greeting = "Hello $first $last";
                                Mail::to($user_ref_second->user->email)->send(new MailSender('Referral Bonus  Educational Pack', $greeting, $message_second, '', ''));
                                ///third
                                $user_ref_third = Reference::whereReferred_id($user_ref_second->user_id)->first();
                                if (is_object($user_ref_third)) {

                                    $userSignalSub = UserEducationLicensePlan::whereUser_id($user_ref_third->user_id)->where('due_pay', '>', Carbon::now())->first();
                                    if (is_object($userSignalSub)) {

                                        $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($user_ref_third->user_id)));
                                        $userMoney->user_id = $user_ref_third->user_id;
                                        $userMoney->amount = $userMoney->amount + $newUserReward;
                                        $userMoney->save();
                                        //transcation log
                                        Transaction::create([
                                            'user_id' => $user_ref_third->user_id,
                                            'transaction_id' => $user_education_license->transaction_id,
                                            'type' => 'Commissions',
                                            'name_type' => 'Referral Bonus',
                                            'amount' => $newUserReward,
                                            'amount_profit' => $newUserReward,
                                            'description' => 'Referral Bonus Under  Educational Pack' . $user_education_license->plan->name,
                                            'status' => true
                                        ]);
                                        $message_third = 'USD' . $newUserReward . " Educational Pack Third step Referral Bonus has been successfully sent to you with Transaction ID Is : #$user_education_license->transaction_id";
                                        $first = $user_ref_third->user->first_name;
                                        $last = $user_ref_third->user->last_name;
                                        $greeting = "Hello $first $last";
                                        Mail::to($user_ref_third->user->email)->send(new MailSender('Referral Bonus  Educational Pack', $greeting, $message_third, '', ''));

                                        ///fourth
                                        $user_ref_fourth = Reference::whereReferred_id($user_ref_third->user_id)->first();
                                        if (is_object($user_ref_fourth)) {

                                            $userSignalSub = UserEducationLicensePlan::whereUser_id($user_ref_fourth->user_id)->where('due_pay', '>', Carbon::now())->first();
                                            if (is_object($userSignalSub)) {

                                                $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($user_ref_fourth->user_id)));
                                                $userMoney->user_id = $user_ref_fourth->user_id;
                                                $userMoney->amount = $userMoney->amount + $newUserReward;
                                                $userMoney->save();
                                                //transcation log
                                                Transaction::create([
                                                    'user_id' => $user_ref_fourth->user_id,
                                                    'transaction_id' => $user_education_license->transaction_id,
                                                    'type' => 'Commissions',
                                                    'name_type' => 'Referral Bonus',
                                                    'amount' => $newUserReward,
                                                    'amount_profit' => $newUserReward,
                                                    'description' => 'Referral Bonus Under  Educational Pack' . $user_education_license->plan->name,
                                                    'status' => true
                                                ]);
                                                $message_fourth = 'USD' . $newUserReward . " Educational Pack Fourth step Referral Bonus has been successfully sent to you with Transaction ID Is : #$user_education_license->transaction_id";
                                                $first = $user_ref_fourth->user->first_name;
                                                $last = $user_ref_fourth->user->last_name;
                                                $greeting = "Hello $first $last";
                                                Mail::to($user_ref_fourth->user->email)->send(new MailSender('Referral Bonus  Educational Pack', $greeting, $message_fourth, '', ''));

                                                ///five
                                                $user_ref_five = Reference::whereReferred_id($user_ref_fourth->user_id)->first();
                                                if (is_object($user_ref_five)) {

                                                    $userSignalSub = UserEducationLicensePlan::whereUser_id($user_ref_five->user_id)->where('due_pay', '>', Carbon::now())->first();
                                                    if (is_object($userSignalSub)) {

                                                        $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($user_ref_five->user_id)));
                                                        $userMoney->user_id = $user_ref_five->user_id;
                                                        $userMoney->amount = $userMoney->amount + $newUserReward;
                                                        $userMoney->save();
                                                        //transcation log
                                                        Transaction::create([
                                                            'user_id' => $user_ref_five->user_id,
                                                            'transaction_id' => $user_education_license->transaction_id,
                                                            'type' => 'Commissions',
                                                            'name_type' => 'Referral Bonus',
                                                            'amount' => $newUserReward,
                                                            'amount_profit' => $newUserReward,
                                                            'description' => 'Referral Bonus Under  Educational Pack' . $user_education_license->plan->name,
                                                            'status' => true
                                                        ]);
                                                        $message_five = 'USD' . $newUserReward . " Educational Pack Fiveth step Referral Bonus has been successfully sent to you with Transaction ID Is : #$user_education_license->transaction_id";
                                                        $first = $user_ref_five->user->first_name;
                                                        $last = $user_ref_five->user->last_name;
                                                        $greeting = "Hello $first $last";
                                                        Mail::to($user_ref_five->user->email)->send(new MailSender('Referral Bonus  Educational Pack', $greeting, $message_five, '', ''));

                                                        ///six
                                                        $user_ref_six = Reference::whereReferred_id($user_ref_five->user_id)->first();
                                                        if (is_object($user_ref_six)) {

                                                            $userSignalSub = UserEducationLicensePlan::whereUser_id($user_ref_six->user_id)->where('due_pay', '>', Carbon::now())->first();
                                                            if (is_object($userSignalSub)) {

                                                                $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($user_ref_six->user_id)));
                                                                $userMoney->user_id = $user_ref_six->user_id;
                                                                $userMoney->amount = $userMoney->amount + $newUserReward;
                                                                $userMoney->save();
                                                                //transcation log
                                                                Transaction::create([
                                                                    'user_id' => $user_ref_six->user_id,
                                                                    'transaction_id' => $user_education_license->transaction_id,
                                                                    'type' => 'Commissions',
                                                                    'name_type' => 'Referral Bonus',
                                                                    'amount' => $newUserReward,
                                                                    'amount_profit' => $newUserReward,
                                                                    'description' => 'Referral Bonus Under  Educational Pack' . $user_education_license->plan->name,
                                                                    'status' => true
                                                                ]);
                                                                $message_six = 'USD' . $newUserReward . " Educational Pack Six step Referral Bonus has been successfully sent to you with Transaction ID Is : #$user_education_license->transaction_id";
                                                                $first = $user_ref_six->user->first_name;
                                                                $last = $user_ref_six->user->last_name;
                                                                $greeting = "Hello $first $last";
                                                                Mail::to($user_ref_six->user->email)->send(new MailSender('Referral Bonus  Educational Pack', $greeting, $message_six, '', ''));

                                                                ///seven
                                                                $user_ref_seven = Reference::whereReferred_id($user_ref_six->user_id)->first();
                                                                if (is_object($user_ref_seven)) {

                                                                    $userSignalSub = UserEducationLicensePlan::whereUser_id($user_ref_seven->user_id)->where('due_pay', '>', Carbon::now())->first();
                                                                    if (is_object($userSignalSub)) {

                                                                        $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($user_ref_seven->user_id)));
                                                                        $userMoney->user_id = $user_ref_seven->user_id;
                                                                        $userMoney->amount = $userMoney->amount + $newUserReward;
                                                                        $userMoney->save();
                                                                        //transcation log
                                                                        Transaction::create([
                                                                            'user_id' => $user_ref_seven->user_id,
                                                                            'transaction_id' => $user_education_license->transaction_id,
                                                                            'type' => 'Commissions',
                                                                            'name_type' => 'Referral Bonus',
                                                                            'amount' => $newUserReward,
                                                                            'amount_profit' => $newUserReward,
                                                                            'description' => 'Referral Bonus Under  Educational Pack' . $user_education_license->plan->name,
                                                                            'status' => true
                                                                        ]);
                                                                        $message_seven = 'USD' . $newUserReward . " Educational Pack Seven step Referral Bonus has been successfully sent to you with Transaction ID Is : #$user_education_license->transaction_id";
                                                                        $first = $user_ref_seven->user->first_name;
                                                                        $last = $user_ref_seven->user->last_name;
                                                                        $greeting = "Hello $first $last";
                                                                        Mail::to($user_ref_seven->user->email)->send(new MailSender('Referral Bonus  Educational Pack', $greeting, $message_seven, '', ''));

                                                                        ///eight
                                                                        $user_ref_eight = Reference::whereReferred_id($user_ref_seven->user_id)->first();
                                                                        if (is_object($user_ref_eight)) {

                                                                            $userSignalSub = UserEducationLicensePlan::whereUser_id($user_ref_eight->user_id)->where('due_pay', '>', Carbon::now())->first();
                                                                            if (is_object($userSignalSub)) {

                                                                                $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($user_ref_eight->user_id)));
                                                                                $userMoney->user_id = $user_ref_eight->user_id;
                                                                                $userMoney->amount = $userMoney->amount + $newUserReward;
                                                                                $userMoney->save();
                                                                                //transcation log
                                                                                Transaction::create([
                                                                                    'user_id' => $user_ref_eight->user_id,
                                                                                    'transaction_id' => $user_education_license->transaction_id,
                                                                                    'type' => 'Commissions',
                                                                                    'name_type' => 'Referral Bonus',
                                                                                    'amount' => $newUserReward,
                                                                                    'amount_profit' => $newUserReward,
                                                                                    'description' => 'Referral Bonus Under  Educational Pack' . $user_education_license->plan->name,
                                                                                    'status' => true
                                                                                ]);
                                                                                $message_eight = 'USD' . $newUserReward . " Educational Pack Eight step Referral Bonus has been successfully sent to you with Transaction ID Is : #$user_education_license->transaction_id";
                                                                                $first = $user_ref_eight->user->first_name;
                                                                                $last = $user_ref_eight->user->last_name;
                                                                                $greeting = "Hello $first $last";
                                                                                Mail::to($user_ref_eight->user->email)->send(new MailSender('Referral Bonus  Educational Pack', $greeting, $message_eight, '', ''));
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                $email = Auth::user()->email;
                $subject = 'Education Pack Purchased';
                $message = "You Purchased a new Education Pack Under " . $edu_plan->name . " with $user_education_license->amount USD";
                Mail::to($email)->send(new MailSender($subject, Auth::user()->first_name . ' ' . Auth::user()->last_name, $message, '', ''));

                session()->flash('message.level', 'success');
                session()->flash('message.color', 'success');
                session()->flash('message.content', 'Education Pack Successfully Purchased');
                return redirect('account/education-pack');
            } else {

                static::runAffiliate($payment, 'plan');

                $email = Auth::user()->email;
                $subject = 'Plan Purchased';
                $message = "You Bought a Plan Under " . $plan->name . " with $invest->amount USD";
                Mail::to($email)->send(new MailSender($subject, Auth::user()->first_name . ' ' . Auth::user()->last_name, $message, '', ''));

                session()->flash('message.level', 'success');
                session()->flash('message.color', 'success');
                session()->flash('message.content', 'Plan Successfully Purchased');
                return redirect('office');
            }
        }
        $name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        if ($gateway['type'] == "EducationLicense") {
            $greeting = "Hello Admin";
            $text = "$name deposited  $$user_education_license->amount";
            Mail::to($setting->send_notify_email)->send(new MailSender('New Education pack Deposit', $greeting, $text, '', ''));

            $data['user_education_license'] = $user_education_license;
            $data['coin'] = $coin;
            $data['type'] = $gateway['type'];
            $data['fund'] = $data['fund'];
            return view('user.made-payment', $data);
        } else {
            //send message to admin

            $greeting = "Hello Admin";
            $text = "$name deposited  $$invest->amount";
            Mail::to($setting->send_notify_email)->send(new MailSender('New Investment Deposit', $greeting, $text, '', ''));

            $data['invest'] = $invest;
            $data['coin'] = $coin;
            $data['plan'] = $plan;
            $data['type'] = $gateway['type'];

            return view('user.made-payment', $data);
        }
//           DB::commit();
//        } catch (\Exception $e) {
//            DB::rollback();
//            throw $e;
//        }
    }

//    public function ip_details($ip) {
//        $json = file_get_contents("http://ipinfo.io/{$ip}");
//        $details = json_decode($json);
//        if (empty($details->country)) {
//            return 'US';
//        }
//        return $details->country;
//    }
//
//    public function getCurrenyCode($country_code) {
//        $currency_codes = array(
//            'GB' => 'GBP',
//            'FR' => 'EUR',
//            'DE' => 'EUR',
//            'IT' => 'EUR',
//        );
//
//        if (isset($currency_codes[$country_code])) {
//            return $curreny_codes[$country_code];
//        }
//
//        return 'USD'; // Default to USD
//    }

    public function withdraw() {
        $data['user_withdraw'] = userTrackEarn::whereUser_id(Auth::user()->id)->first();
        return view('user.withdraw', $data);
    }

    public function withdrawCapital(Request $request) {

        $data['user_withdraw'] = Investment::whereUser_id(Auth::user()->id)->whereId($request->id)->first();
        $data['type'] = 'capital';
        $data['id'] = $request->id;
        return view('user.withdraw', $data);
    }

    public function withdrawPost(Request $request) {
        $today = Carbon::now();
        $timestamp = strtotime($today);
        $day = date('D', $timestamp);
        if (empty($request->type)) {
            if (!in_array($day, array('Sun', 'Sat'))) {
                session()->flash('message.level', 'error');
                session()->flash('message.color', 'red');
                session()->flash('message.content', 'Withdraw is only on Saturdays and Sundays');
                return redirect()->back();
            }
        }
        $input = $request->all();

        $rules = [
            'amount' => 'required|numeric',
            'address' => 'required',
            'address_name' => 'required'
        ];
        $error = static::getErrorMessageSweet($input, $rules);
        if ($error) {
            return $error;
        }
        $setting = Setting::whereId(1)->first();
        $check = Withdraw::whereUser_id(Auth::user()->id)->whereStatus(false)->first();
        if (is_object($check)) {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'You have a pending withdrawl. Wait for it to be processed.');
            return redirect()->back();
        }
        $usercoin = userTrackEarn::whereUser_id(Auth::user()->id)->first();
        if (!is_object($usercoin)) {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'no fund to withdraw at the moment');
            return redirect()->back();
        }
        if ($request->amount < $setting->min_withdraw) {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'Amount does not reach our minimum withdrawal');
            return redirect()->back();
        }
        $cal_charge = $request->amount * $setting['withdraw_charge'] / 100;
        $charge = $cal_charge;

        $amount = $request->amount;
        $total = $request->amount;
        if (empty($request->id)) {
            if ($total > $usercoin->amount) {
                session()->flash('message.level', 'error');
                session()->flash('message.color', 'red');
                session()->flash('message.content', 'Amount to withdraw not enough from the current balance');
                return redirect()->back();
            }
        }
        if (Auth::user()->can_withdraw == true) {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'Account suspened for a payout');
            return redirect()->back();
        }

        DB::beginTransaction();
        try {



            //create withdraw
            $final_am = $amount - $charge;
            $data_withdraw = ([
                'transaction_id' => strtoupper(Str::random(10)),
                'user_id' => Auth::user()->id,
                'description' => 'You Withdrew  ' . '$' . $final_am,
                'amount' => $amount,
                'total_amount' => $amount + $charge,
                'withdraw_charge' => $charge,
                'address' => $request->address,
                'id' => $request->id,
                'type' => 'Withdrew',
                'address_name' => $request->address_name,
                'amount_check' => 0,
                'confirm' => 1,
                'status' => 0
            ]);
            $request->session()->put('withdraw', $data_withdraw);
            $withdraw = Session::get('withdraw');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        $data['charge'] = $charge;
        $data['withdraw'] = $withdraw;
        return view('user.withdraw-fund', $data);
    }

    public function withdrawFund(Request $request) {
        $setting = Setting::whereId(1)->first();
        $input = $request->all();
        $rules = [
            'transaction_id' => 'required'
        ];
        $error = static::getErrorMessageSweet($input, $rules);
        if ($error) {
            return $error;
        }

        $withdraw_create = Session::get('withdraw');
        if (!empty($withdraw_create['id'])) {
            $userInvest = Investment::whereId($withdraw_create['id'])->first();
            $userInvest->is_taken = true;
            $userInvest->save();
        }
        $withdraw = new Withdraw();
        $withdraw->transaction_id = $withdraw_create['transaction_id'];
        $withdraw->user_id = $withdraw_create['user_id'];
        $withdraw->description = $withdraw_create['description'];
        $withdraw->amount = $withdraw_create['amount'];
        $withdraw->address = $withdraw_create['address'];
        $withdraw->total_amount = $withdraw_create['total_amount'];
        $withdraw->withdraw_charge = $withdraw_create['withdraw_charge'];
        $withdraw->address_name = $withdraw_create['address_name'];
        $withdraw->amount_check = $withdraw_create['amount_check'];
        $withdraw->confirm = $withdraw_create['confirm'];
        $withdraw->status = $withdraw_create['status'];
        $withdraw->invest_id = $withdraw_create['id'];
        $withdraw->save();
        $name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        //send mail
        $email = $withdraw->user->email;
        $subject = 'Withdrawal has been Confirmed ';
        $text = "You Iniated a withdrawl of  " . "$" . $withdraw->amount;
        $message = $text . ' Wait for your fund to arrive in your  ' . " account " . $withdraw->address . ' We will notify you once fund is confirmed';
        Mail::to($email)->send(new MailSender($subject, "Hi, $name", $message, '', ''));
        //admin
        //send message to admin
        $greeting = "Hello Admin";

        $text = "$name requested  $$withdraw->amount payouts";
        Mail::to($setting->send_notify_email)->send(new MailSender('New withdrawl request', $greeting, $text, '', ''));
        Withdraw::whereId($request->withdraw)->update([
            'confirm' => true
        ]);
        ////transcation log
        Transaction::create([
            'user_id' => Auth::user()->id,
            'transaction_id' => $withdraw->transaction_id,
            'type' => 'Withdraw',
            'name_type' => 'Withdraw',
            'withdraw_charge' => $withdraw_create['withdraw_charge'],
            'amount' => $withdraw->amount,
            'description' => 'You Widthrew  ' . '$' . $withdraw->amount
        ]);

        session()->flash('message.level', 'success');
        session()->flash('message.color', 'success');
        session()->flash('message.content', 'Withdrawal Successfully Confirmed');
        return redirect()->back();
    }

    public function depositList() {
        $data['active_deposits'] = Investment::whereUser_id(Auth::user()->id)->whereStatus(false)->whereNotNull('due_pay')->orderBy('created_at', 'desc')->get();
        $data['pending_deposits'] = Investment::whereUser_id(Auth::user()->id)->whereStatus(false)->whereNull('due_pay')->orderBy('created_at', 'desc')->get();
        $data['completed_deposits'] = Investment::whereUser_id(Auth::user()->id)->whereStatus(1)->orderBy('created_at', 'desc')->get();
        return view('user.deposit_list', $data);
    }

    public function depositHistory() {
        $data['deposits'] = Investment::whereUser_id(Auth::user()->id)->orderBy('created_at', 'desc')->paginate(15);

        return view('user.deposit_history', $data);
    }

    public function fundDepositHistory() {
        $data['deposits'] = UserWithdrawal::whereUser_id(Auth::user()->id)->whereType('Fund Deposit')->orderBy('created_at', 'desc')->paginate(15);

        return view('user.fund_deposit_history', $data);
    }

    public function depositHistoryEducationLicense() {
        $data['deposits'] = UserEducationLicensePlan::whereUser_id(Auth::user()->id)->orderBy('created_at', 'desc')->paginate(15);
        return view('user.education.license', $data);
    }

    public function withdrawHistory() {
        $data['withdraws'] = Withdraw::whereUser_id(Auth::user()->id)->orderBy('created_at', 'desc')->paginate(15);
        return view('user.withdraw_history', $data);
    }

    public function earnings() {
        $data['earnings'] = Transaction::whereUser_id(Auth::user()->id)->whereStatus(true)->where(function ($query) {
                    $query->where('name_type', 'Weekly Profit')
                            ->orWhere('name_type', 'Return Investment Amount')
                            ->orWhere('name_type', 'Profit Amount')
                            ->orWhere('name_type', 'Referral Bonus');
                })->orderBy('created_at', 'desc')->paginate(15);
        return view('user.earnings', $data);
    }

    public function referals() {
        $data['refs'] = Reference::whereUser_id(Auth::user()->id)->orderBy('created_at', 'desc')->with('userRef')->get();

        if (is_object($data['refs'])) {
            $second = [];
            foreach ($data['refs'] as $value) {
                $find = Reference::whereUser_id($value->referred_id)->orderBy('created_at', 'desc')->with('userRef')->get();
                if (!$find->isEmpty()) {
                    $second[] = $find;
                }
            }
            if (!empty($second)) {
                $data['second_refs'] = $second[0];

                $third = [];
                foreach ($data['second_refs'] as $value) {
                    $find = Reference::whereUser_id($value->referred_id)->orderBy('created_at', 'desc')->with('userRef')->get();
                    if (!$find->isEmpty()) {
                        $third[] = $find;
                    }
                }
                if (!empty($third)) {
                    $data['third_refs'] = $third[0];


                    $fourth = [];
                    foreach ($data['third_refs'] as $value) {
                        $find = Reference::whereUser_id($value->referred_id)->orderBy('created_at', 'desc')->with('userRef')->get();
                        if (!$find->isEmpty()) {
                            $fourth[] = $find;
                        }
                    }

                    if (!empty($fourth)) {
                        $data['fourth_refs'] = $fourth[0];

                        $five = [];
                        foreach ($data['fourth_refs'] as $value) {
                            $find = Reference::whereUser_id($value->referred_id)->orderBy('created_at', 'desc')->with('userRef')->get();
                            if (!$find->isEmpty()) {
                                $five[] = $find;
                            }
                        }

                        if (!empty($five)) {
                            $data['five_refs'] = $five[0];

                            $six = [];

                            foreach ($data['five_refs'] as $value) {
                                $find = Reference::whereUser_id($value->referred_id)->orderBy('created_at', 'desc')->with('userRef')->get();
                                if (!$find->isEmpty()) {
                                    $six[] = $find;
                                }
                            }
                            if (!empty($six)) {
                                $data['six_refs'] = $six[0];

                                $seven = [];

                                foreach ($data['six_refs'] as $value) {
                                    $find = Reference::whereUser_id($value->referred_id)->orderBy('created_at', 'desc')->with('userRef')->get();
                                    if (!$find->isEmpty()) {
                                        $seven[] = $find;
                                    }
                                }

                                if (!empty($seven)) {
                                    $data['seven_refs'] = $seven[0];
                                    $eight = [];

                                    foreach ($data['seven_refs'] as $value) {
                                        $find = Reference::whereUser_id($value->referred_id)->orderBy('created_at', 'desc')->with('userRef')->get();
                                        if (!$find->isEmpty()) {
                                            $eight[] = $find;
                                        }
                                    }

                                    if (!empty($eight)) {
                                        $data['eight_refs'] = $eight[0];
                                        $nine = [];

                                        foreach ($data['eight_refs'] as $value) {
                                            $find = Reference::whereUser_id($value->referred_id)->orderBy('created_at', 'desc')->with('userRef')->get();
                                            if (!$find->isEmpty()) {
                                                $nine[] = $find;
                                            }
                                        }

                                        if (!empty($nine)) {
                                            $data['nine_refs'] = $nine[0];
                                            $ten = [];

                                            foreach ($data['nine_refs'] as $value) {
                                                $find = Reference::whereUser_id($value->referred_id)->orderBy('created_at', 'desc')->with('userRef')->get();
                                                if (!$find->isEmpty()) {
                                                    $ten[] = $find;
                                                }
                                            }

                                            if (!empty($ten)) {
                                                $data['ten_refs'] = $ten[0];
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        $setting = Setting::whereId(1)->first();
        $text = url('/') . '/' . Auth::user()->ref_check;
        $qrCode = new QrCode($text);
        $qrCode->setSize(200);
        $qrCode->setWriterByName('png');
        $qrCode->setEncoding('UTF-8');
        $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH());
        $qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
        $qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);
        $qrCode->setLogoPath(public_path() . '/' . $setting['logo']);
        $qrCode->setLogoSize(166, 49);
        $qrCode->setValidateResult(false);
        $qrcode_image = $qrCode->writeDataUri();
        $data['image_qrcode'] = $qrcode_image;
        $data['commission'] = Transaction::whereUser_id(Auth::user()->id)->whereStatus(true)->whereType('Commissions')->sum('amount');
        $data['ranking'] = Reference::whereUser_id(Auth::user()->id)->count();
        return view('user.referals', $data);
    }

    public function referalsLink() {
        return view('user.referallinks');
    }

    public function edit() {
        $data['user'] = User::whereId(Auth::user()->id)->with('coin')->first();

        $data['name_ref'] = Reference::whereReferred_id(Auth::user()->id)->first();

        $data['coinsEnable'] = Coin::whereStatus(true)->with('usercoinUser')->whereStatus(true)->get();

        $data['transactions'] = Transaction::whereUser_id(Auth::user()->id)->orderBy('created_at', 'desc')->take(5)->get();
        return view('user.profile', $data);
    }

    public function editPost(Request $request) {
        $input = $request->all();
        if (!empty($request->first_name)) {
            $rules = ([
                'first_name' => 'required',
                'email' => 'required',
                'last_name' => 'required'
            ]);
            $error = static::getErrorMessageSweet($input, $rules);
            if ($error) {
                return $error;
            }
        }
        if (!empty($request->support_code)) {
            $rules = ([
                'support_code' => ['required', 'numeric'],
            ]);
            $error = static::getErrorMessageSweet($input, $rules);
            if ($error) {
                return $error;
            }
        }
        if (!empty($request->password) || !empty($request->old)) {
            $rules = ([
                'password' => ['required', 'string', 'min:8'],
//                'confirm_password' => 'required|same:password',
                'old' => ['required', 'string'],
            ]);
            $error = static::getErrorMessageSweet($input, $rules);
            if ($error) {
                return $error;
            }
        }

        if (!empty($request->first_name)) {
            $user = User::firstOrNew(array('id' => $request->id));
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->nick_name = $request->nick_name;
            $user->email = $request->email;
            $user->phone_no = $request->phone_no;
            $user->fb = $request->fb;
            $user->country = $request->country;
            $user->whatsapp = $request->whatsapp;
            $user->insta = $request->insta;
            $user->tele = $request->tele;
            $user->skyp = $request->skyp;
            $user->tw = $request->tw;


            if (!empty($request->type)) {
                $user->type = $request->type;
            }
            if (!empty($request->code)) {
                if ($request->code == 0) {
                    $user->code = $request->code;
                } elseif ($request->code == 1) {
                    $user->code = $request->code;
                }
            }
            $user->save();
        }

        if (!empty($request->avatar)) {
            if ($request->hasFile('avatar')) {
                $user = User::firstOrNew(array('id' => $request->id));
                $file = $request->file('avatar');
                $extension = $file->getClientOriginalExtension();
                $rand = 'user-' . $user->ref_check;
                $name = $rand . '.' . $extension;
                $file->move(public_path('/user/photo'), $name);
                $save = 'user/photo/' . $name;
                $user->photo = $save;
                $user->save();
                session()->flash('message.level', 'success');
                session()->flash('message.color', 'green');
                session()->flash('message.content', 'Avatar updated');
                return redirect()->back();
            }
        }

        if (!empty($request->password)) {
            $user = User::firstOrNew(array('id' => $request->id));
            if (\Illuminate\Support\Facades\Hash::check($request->old, $user->password)) {

                $user->password = bcrypt($request->password);
                $user->save();
                session()->flash('message.level', 'success');
                session()->flash('message.color', 'green');
                session()->flash('message.content', 'New password  Successfully Saved');
                return redirect()->back();
            } else {
                session()->flash('message.level', 'error');
                session()->flash('message.color', 'red');
                session()->flash('message.content', 'Old password not same with your current password');
                return redirect()->back();
            }
        }
        if (!empty($request->support_code)) {
            $user = User::firstOrNew(array('id' => $request->id));
            $user->support_code = $request->support_code;
            $user->save();
            session()->flash('message.level', 'success');
            session()->flash('message.color', 'green');
            session()->flash('message.content', '  Support code has been set');
            return redirect()->back();
        }
        session()->flash('message.level', 'success');
        session()->flash('message.color', 'green');
        session()->flash('message.content', 'Update Successfully Saved');
        return redirect()->back();
    }

    public function kfc() {
        return view('user.kfc');
    }

    public function kfcPost(Request $request) {
        $input = $request->all();
        $rules = ([
            'file' => 'required|file|max:2048|mimes:png,jpg,jpeg'
        ]);
        $error = static::getErrorMessageSweet($input, $rules);
        if ($error) {
            return $error;
        }
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $rand = Auth::user()->username;
            $name = $rand . '.' . $extension;
            $file->move(public_path('/kyc'), $name);
            $save = $name;
            $user = User::whereId(Auth::user()->id)->first();
            $user->kyc = $save;
            $user->save();
            $subject = 'KYC Verficiation Review';
            $message = "Your KYC review is in progress , you will hear from us soon";

            Notification::route('mail', Auth::user()->email)
                    ->notify(new PlanDepositMail($subject, $message));
            session()->flash('message.level', 'success');
            session()->flash('message.color', 'green');
            session()->flash('message.content', 'KYC File submitted for review');
            return redirect()->back();
        }
    }

    public function reinvest(Request $request) {
        $check = Withdraw::whereUser_id(Auth::user()->id)->whereUser_withdrawal_id($request->id)->first();
        if (is_object($check)) {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'You can not re-invest this amount because payout is still pending.');
            return redirect()->back();
        }
        $usercoin = UserWithdrawal::whereId($request->id)->first();
        //check plan
        $plan = Plan::whereId($usercoin->plan_id)->first();
        DB::beginTransaction();
        try {
            $coin = $usercoin->usercoin->coin->slug;
            if (empty($coin)) {
                session()->flash('message.level', 'error');
                session()->flash('message.color', 'red');
                session()->flash('message.content', 'Invalid Payment Method');
                return redirect()->back();
            }
            $action = $coin;
            $current = Carbon::now();
            $status_deposit = true;
            $due = $current->addHours($plan->compound->compound);
            $due_pay = $due->addMinutes(2);
            $txt = strtolower(Str::random(8));
            //create investment
            $invest = Investment::create([
                        'transaction_id' => $txt,
                        'hash' => 'reinvest',
                        'user_id' => Auth::user()->id,
                        'plan_id' => $usercoin->plan_id,
                        'coin_id' => $usercoin->coin_id,
                        'amount' => $usercoin->amount,
                        'user_withdrawal_id' => $request->id,
                        'run_count' => 0,
                        'earn' => 0,
                        'due_pay' => $due_pay,
                        'status_deposit' => $status_deposit,
                        'settled_status' => 0,
                        'status' => 0
            ]);
            $profit = $invest->amount * $plan->percentage / 100;
            //transcation log
            Transaction::create([
                'user_id' => Auth::user()->id,
                'transaction_id' => $invest->transaction_id,
                'type' => "$usercoin->type Re-investment",
                'name_type' => 'Deposit',
                //'deposit_investment_charge' => $charge,
                'coin_id' => $usercoin->coin_id,
                'amount' => $invest->amount,
                'amount_profit' => $profit,
                'status' => true,
                'description' => "You Re-invested your $usercoin->type Under  " . $plan->name
            ]);

//amount in btc or lite or btc cash
            if ($action == 'bitcoin_address') {
                $data['name'] = 'BTC';
                $data['name_full'] = 'bitcoin';
            }
            if ($action == 'litecoin_address') {
                $data['name'] = 'LTE';
                $data['name_full'] = 'litecoin';
            }
            if ($action == 'ethereum_address') {

                $data['name'] = 'ETH';
                $data['name_full'] = 'ethereum';
            }
            if ($action == 'bitcoin_cash_address') {
//bitcoin cash
                $data['name'] = 'BTC Cash';
                $data['name_full'] = 'bitcoin-cash';
            }
            if ($action == 'dash_address') {
//dash
                $data['name'] = 'dash';
                $data['name_full'] = 'dash';
            }



//check reference for bouns
            $actionb = $coin;
            if ($actionb == 'bitcoin_address') {
                $name = 'Bitcoin';
            }
            if ($actionb == 'litecoin_address') {

                $name = 'Litecoin';
            }
            if ($actionb == 'ethereum_address') {
                $name = 'Ethereum';
            }
            if ($actionb == 'bitcoin_cash_address') {
                $name = 'Bitcoin Cash';
            }
            if ($actionb == 'dash_address') {
                $name = 'Dash';
            }
//
//        $user_ref = Reference::whereReferred_id($invest->user_id)->first();
////        if (is_object($user_ref)) {
////plan ref percentage
//            $bonus = $invest->amount * $invest->plan->ref / 100;
//            $pay = UserCoin::whereUser_id($user_ref->user_id)->whereCoin_id($invest->coin_id)->first();
//            if (is_object($pay)) {
//                $pay->bonus = $pay->bonus + $bonus;
//                $pay->save();
////transcation log
//                Transaction::create([
//                    'user_id' => $user_ref->user_id,
//                    'transaction_id' => $invest->transaction_id,
//                    'type' => 'Re-invest Referral Bonus',
//                    'name_type' => 'Referral Bonus',
//                    'coin_id' => $invest->coin_id,
//                    'amount' => $bonus,
//                    'status' => true,
//                    'amount_profit' => $bonus,
//                    'description' => 'Re-invest Referral Bonus Under ' . $invest->plan->name
//                ]);
//                $user_pay = $user_ref->refs->first_name . ' ' . $user_ref->refs->last_name;
//                $text = "You earned a referral bonus  of $$bonus for referring  $user_pay.";
//
//
//                $message = $text;
//
//                $this->sendMail($pay->user->email, $pay->user->first_name, 'Referral Bonus Notification', $message);
//            }
//        }
            //set user withdrawal status
            UserWithdrawal::whereId($invest->user_withdrawal_id)->update([
                'status' => false
            ]);

            $email = Auth::user()->email;
            $subject = 'New Re-Investment Notification';
            $message = ' You Re-invested your ' . $usercoin->type . ' $' . $invest->amount . " using " . $data ['name'] . "  Under " . $plan->name . "  .";
            // $this->sendMail($email, Auth::user()->username, $subject, $message);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        session()->flash('message.level', 'success');
        session()->flash('message.color', 'success');
        session()->flash('message.content', $usercoin->type . ' of ' . '$' . $invest->amount . ' Successfully Re-Invested');
        return redirect()->back();
    }

    public function getCoinCal(Request $request) {
        $plan = Plan::whereId($request->plan_id)->first();
        if ($request->amount < $plan->min) {
            $data['message_danger'] = 'Amount is too low for this Plan  ';
            $data['status'] = 401;
            return $data;
        }

        if ($plan->max != 0) {
            if ($request->amount > $plan->max) {
                $data['message_danger'] = 'Amount is too high for this Plan  ';
                $data['status'] = 401;
                return $data;
            }
        }
//        if ($request->amount > $plan->max) {
//            $data['message_danger'] = 'Amount is too high for this Plan  ';
//            $data['status'] = 401;
//            return $data;
//        }
        $p = number_format($plan->percentage, 1);
        $data['btc'] = "$p%";
        $setting = Setting::whereId(1)->first();
        $data['direct_bonus'] = "$plan->percentage% / $setting->level_1% / $setting->level_2% / $setting->level_3% / $setting->level_all% / $setting->level_all% / $setting->level_all% / $setting->level_all%";
        $data['amount'] = '$' . number_format($request->amount);
        $weeks = round($request->duration * 0.00595238);
        $profit = $request->amount * $plan->percentage / 100;
        $months = (int) $weeks;
        $earnAmount = $profit * $months;

        $data['percent'] = number_format($plan->percentage * $months, 1) . '%';
        $data['return'] = '$' . number_format($earnAmount, 1);
        $data['total'] = '$' . number_format($earnAmount + $request->amount, 1);

        $data['plan'] = $plan->id;
        $data['amount_cal'] = $request->amount;
        return $data;
    }

    public function uploadProof(Request $request) {
        $input = $request->all();
        $rules = [
            'message' => 'required',
            'images.*' => 'required|max:20000|mimes:png,jpg,jpeg',
        ];

        $error = static::getErrorMessageSweet($input, $rules);
        if ($error) {
            return $error;
        }

        if (empty($request->images)) {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'Image is required');
            return redirect()->back();
        }
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $rand = strtolower(Str::random(16));
                $name = $rand . '.' . $extension;
                $file->move(public_path('/deposit/proof'), $name);
                $proof = new DepositProof();
                if ($request->actions == 'deposit') {
                    $proof->invest_id = $request->id;
                    $proof->path = $name;
                    $proof->save();
                } else if ($request->actions == 'fundDeposit') {
                    $proof->user_money_id = $request->id;
                    $proof->path = $name;
                    $proof->save();
                } else {
                    $proof->education_id = $request->id;
                    $proof->path = $name;
                    $proof->save();
                }
            }
            //message
            $message = new DepositMessage();
            if ($request->actions == 'deposit') {
                $message->invest_id = $request->id;
                $message->message = $request->message;
                $message->save();
            } else if ($request->actions == 'fundDeposit') {
                $message->user_money_id = $request->id;
                $message->message = $request->message;
                $message->save();
            } else {
                $message->education_id = $request->id;
                $message->message = $request->message;
                $message->save();
            }
        }
        $setting = Setting::whereId(1)->first();
        //send message to admin
        $greeting = "Hello Admin";
        $name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        $text = "$name deposited  $$request->amount";
        Mail::to($setting->send_notify_email)->send(new MailSender('New Fund Deposit', $greeting, $text, '', ''));
        session()->flash('message.level', 'success');
        session()->flash('message.color', 'success');
        session()->flash('message.content', 'Deposit proof submitted successfully');
        return redirect()->back();
    }

}
