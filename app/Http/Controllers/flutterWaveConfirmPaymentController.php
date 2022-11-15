<?php

namespace App\Http\Controllers;

use Rave;
use App\TraitsFolder\MailTrait;
use App\Investment;
use App\Transaction;
use Illuminate\Support\Carbon;
use App\Reference;
use App\UserCoin;
class flutterWaveConfirmPaymentController extends Controller {

    use MailTrait;

    public function Confirm() {
        $data_invest = Investment::whereStatus_deposit(false)->orderBy('created_at', 'desc')->get();
        foreach ($data_invest as $await) {
            $data = Rave::verifyTransaction($await->transaction_id);
            $status = $data->data->status;
            if ($status == 'successful') {
                $payment = Investment::whereTransaction_id($await->transaction_id)->first();
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
                $message = $namep . " - " . $name . " Invest Under " . $payment->plan->name . " Transaction ID Is : #$payment->transaction_id";
                $this->sendMail($email, $payment->user->full_name, $subject, $message);
            }
        }
        return [
            'message' => 'job done'
        ];
    }

}
