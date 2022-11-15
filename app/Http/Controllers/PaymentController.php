<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Rave;
use Illuminate\Support\Facades\Redirect;
use App\Mail\PlanDepositMail;
use App\Transaction;
use App\Investment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;
use App\Reference;
use App\UserCoin;

class PaymentController extends Controller {

    public function initialize() {
        Rave::initialize(route('callback'));
    }

    public function callback(Request $request) {

        $resp = $request->resp;
        $body = json_decode($resp, true);
        $txRef = $body['tx']['txRef'];
        $data = Rave::verifyTransaction($txRef);
        $status = $data->data->status;
        if ($status == 'successful') {

            $payment = Investment::whereTransaction_id($txRef)->first();
            $current = Carbon::now();
            $status_deposit = true;
            $due = $current->addHours($payment->plan->compound->compound);
            $due_pay = $due->addMinutes(2);
            $payment->update([
                'status_deposit' => $status_deposit,
                'due_pay' => $due_pay
            ]);
            $namep = '$' . $payment->amount;
            $action = $payment->coin->slug;
            if ($action == 'bitcoin_address') {
                $name = 'BTC';
            }
            if ($action == 'litecoin_address') {

                $name = 'LTE';
            }
            if ($action == 'ethereum_address') {
                $name = 'ETH';
            }
            if ($action == 'bitcoin_cash_address') {
                $name = 'BTC Cash';
            }
            if ($action == 'dash_address') {
                $name = 'dash';
            }

            //check reference for bouns
            $actionb = $payment->coin->slug;
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
            $address = $payment->usercoin->address;

            $user_ref = Reference::whereReferred_id($payment->user_id)->first();
            if (is_object($user_ref)) {
                //plan ref percentage
                $bonus = $payment->amount * $payment->plan->ref / 100;
                $pay = UserCoin::whereUser_id($user_ref->user_id)->whereCoin_id($payment->coin_id)->first();
                if (is_object($pay)) {
                    $pay->bonus = $pay->bonus + $bonus;
                    $pay->save();
                    //transcation log
                    Transaction::create([
                        'user_id' => $payment->user_id,
                        'transaction_id' => $payment->transaction_id,
                        'type' => 'Commissions',
                        'name_type' => 'Referral Bonus',
                        'coin_id' => $payment->coin_id,
                        'amount' => $bonus,
                        'amount_profit' => $bonus,
                        'description' => 'Referral Bonus Under ' . $payment->plan->name,
                        'status' => true
                    ]);
                    $message = '$' . $bonus . " Referral Bonus has been successfully sent your " . $name . " account " . $address . '.' . " Transaction ID Is : #$payment->transaction_id";

                    $text = $message;
                    $this->sendMail($pay->user->email, $pay->user->full_name, 'Referral Bonus.', $text);
                }
            }

            $trans = Transaction::whereTransaction_id($payment->transaction_id)->first();
            $trans->update([
                'status' => true
            ]);


            $email = $payment->user->email;
            $subject = 'New investment';
            $greeting = "Dear! ". $payment->user->full_name;
            $message = $namep . " - " . $name . " Invest Under " . $payment->plan->name . " Transaction ID Is : #$payment->transaction_id";

            Notification::route('mail', $email)
                    ->notify(new PlanDepositMail($subject, $message, $greeting));
            session()->flash('message.level', 'success');
            session()->flash('message.color', 'green');
            session()->flash('message.content', 'Payment received and investment started');
            return redirect()->to('user/dashboard');
        } else {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'Something snap! try making payment again');
            return redirect()->to('deposit');
        }
    }

//fund 
    public function fund(Request $request) {

        $amount_details = Session::get('amount_details');
        $confirm_details = Session::get('payment_details');
        if (empty($amount_details)) {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'No Payment Amount Added');
            return redirect()->to('account-setting#sub');
        }
        if (empty($confirm_details)) {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'No Payment Details Added');
            return redirect()->to('account-setting#sub');
        }
        $check_month = json_decode($request->metadata, true);
        //check month to see if they are same
        if ($check_month[0]['metavalue'] !== $amount_details['month']) {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'You are trying to cheat our system please stop and contact us for upgrade');
            return redirect()->to('confirm-payment');
        }
        if ($amount_details['payment_type'] == 'package') {
            //check plan to see if they are same
            if ($check_month[0]['metavalue'] !== $amount_details['month']) {
                session()->flash('message.level', 'error');
                session()->flash('message.color', 'red');
                session()->flash('message.content', 'You are trying to cheat our system please stop and contact us for upgrade');
                return redirect()->to('confirm-payment');
            }
        }
        if ($amount_details['payment_type'] == 'api' || $amount_details['payment_type'] == 'package' || $amount_details['payment_type'] == 'fund') {

            $orderRef = ([
                'txt_id' => 'mp3tager-' . md5(uniqid()),
                'payment_channel' => 'Account Fund',
                'usd_naira' => ''
            ]);
            try {
                $payment_details = array_merge($orderRef, $amount_details, $confirm_details);
                if ($payment_details['currency_sign'] == 'NGN') {
                    $payment_details['usd_naira'] = round($payment_details['payable_amount'] / config('app.naira_usd'), 2);
                } else {
                    $payment_details['usd_naira'] = $payment_details['payable_amount'];
                }
                $client_details = static::client();
                $url = config('app.naijacrawl_api') . '/receive-success-payment';
                $response = $client_details['client']->request('POST', $url, [
                    'headers' => $client_details['headers'],
                    'query' => $payment_details
                ]);

                $res = json_decode($response->getBody());

                if ($res->status == 422) {
                    session()->flash('message.level', 'error');
                    session()->flash('message.color', 'red');
                    session()->flash('message.content', $res->message);
                    return redirect()->to('confirm-payment');
                }
                //decide to send another email to new email contact or default contact
                if ($amount_details['payment_type'] == 'api') {
                    $message = 'Payment was made with a success ';
                    $type = $amount_details['payment_type'];
                    //$this->sendMailPayment($confirm_details['email'], $confirm_details['first_name'] . ' ' . $confirm_details['last_name'], 'Receipt from Mp3tager ', $message, $type,$payment_details);
                }
                if ($amount_details['payment_type'] == 'package') {
                    
                }
                if ($amount_details['payment_type'] == 'fund') {
                    
                }
                $userData = session('userData');
                Cache::forget($userData);
                Cache::forget($userData . 'dashboard');
                session()->forget('amount_details');
                session()->forget('payment_details');
                session()->flash('message.level', 'success');
                session()->flash('message.color', 'green');
                session()->flash('message.content', 'Payment was made with a success');
                if ($amount_details['payment_type'] == 'package') {
                    return redirect()->to('account-setting#myplan');
                } else {
                    return redirect()->to('account-setting#sub');
                }
            } catch (\GuzzleHttp\Exception\RequestException $res) {

                if ($res->hasResponse()) {
                    $response = $res->getResponse();
                    if ($response->getStatusCode() == 500) {
                        abort(500);
                    }
                    if ($response->getStatusCode() == 404) {
                        abort(404);
                    }
                }
            }
        } else {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'We dont understand this type of payment request');
            return redirect()->to('account-setting#sub');
        }
    }

    //crypTo 
    public function crypTo(Request $request) {

        $amount_details = Session::get('amount_details');
        $confirm_details = Session::get('payment_details');
        if (empty($amount_details)) {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'No Payment Amount Added');
            return redirect()->to('account-setting#sub');
        }
        if (empty($confirm_details)) {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'No Payment Details Added');
            return redirect()->to('account-setting#sub');
        }
        $check_month = json_decode($request->metadata, true);
        //check month to see if they are same
        if ($check_month[0]['metavalue'] !== $amount_details['month']) {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'You are trying to cheat our system please stop and contact us for upgrade');
            return redirect()->to('confirm-payment');
        }
        if ($amount_details['payment_type'] == 'package') {
            //check plan to see if they are same
            if ($check_month[0]['metavalue'] !== $amount_details['plan_id']) {
                session()->flash('message.level', 'error');
                session()->flash('message.color', 'red');
                session()->flash('message.content', 'You are trying to cheat our system please stop and contact us for upgrade');
                return redirect()->to('confirm-payment');
            }
        }
        if ($amount_details['payment_type'] == 'api' || $amount_details['payment_type'] == 'package' || $amount_details['payment_type'] == 'fund') {

            $orderRef = ([
                'txt_id' => 'mp3tager-' . md5(uniqid()),
                'payment_channel' => 'Crypto',
            ]);
            $payment_details = array_merge($orderRef, $amount_details, $confirm_details);
            try {
                $invoice = LaravelBitpay::Invoice();
                // Set item details (Only 1 item)
                $invoice->setItemDesc($payment_details['type']);
                $invoice->setItemCode($payment_details['month_type']);
                $invoice->setPrice($payment_details['payable_amount']);

                // Please make sure you provide unique orderid for each invoice
                $invoice->setOrderId($payment_details['txt_id']); // E.g. Your order number
                // Create Buyer Instance
                $buyer = LaravelBitpay::Buyer();
                $buyer->setName($payment_details['first_name'] . ' ' . $payment_details['last_name']);
                $buyer->setEmail($payment_details['email']);
                $buyer->setAddress1($payment_details['address']);
                $buyer->setNotify(true);

                // Add buyer to invoice
                $invoice->setBuyer($buyer);

                // Set currency
                $invoice->setCurrency($payment_details['currency_sign']);

                // Set redirect url to get back after completing the payment. GET Request
                $invoice->setRedirectURL(route('bitpay-redirect-back'));

                // Optional config. setNotificationUrl()
                // By default, package handles webhooks and dispatches BitpayWebhookReceived event as described above.
                // If you want to handle webhooks your way, you can provide url below. 
                // If handled manually, BitpayWebhookReceived event will not be dispatched.    
                //  $invoice->setNotificationUrl('Your custom POST route to handle webhooks');
                // Create invoice on bitpay server.
                $invoice = LaravelBitpay::createInvoice($invoice);

                // You can save invoice ID from server, for your your reference
                $invoiceId = $invoice->getId();
                $bitpay = ([
                    'invoiceId' => $invoiceId,
                ]);
                $request->session()->put('bitpay', $bitpay);
                $paymentUrl = $invoice->getUrl();
                //insert for query
                $bitpay_id = Session::get('bitpay');
                $orderRef_id = ([
                    'txt_id' => $bitpay_id['invoiceId'],
                    'payment_channel' => "Crypto",
                    'status' => false
                ]);
                try {
                    $payment_details_order = array_merge($orderRef_id, $amount_details, $confirm_details);
                    $client_details = static::client();
                    $url = config('app.naijacrawl_api') . '/receive-success-payment';
                    $response = $client_details['client']->request('POST', $url, [
                        'headers' => $client_details['headers'],
                        'query' => $payment_details_order
                    ]);

                    $res = json_decode($response->getBody());

                    $userData = session('userData');
                    Cache::forget($userData);
                    Cache::forget($userData . 'dashboard');
                    session()->forget('amount_details');
                    session()->forget('bitpay');
                    session()->forget('payment_details');
                } catch (\GuzzleHttp\Exception\RequestException $res) {

                    if ($res->hasResponse()) {
                        $response = $res->getResponse();
                        if ($response->getStatusCode() == 500) {
                            abort(500);
                        }
                        if ($response->getStatusCode() == 404) {
                            abort(404);
                        }
                    }
                }

                // Redirect user to following URL for payment approval.
                return Redirect::to($paymentUrl);
            } catch (\Exception $e) {
                session()->flash('message.level', 'error');
                session()->flash('message.color', 'red');
                session()->flash('message.content', 'Something went wrong , please try another payment method');
                return redirect()->back();
            }
        } else {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'We dont understand this type of payment request');
            if ($amount_details['payment_type'] == 'package') {
                return redirect()->to('account-setting#myplan');
            } else {
                return redirect()->to('account-setting#sub');
            }
        }
    }

    public function bitPay() {
        $userData = session('userData');
        Cache::forget($userData);
        Cache::forget($userData . 'dashboard');
        session()->forget('amount_details');
        session()->forget('payment_details');
        session()->forget('bitpay');
        session()->flash('message.level', 'success');
        session()->flash('message.color', 'green');
        session()->flash('message.content', 'Payment was made with a success , please wait for confirmation');
        return redirect()->to('account-setting');
    }

    public static function client() {
        $token = Session::get('token');
        $headers = [
            'Authorization' => $token,
            'API-Key' => env('API_KEY')
        ];
        $client = new Client();
        return [
            'headers' => $headers,
            'client' => $client
        ];
    }

}
