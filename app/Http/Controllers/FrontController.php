<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Controllers\Traits\HasError;
use App\Models\Admin\Setting;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Notification;
use App\Mail\ContactUsMail;
use App\Mail\SubscriberMail;
use App\Models\EmailSubscriber;
use App\Models\Plan;
use App\Models\Investment;
use App\Models\Withdraw;
use App\Models\Coin;

class FrontController extends Controller {

    use HasError;

    public function index() {
        $data['coins'] = Coin::orderBy('created_at', 'asc')->whereStatus(true)->get();
        $data['plans'] = Plan::all();
        $data['last_deposits'] = Investment::inRandomOrder()->orderBy('created_at', 'desc')->take(6)->get();
        $data['last_withdraws'] = Withdraw::inRandomOrder()->orderBy('created_at', 'desc')->take(6)->get();
        return view('welcome', $data);
    }

    public function contact(Request $request) {
        $input = $request->all();
        $rules = ([
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'message' => ['required', 'string']
        ]);
        $error = static::getErrorMessage($input, $rules);
        if ($error) {
            return $error;
        }

        $input['name'] = $request->name;
        $input['email'] = $request->email;
        $setting = Setting::whereId(1)->first();
        ContactUs::create($input);
        $subject = 'Contact Us Notification';
        $name = $request->name;
        $email = $request->email;
        $message = $request->message;
        Notification::route('mail', $setting['send_notify_email'])
                ->notify(new ContactUsMail($subject, $name, $email, $message));
        return [
            'status' => 200,
            'message' => 'Message Sent, We will get back to You',
        ];
    }

    public function sub(Request $request) {
        $input = $request->all();
        $rules = ([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:email_subscribers']
        ]);
        $error = static::getErrorMessage($input, $rules);
        if ($error) {
            return $error;
        }
        EmailSubscriber::create($input);
        $subject = 'Subscription for Newsletter for Dailly Offer was Successfull';
        $message = "You can now keep receiving new offer Bonus directly to your email.";
        Notification::route('mail', $request->email)
                ->notify(new SubscriberMail($subject, $message));
        return [
            'status' => 200,
            'message' => 'Subscription for Newsletter for Dailly Offer was Successfull',
        ];
    }

    public function plan() {
        $data['plans'] = Plan::all()->except([12]);
        $data['plan_use'] = Plan::orderBy('created_at', 'asc')->take(1)->first();
        return view('pages.plan', $data);
    }

    public function education() {
        $data['plans'] = \App\Models\EducationLicensePlan::all();
        return view('pages.education', $data);
    }

    public function getPlan(Request $request) {
        $min = Plan::whereId($request->plan_id)->first();
        if ($min->name == 'PLAN 6') {
            $data['min'] = $min->min;
            $data['sign'] = 'BTC';
            $data['profit'] = $min->min * $min->percentage / 100;
        } else {
            $data['min'] = number_format($min->min, 2);
            $data['sign'] = '$';
            $data['profit'] = '$' . $min->min * $min->percentage / 100;
        }
        $data['amount'] = $min->min;
        $data['percentage'] = $min->percentage . '%';
        $data['p_id'] = $min->id;
        return $data;
    }

    public function getCoin(Request $request) {

        $plan = Plan::whereId($request->plan_id)->first();
        $general_coin = file_get_contents('https://api.coincap.io/v2/assets');
        $eth = $general_coin;
        $ethereum = json_decode($eth);
        $ethereum_final = $ethereum->data[1]->priceUsd;
        $data['eth'] = number_format(floatval($plan->min / $ethereum_final), 6, '.', '');
        ;
        $all = file_get_contents("https://blockchain.info/ticker");
        $res = json_decode($all);
        $btcrate = $res->USD->last;
        $data['btc'] = number_format(floatval($plan->min / $btcrate), 6, '.', '');
//        if ($request->amount < $plan->min) {
//            $data['message_danger'] = 'Amount less than minimum price  ';
//            $data['status'] = 401;
//            return $data;
//        }
//        if ($request->amount > $plan->max) {
//            $data['message_danger'] = 'Amount greater than Max price  ';
//            $data['status'] = 401;
//            return $data;
//        }
        $setting = Setting::whereId(1)->first();
        $data['direct_bonus'] = "$plan->percentage% / $setting->level_1% / $setting->level_2%";
        $data['amount'] = number_format($plan->min);
        $net_profit_cal = $plan->min * $plan->percentage / 100;
        $net_profit = $net_profit_cal * 30;
//        $return = $plan->min + $net_profit;
        $data['net_profit'] = number_format($net_profit);
        $data['return'] = number_format($net_profit_cal, 2);
        return $data;
    }

    public function faq() {
        $setting = Setting::whereId(1)->first();
        $array = array(
            'count' => 8,
            'next' => NULL,
            'previous' => NULL,
            'results' =>
            array(
                0 =>
                array(
                    'id' => 1,
                    'name' => 'Account Access',
                    'faqs' =>
                    array(
                        0 =>
                        array(
                            'title' => 'changing a registration email?',
                            'category' => 1,
                            'answer' => 'If the user changes the registration Email, for security reasons, the withdrawal of funds will be blocked for 7 days after changing the Email.',
                            'priority' => 999,
                            'html_answer' => '<p>If the user changes the registration Email, for security reasons, the withdrawal of funds will be blocked for 7 days after changing the Email..<br></p>',
                        ),
                        1 =>
                        array(
                            'title' => 'How to register an account?',
                            'category' => 1,
                            'answer' => 'Registration on the platform is possible only through an affiliate link. You can get an affiliate link from any platform affiliates, who daily publish photos and videos on social networks marked "FXgeneral” ',
                            'priority' => 999,
                            'html_answer' => '<p>Registration on the platform is possible only through an affiliate link. You can get an affiliate link from any platform affiliates, who daily publish photos and videos on social networks marked "FXgeneral” .</p>',
                        ),
                        2 =>
                        array(
                            'title' => 'Forgot your login?',
                            'category' => 1,
                            'answer' => 'If you have forgotten your email address used during registration, write to our customer support on the website or send an email to support@Fxgeneral .dev with a request to restore your username.',
                            'priority' => 999,
                            'html_answer' => '<p>If you have forgotten your email address used during registration, write to our customer support on the website or send an email to support@Fxgeneral .dev with a request to restore your username.</p>',
                        ),
                        3 =>
                        array(
                            'title' => 'Did you face troubles logging into your account?',
                            'category' => 1,
                            'answer' => 'Please check the email address and password that you enter. Also, clear your browser cookies and cache',
                            'priority' => 999,
                            'html_answer' => '<p>Please check the email address and password that you enter. Also, clear your browser cookies and cache.</p>',
                        ),
                        4 =>
                        array(
                            'title' => 'How to change the email address for an account?',
                            'category' => 1,
                            'answer' => 'To change Email on your account, you should write to support@Fxgeneral.dev from your current Email, to which your account is registered on the FXgeneral platform.',
                            'priority' => 999,
                            'html_answer' => '<p>To change Email on your account, you should write to support@Fxgeneral.dev from your current Email, to which your account is registered on the FXgeneral platform..</p>',
                        ),
                        5 =>
                        array(
                            'title' => 'Causes and circumstances that may lead to the blocking of the user\'s account.',
                            'category' => 1,
                            'answer' => 'Forbidden to:

1. Use of multiple user\'s accounts;
2. Use of illegally obtained income;
3. Use of funds received as bonuses from other user\'s accounts or multiple accounts;
4. Use of funds received as a result of operations committed by mistake;
5. Dissemination of false information about the activities of FXgeneral, discrediting the reputation of FXgeneral;
6. Dissemination of false information about employees, user\'s of FXgeneral, discrediting the reputation of FXgeneral;
7. Intentional misrepresentation information about FXgeneral employees and users;
8. An attempt to disrupt the FXgeneral website and software;
9. Hacking or attempts to hack or gain access to the accounts/wallets of FXgeneral employees and users;
10. Disclosure of information about FXgeneral employees and users to third parties, except for responses to official requests of authorized persons.

If a policy violation is detected, the FXgeneral user account may be blocked. A notification will be sent to the FXgeneral user email address explaining the reasons for the blocking and further instructions.',
                            'priority' => 999,
                            'html_answer' => '<h3><span style="font-family: Helvetica; font-size: 14px; white-space: pre-wrap; text-decoration-skip-ink: none;">Forbidden to:

1. Use of multiple user\'s accounts;
2. Use of illegally obtained income;
3. Use of funds received as bonuses from other user\'s accounts or multiple accounts;
4. Use of funds received as a result of operations committed by mistake;
5. Dissemination of false information about the activities of </span><span style="font-family: Helvetica; font-size: 14px; white-space: pre-wrap; text-decoration-skip-ink: none;">FXgeneral</span><span style="font-family: Helvetica; font-size: 14px; white-space: pre-wrap; text-decoration-skip-ink: none;">, discrediting the reputation of</span><span style="font-family: Helvetica; font-size: 14px; white-space: pre-wrap; text-decoration-skip-ink: none;"> FXgeneral</span><span style="font-family: Helvetica; font-size: 14px; white-space: pre-wrap; text-decoration-skip-ink: none;">;
6. Dissemination of false information about employees, users\' of </span><span style="font-family: Helvetica; font-size: 14px; white-space: pre-wrap; text-decoration-skip-ink: none;">FXgeneral</span><span style="font-family: Helvetica; font-size: 14px; white-space: pre-wrap; text-decoration-skip-ink: none;">, discrediting the reputation of FXgeneral;
7. Intentional misrepresentation information about </span><span style="font-family: Helvetica; font-size: 14px; white-space: pre-wrap; text-decoration-skip-ink: none;">FXgeneral</span><span style="font-family: Helvetica; font-size: 14px; white-space: pre-wrap; text-decoration-skip-ink: none;"> employees and users;
8. An attempt to disrupt the </span><span style="font-family: Helvetica; font-size: 14px; white-space: pre-wrap; text-decoration-skip-ink: none;">FXgeneral</span><span style="font-family: Helvetica; font-size: 14px; white-space: pre-wrap; text-decoration-skip-ink: none;"> website and software;
9. Hacking or attempts to hack or gain access to the accounts/wallets of </span><span style="font-family: Helvetica; font-size: 14px; white-space: pre-wrap; text-decoration-skip-ink: none;">FXgeneral</span><span style="font-family: Helvetica; font-size: 14px; white-space: pre-wrap; text-decoration-skip-ink: none;"> employees and users;
10. Disclosure of information about </span><span style="font-family: Helvetica; font-size: 14px; white-space: pre-wrap; text-decoration-skip-ink: none;">FXgeneral</span><span style="font-family: Helvetica; font-size: 14px; white-space: pre-wrap; text-decoration-skip-ink: none;"> employees and users to third parties, except for responses to official requests of authorized persons.

If a policy violation is detected, the </span><span style="font-family: Helvetica; font-size: 14px; white-space: pre-wrap; text-decoration-skip-ink: none;">FXgeneral</span><span style="font-family: Helvetica; font-size: 14px; white-space: pre-wrap; text-decoration-skip-ink: none;"> user account may be blocked. A notification will be sent to the </span><span style="font-family: Helvetica; font-size: 14px; white-space: pre-wrap; text-decoration-skip-ink: none;">FXgeneral</span><span style="font-family: Helvetica; font-size: 14px; white-space: pre-wrap; text-decoration-skip-ink: none;"> user email address explaining the reasons for the blocking and further instructions.</span><br></h3>',
                        ),
                        6 =>
                        array(
                            'title' => 'Forgot your password?',
                            'category' => 1,
                            'answer' => 'If you have forgotten your password, use the password recovery function, click \'Forgot?\', wait for the letter sent to the email address that you put during registration. Next, in the letter, click the \'Reset\' button, you will be redirected to set a new password. Fill in the form. After successful completion, you will be able to log in with a new password.',
                            'priority' => 999,
                            'html_answer' => '<p>If you have forgotten your password, use the password recovery function, click \'Forgot?\', wait for the letter sent to the email address that you put during registration. Next, in the letter, click the \'Reset\' button, you will be redirected to set a new password. Fill in the form. After successful completion, you will be able to log in with a new password.</p>',
                        ),
                    ),
                ),
                1 =>
                array(
                    'id' => 5,
                    'name' => 'Affiliate Program',
                    'faqs' =>
                    array(
                        0 =>
                        array(
                            'title' => 'How do I know who is my sponsor?',
                            'category' => 5,
                            'answer' => 'You can see who your sponsor is on the "My Network" page. Find the section "Affiliate Network" with the binary tree.',
                            'priority' => 999,
                            'html_answer' => '<p>You can see who your sponsor is on the "My Network" page. Find the section "Affiliate Network" with the binary tree.</p>',
                        ),
                        1 =>
                        array(
                            'title' => 'How does the Affiliate program work?',
                            'category' => 5,
                            'answer' => 'And we’ve a two referral-level program:
*Level 1:(direct referral 1x1 4%)
*Level 2: (indirect referral 1x2 2.5%)
And this bonuses are paid instantly once the customer gets involved, If you refer a customer you earn 4% referral bonus instantly of the amount deposited (level 1) and if the customer you refer brings in another customer you earn 2.5% referral bonuses from the customer your direct referral brings along( level 2).
And the more this people re-invests the more you earn a referral commission depending on the referral level the customer falls in. ',
                            'priority' => 999,
                            'html_answer' => '<p> And we’ve a two referral-level program:
                                <br/>
*Level 1:(direct referral 1x1 4%)
  <br/>
*Level 2: (indirect referral 1x2 2.5%)
  <br/>
And this bonuses are paid instantly once the customer gets involved, If you refer a customer you earn 4% referral bonus instantly of the amount deposited (level 1) and if the customer you refer brings in another customer you earn 2.5% referral bonuses from the customer your direct referral brings along( level 2).
  <br/>
And the more this people re-invests the more you earn a referral commission depending on the referral level the customer falls in. <br></p>',
                        ),
                    ),
                ),
                2 =>
                array(
                    'id' => 6,
                    'name' => 'Financial Transactions',
                    'faqs' =>
                    array(
                        0 =>
                        array(
                            'title' => 'Adding a Blockchain wallet address',
                            'category' => 6,
                            'answer' => 'When adding a new blockchain wallet address on the FXgeneral platform, for security reasons, the withdrawal of funds will be blocked for 3 days after adding a new address.',
                            'priority' => 999,
                            'html_answer' => '<p>When adding a new blockchain wallet address on the FXgeneral platform, for security reasons, the withdrawal of funds will be blocked for 3 days after adding a new address.<br></p>',
                        ),
                        1 =>
                        array(
                            'title' => 'Deposit and withdrawal process',
                            'category' => 6,
                            'answer' => 'Deposits and withdrawals are made in BTC, ETH.
All internal platform\'s transactions, licenses\' activation and settlements with users are made in USDT.
At the time of execution of the withdrawal request, FXgeneral converts USDT to BTC, ETH and sends cryptocurrencies to the user\'s blockchain wallet address.',
                            'priority' => 999,
                            'html_answer' => '<p>Deposits and withdrawals are made in BTC, ETH.</p>
<p>All internal platform\'s transactions, licenses\' activation and settlements with users are made in USDT.</p>
<p>At the time of execution of the withdrawal request, FXgeneral converts USDT to BTC, ETH and sends cryptocurrencies to the user\'s blockchain wallet address.</p>',
                        ),
                        2 =>
                        array(
                            'title' => 'Withdrawal of funds',
                            'category' => 6,
                            'answer' => 'To withdraw funds, you need to add your blockchain wallet address at FXgeneral platform. To do this, use the button of \'Wallet\' on the account page.',
                            'priority' => 999,
                            'html_answer' => '<p>To withdraw funds, you need to add your blockchain wallet address at FXgeneral platform. To do this, use the button of \'Wallet\' on the account page.</p>',
                        ),
                        3 =>
                        array(
                            'title' => 'How to buy a cryptocurrency?',
                            'category' => 6,
                            'answer' => 'Initially, you need to create a personal wallet at https://www.blockchain.com. To buy or sell BTC or ETH, all qubitTech\'s users use the p2p platforms, which is available in more than 100 countries.The most popular and secure p2p platforms:


https://www.localbitcoin.com
https://localcoinswap.com
https://hodlhodl.com
https://bisq.network


On YouTube, you can find a lot of video on how to make a personal blockchain wallet and how to work with p2p platforms.',
                            'priority' => 999,
                            'html_answer' => '<p>Initially, you need to create a personal wallet at https://www.blockchain.com. To buy or sell BTC or ETH, all qubitTech\'s users use the p2p platforms, which is available in more than 100 countries.The most popular and secure p2p platforms:</p><p><a href="https://www.localbitcoin.com">https://www.localbitcoin.com</a><a href="https://www.localbitcoin.com"></a><br><a href="https://localcoinswap.com">https://localcoinswap.com</a><a href="https://localcoinswap.com" style="background-color: rgb(255, 255, 255);"></a><br><a href="https://hodlhodl.com">https://hodlhodl.com</a><a href="https://hodlhodl.com" style="background-color: rgb(255, 255, 255);"></a><br><a href="https://bisq.network" style="background-color: rgb(255, 255, 255);">https://bisq.network</a>&nbsp;</p><p>On YouTube, you can find a lot of video on how to make a personal blockchain wallet and how to work with p2p platforms.<br></p>',
                        ),
                        4 =>
                        array(
                            'title' => 'Processing time for withdrawal requests',
                            'category' => 6,
                            'answer' => ' All deposits and withdrawals are done on weekends( Saturday-Sunday) then trades commence from Monday-Friday( and no deposits is allowed again till weekend.


The minimum withdrawal amount is $20, while the minimum deposit amount to join is $50. 

Both deposits and withdrawals are available in BTC and ETH.

The withdrawal process usually takes from 30 minutes. In some cases, and with a heavy load on the blockchain network, the withdrawal process can take up to 72 hours.

In case of a high load on the blockchain network, as well as a large number of requests from users, the processing of the transactions can take up to 5 days

We recommend to you do not cancel withdrawal requests unnecessarily as this may lead to re-creation of the request and increased waiting times.',
                            'priority' => 999,
                            'html_answer' => '<p> All deposits and withdrawals are done on weekends( Saturday-Sunday) then trades commence from Monday-Friday( and no deposits is allowed again till weekend.
</p>
<p>The minimum withdrawal amount is $20, while the minimum deposit amount to join is $50.</p>
<p>Both deposits and withdrawals are available in BTC and ETH.</p>
<p>The withdrawal process usually takes from 30 minutes. In some cases, and with a 
heavy load on the blockchain network, the withdrawal process can take up to 72 hours.
</p><p>In case of a high load on the blockchain network, as well as a large number of requests from users, the processing of the transactions can take up to 5 days
</p><p>We recommend to you do not cancel withdrawal requests unnecessarily as this may lead to re-creation of the request and increased waiting times.</p>',
                        ),
                    ),
                ),
            ),
        );
        return $array;
    }

    public function pdf() {
        $file = public_path('frontend/cobit-pdf.pdf');
        return response()->file($file);
    }

}
