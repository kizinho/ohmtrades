<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transaction;
use App\Models\Admin\Setting;
use App\Models\Withdraw;
use Illuminate\Support\Facades\DB;
use App\Models\UserWithdrawal;
use App\Mail\MailSender;
use Illuminate\Support\Facades\Mail;
use App\Models\userTrackEarn;
use App\Models\UserCoin;
use App\Models\User;
use BlockIo;
use Illuminate\Support\Str;

class AutoWithdrawal extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:withraw';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pay user automatically';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        $setting = Setting::whereId(1)->first();
        DB::beginTransaction();
        try {
//        $pin = $setting->block_io_pin;
            $on = $setting['auto_withdraw'];
            if ($on == true) {
                $all_money = userTrackEarn::orderBy('created_at', 'desc')->get();
                $group_money = $all_money->groupBy('user_id');
                if (is_object($group_money)) {
                    foreach ($group_money as $key => $money) {
                        $sum_amount = $money->sum('amount');
                        if ($sum_amount != 0) {
                            $cal_charge = $sum_amount * $setting['withdraw_charge'] / 100;
                            $charge = $cal_charge;
                            $sum = $sum_amount - $charge;

                            $user_coin = UserCoin::whereUser_id($key)->wherePreferable(true)->first();
                            if (is_object($user_coin)) {
                                $action = $user_coin->coin->id;

                                $all = file_get_contents("https://blockchain.info/ticker");
                                $res = json_decode($all);
                                $btcrate = $res->USD->last;
                                $btc_amount = number_format(floatval($sum / $btcrate), 6, '.', '');

                                if ($action == 1) {
                                    $name = 'Bitcoin';
//                            $apiKey = $user_coin->coin->api_key;
//                            $version = 2; // API version
//                            $block_io = new BlockIo($apiKey, $pin, $version);
//                            $site_address = $user_coin->coin->address;
                                    $am_check = $btc_amount;
                                } else {
                                    try {
                                      $general_coin = file_get_contents('https://api.blockchain.com/v3/exchange/tickers/ETH-USD');
                                    } catch (\Exception $e) {
                                        $greeting = 'Hello ' . $user_coin->user->first_name . ' ' . $user_coin->user->last_name . ' automatic payout Initiated';
                                        $text = "This error was because of the current api we are using coincap.io ";
                                        //send admin email
                                        Mail::to($setting->send_notify_email)->send(new MailSender('Automatic payouts coincap.io error', $greeting, $text, '', ''));
                                    }
                                    $eth = $general_coin;
                                    $ethereum = json_decode($eth);
                                    $ethereum_final = $ethereum->last_trade_price;
                                    $eth_amount = number_format(floatval($sum / $ethereum_final), 6, '.', '');
                                    $name = 'Ethereum';
//                            $apiKey = $user_coin->coin->api_key;
//                            $version = 2; // API version
//                            $block_io = new BlockIo($apiKey, $pin, $version);
//                            $site_address = $user_coin->coin->address;
                                    $am_check = $eth_amount;
                                }

                                $withdraw = Withdraw::create([
                                            'transaction_id' => strtoupper(Str::random(20)),
                                            'user_id' => $key,
                                            'coin_id' => $user_coin->id,
                                            'withdraw_from' => 'Wallet Balance',
                                            'description' => 'Automatic payout of  ' . 'USD' . $sum_amount,
                                            'amount' => $sum_amount,
//                                    'comment' => $request->comment,
                                            'total_amount' => $sum_amount + $charge,
                                            'withdraw_charge' => $charge,
                                            'message' => null,
                                            'amount_check' => $am_check,
                                            'confirm' => true,
                                            'status' => 0
                                ]);
                                //transcation log
                                Transaction::create([
                                    'user_id' => $withdraw->user_id,
                                    'transaction_id' => $withdraw->transaction_id,
                                    'type' => 'Withdraw',
                                    'name_type' => 'Withdraw',
                                    'withdraw_charge' => $charge,
                                    'coin_id' => $user_coin->id,
                                    'amount' => $sum_amount,
                                    'description' => 'Automatic payout of  ' . 'USD' . $sum_amount,
                                ]);

//                        if ($action == 1) {
                                try {
//                                $block_io->withdraw_from_addresses(array('amounts' => $withdraw->amount_check, $am_check, 'from_addresses' => $site_address, 'to_addresses' => $user_coin->address));
//                               
                                    $greeting = 'Hello ' . $user_coin->user->first_name . ' ' . $user_coin->user->last_name . ' automatic payout Initiated';
                                    $text = "We have forwared your payout , wait for it to arrived . Amount $sum_amount USD";
                                    //send admin email
                                    Mail::to($setting->send_notify_email)->send(new MailSender('Automatic payouts', $greeting, $text, '', ''));
                                    $userearn = userTrackEarn::whereUser_id($key)->first();
                                    $userearn->update([
                                        'amount' => $userearn->amount - $sum_amount
                                    ]);
//                                    $update_money = $money->pluck('id');
//                                    UserWithdrawal::whereIn('id', $update_money)->update([
//                                        'status' => false
//                                    ]);
                                } catch (\Exception $e) {
                                    Withdraw::whereId($withdraw->id)->delete();
                                    $greeting = 'Hello admin ' . $user_coin->user->first_name . ' ' . $user_coin->user->last_name . ' automatic payout falied';
                                    $text = "Automatic payouts fails because of no fund in your block io wallet please fund the wallet";
                                    //send admin email
                                    Mail::to($setting->send_notify_email)->send(new MailSender('Automatic payout fails', $greeting, $text, '', ''));
                                    //send email to admin
                                }
//                        }
//                         else {
//                            $greeting = 'Hello admin ' . $user_coin->user->first_name . ' ' . $user_coin->user->last_name . ' made automatic withdrawal of ' . $am_check . 'Eth ';
//                            $text = "Automatic payouts of Eth not available please pay this user and confirm it from admin . user wallet : $user_coin->address : Amount $am_check Eth ";
//                            //send admin email
//                            Mail::to($setting->send_notify_email)->send(new MailSender('Eth Automatic payout', $greeting, $text, '', ''));
//                            //email admin
//                        }
                            } else {
                                $user = User::whereId($key)->first();

                                $name = $user->first_name . ' ' . $user->last_name;
                                $greeting = "Hello $name";
                                $text = "We tried to initiate automatic payout but no withdraw wallet was found in your account please add one and make it Preferable";
                                Mail::to($user->email)->send(new MailSender('Withdrawal Address Required', $greeting, $text, '', ''));
                            }
                        }
                    }
                }
            }


            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

}
