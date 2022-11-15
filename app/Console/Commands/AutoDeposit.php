<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use BlockIo;
use App\Models\Coin;
use App\Models\Admin\Setting;
use App\Models\UserCoin;
use App\Models\Reference;
use App\Models\Investment;
use App\Models\Transaction;
use App\Models\UserWithdrawal;
use App\Models\userTrackEarn;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Mail\MailSender;
use Illuminate\Support\Facades\Mail;

class AutoDeposit extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:deposit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'confirm deposit in background';

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
            $coins = Coin::all();
            foreach ($coins as $coin) {
                $action = $coin->id;
                if ($action == 1) {
                    $apiKey = $coin->api_key;
                    $version = 2; // API version
                    $block_io = new BlockIo($apiKey, $version);
                    $block_auto = $block_io->get_transactions(array('type' => 'received'));
                    foreach ($block_auto->data->txs as $data) {
                        if ($data->confidence >= 1 && $data->confirmations >= 3) {
                            $payment = Investment::whereAmount_check($data->amounts_received[0]->amount)->whereStatus_deposit(false)->whereNull('due_pay')->first();
                            if (is_object($payment)) {
                                $current = Carbon::now();
                                $status_deposit = true;
                                $due = $current->addHours($payment->plan->compound->compound);
                                $due_pay = $due->addMinutes(2);
                                $payment->update([
                                    'status_deposit' => $status_deposit,
                                    'due_pay' => $due_pay
                                ]);
                                //trans update
                                Transaction::whereTransaction_id($payment->transaction_id)->update([
                                    'status' => true
                                ]);
                                //check reference for bouns
                                $user_ref = Reference::whereReferred_id($payment->user_id)->first();
                                if (is_object($user_ref)) {
                                    $first_pay = UserCoin::whereUser_id($user_ref->user_id)->whereCoin_id($payment->usercoin->coin->id)->first();
                                    if (!is_object($first_pay)) {
                                        $first_pay = UserCoin::create([
                                                    'user_id' => $user_ref->user_id,
                                                    'coin_id' => $payment->usercoin->coin->id,
                                                    'address' => null
                                        ]);
                                    }

                                    if (is_object($first_pay)) {
                                        $reward = $payment->amount;

                                        $firstUserReward = $setting->level_1 / 100 * $reward;
                                        $secondUserReward = $setting->level_2 / 100 * $reward;

                                        //first reward
                                        $newFirstUserReward = $firstUserReward;
                                        //create user withdrawal data
                                        $user_withdraw = new UserWithdrawal();
                                        $user_withdraw->amount = $newFirstUserReward;
                                        $user_withdraw->user_id = $first_pay->user_id;
                                        $user_withdraw->coin_id = $first_pay->id;
                                        $user_withdraw->type = "Referral Bonus";
                                        $user_withdraw->status = true;
                                        $user_withdraw->plan_id = $payment->plan_id;
                                        $user_withdraw->save();
                                        $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($first_pay->user_id)));
                                        $userMoney->user_id = $first_pay->user_id;
                                        $userMoney->amount = $userMoney->amount + $newFirstUserReward;
                                        $userMoney->save();
                                        //transcation log
                                        Transaction::create([
                                            'user_id' => $first_pay->user_id,
                                            'transaction_id' => $payment->transaction_id,
                                            'type' => 'Commissions',
                                            'name_type' => 'Referral Bonus',
                                            'coin_id' => $first_pay->id,
                                            'amount' => $newFirstUserReward,
                                            'amount_profit' => $newFirstUserReward,
                                            'description' => 'Referral Bonus Under ' . $payment->plan->name . ' license',
                                            'status' => true
                                        ]);
                                        $message = 'USD' . $newFirstUserReward . " Referral Bonus has been successfully sent to you with  Transaction ID Is : #$payment->transaction_id";
                                        $first = $first_pay->user->email;
                                        $last = $first_pay->user->username;
                                        $greeting = "Hello $first $last";
                                        Mail::to($first_pay->user->email)->send(new MailSender('Referral Bonus', $greeting, $message, '', ''));
                                        //second reward
                                        $user_ref_second = Reference::whereReferred_id($first_pay->user_id)->first();
                                        if (is_object($user_ref_second)) {
                                            $second_pay = UserCoin::whereUser_id($user_ref_second->user_id)->whereCoin_id($payment->usercoin->coin->id)->first();
                                            if (!is_object($second_pay)) {
                                                $second_pay = UserCoin::create([
                                                            'user_id' => $user_ref_second->user_id,
                                                            'coin_id' => $payment->usercoin->coin->id,
                                                            'address' => null
                                                ]);
                                            }
                                            if (is_object($second_pay)) {
                                                $newSecondUserReward = $secondUserReward;
                                                //create user withdrawal data
                                                $user_withdraw_second = new UserWithdrawal();
                                                $user_withdraw_second->amount = $newSecondUserReward;
                                                $user_withdraw_second->user_id = $second_pay->user_id;
                                                $user_withdraw_second->coin_id = $second_pay->id;
                                                $user_withdraw_second->type = "Referral Bonus";
                                                $user_withdraw_second->status = true;
                                                $user_withdraw_second->plan_id = $payment->plan_id;
                                                $user_withdraw_second->save();
                                                $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($second_pay->user_id)));
                                                $userMoney->user_id = $second_pay->user_id;
                                                $userMoney->amount = $userMoney->amount + $newSecondUserReward;
                                                $userMoney->save();
                                                //transcation log
                                                Transaction::create([
                                                    'user_id' => $second_pay->user_id,
                                                    'transaction_id' => $payment->transaction_id,
                                                    'type' => 'Commissions',
                                                    'name_type' => 'Referral Bonus',
                                                    'coin_id' => $second_pay->id,
                                                    'amount' => $newSecondUserReward,
                                                    'amount_profit' => $newSecondUserReward,
                                                    'description' => 'Referral Bonus Under ' . $payment->plan->name . ' license',
                                                    'status' => true
                                                ]);
                                                $message_second = 'USD' . $newSecondUserReward . "Second step Referral Bonus has been successfully sent to you with Transaction ID Is : #$payment->transaction_id";
                                                $first = $second_pay->user->first_name;
                                                $last = $second_pay->user->last_name;
                                                $greeting = "Hello $first $last";
                                                Mail::to($second_pay->user->email)->send(new MailSender('Referral Bonus', $greeting, $message_second, '', ''));
                                            }
                                        }
                                    }
                                }



                                $email = $payment->user->email;
                                $name = $payment->user->first_name . ' ' . $payment->user->last_name;
                                $greeting = "Hello $name";
                                $url = "https://sochain.com/tx/BTC/" . $data->txid;
                                $message = $payment->plan->name . "  deposit has been confirmed, your investment just started";
                                $link = $url;
                                $link_name = " View on Blockchain";
                                Mail::to($email)->send(new MailSender('Plan  payment Confirmation', $greeting, $message, $link, $link_name));
                            }
                        }
                    }
                }

                if ($action == 'ethereum_address') {
                    $name = $payment->user->first_name . ' ' . $payment->user->last_name;
                    $greeting = "Hello admin $name deposited with Eth";
                    $text = "Eth is not supported fro  automation please kindly confirm this payment from admin under manage deposits";
                    //send admin email
                    Mail::to($setting->send_notify_email)->send(new MailSender('Eth deposit confirmation required', $greeting, $text, '', ''));
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return 'success';
    }

}
