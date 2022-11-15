<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use BlockIo;
use App\Models\Coin;
use App\Models\Admin\Setting;
use App\Models\UserCoin;
use App\Models\Reference;
use App\Models\UserEducationLicensePlan;
use App\Models\Transaction;
use App\Models\UserWithdrawal;
use App\Models\userTrackEarn;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Mail\MailSender;
use Illuminate\Support\Facades\Mail;

class ConfirmEducationLicense extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:educationlicense';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'confirm educationlicense deposit in background';

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
                            $payment = UserEducationLicensePlan::whereAmount_check($data->amounts_received[0]->amount)->whereStatus_deposit(false)->whereNull('due_pay')->first();
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
                                $reward = $payment->amount;

                                $firstUserReward = $setting->level_eduction_license_1 / 100 * $reward;
                                $allReward = $setting->level_eduction_license_2_7 / 100 * $reward;
                                $newUserReward = $allReward;
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

                                    $userSignalSub = UserEducationLicensePlan::whereUser_id($user_ref->user_id)->where('due_pay', '>', Carbon::now())->first();
                                    if (is_object($first_pay) && is_object($userSignalSub)) {

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
                                            'name_type' => 'Referral Bonus  Educational License',
                                            'coin_id' => $first_pay->id,
                                            'amount' => $newFirstUserReward,
                                            'amount_profit' => $newFirstUserReward,
                                            'description' => 'Referral Bonus Under Educational License ' . $payment->plan->name . ' license',
                                            'status' => true
                                        ]);
                                        $message = 'USD' . $newFirstUserReward . "  Educational License Referral Bonus has been successfully sent to you with  Transaction ID Is : #$payment->transaction_id";
                                        $first = $first_pay->user->email;
                                        $last = $first_pay->user->username;
                                        $greeting = "Hello $first $last";
                                        Mail::to($first_pay->user->email)->send(new MailSender('Referral Bonus  Educational License', $greeting, $message, '', ''));
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
                                            $userSignalSub = UserEducationLicensePlan::whereUser_id($user_ref_second->user_id)->where('due_pay', '>', Carbon::now())->first();
                                            if (is_object($second_pay) && is_object($userSignalSub)) {

                                                //create user withdrawal data
                                                $user_withdraw_second = new UserWithdrawal();
                                                $user_withdraw_second->amount = $newUserReward;
                                                $user_withdraw_second->user_id = $second_pay->user_id;
                                                $user_withdraw_second->coin_id = $second_pay->id;
                                                $user_withdraw_second->type = "Referral Bonus  Educational License";
                                                $user_withdraw_second->status = true;
                                                $user_withdraw_second->plan_id = $payment->plan_id;
                                                $user_withdraw_second->save();
                                                $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($second_pay->user_id)));
                                                $userMoney->user_id = $second_pay->user_id;
                                                $userMoney->amount = $userMoney->amount + $newUserReward;
                                                $userMoney->save();
                                                //transcation log
                                                Transaction::create([
                                                    'user_id' => $second_pay->user_id,
                                                    'transaction_id' => $payment->transaction_id,
                                                    'type' => 'Commissions',
                                                    'name_type' => 'Referral Bonus',
                                                    'coin_id' => $second_pay->id,
                                                    'amount' => $newUserReward,
                                                    'amount_profit' => $newUserReward,
                                                    'description' => 'Referral Bonus Under  Educational License' . $payment->plan->name . ' license',
                                                    'status' => true
                                                ]);
                                                $message_second = 'USD' . $newUserReward . " Educational License Second step Referral Bonus has been successfully sent to you with Transaction ID Is : #$payment->transaction_id";
                                                $first = $second_pay->user->first_name;
                                                $last = $second_pay->user->last_name;
                                                $greeting = "Hello $first $last";
                                                Mail::to($second_pay->user->email)->send(new MailSender('Referral Bonus  Educational License', $greeting, $message_second, '', ''));
                                                ///third
                                                $user_ref_third = Reference::whereReferred_id($second_pay->user_id)->first();
                                                if (is_object($user_ref_third)) {
                                                    $third_pay = UserCoin::whereUser_id($user_ref_third->user_id)->whereCoin_id($payment->usercoin->coin->id)->first();
                                                    if (!is_object($third_pay)) {
                                                        $third_pay = UserCoin::create([
                                                                    'user_id' => $user_ref_third->user_id,
                                                                    'coin_id' => $payment->usercoin->coin->id,
                                                                    'address' => null
                                                        ]);
                                                    }
                                                    $userSignalSub = UserEducationLicensePlan::whereUser_id($user_ref_third->user_id)->where('due_pay', '>', Carbon::now())->first();
                                                    if (is_object($third_pay) && is_object($userSignalSub)) {

                                                        //create user withdrawal data
                                                        $user_withdraw_third = new UserWithdrawal();
                                                        $user_withdraw_third->amount = $newUserReward;
                                                        $user_withdraw_third->user_id = $third_pay->user_id;
                                                        $user_withdraw_third->coin_id = $third_pay->id;
                                                        $user_withdraw_third->type = "Referral Bonus  Educational License";
                                                        $user_withdraw_third->status = true;
                                                        $user_withdraw_third->plan_id = $payment->plan_id;
                                                        $user_withdraw_third->save();
                                                        $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($third_pay->user_id)));
                                                        $userMoney->user_id = $third_pay->user_id;
                                                        $userMoney->amount = $userMoney->amount + $newUserReward;
                                                        $userMoney->save();
                                                        //transcation log
                                                        Transaction::create([
                                                            'user_id' => $third_pay->user_id,
                                                            'transaction_id' => $payment->transaction_id,
                                                            'type' => 'Commissions',
                                                            'name_type' => 'Referral Bonus',
                                                            'coin_id' => $third_pay->id,
                                                            'amount' => $newUserReward,
                                                            'amount_profit' => $newUserReward,
                                                            'description' => 'Referral Bonus Under  Educational License' . $payment->plan->name . ' license',
                                                            'status' => true
                                                        ]);
                                                        $message_third = 'USD' . $newUserReward . " Educational License Third step Referral Bonus has been successfully sent to you with Transaction ID Is : #$payment->transaction_id";
                                                        $first = $third_pay->user->first_name;
                                                        $last = $third_pay->user->last_name;
                                                        $greeting = "Hello $first $last";
                                                        Mail::to($third_pay->user->email)->send(new MailSender('Referral Bonus  Educational License', $greeting, $message_third, '', ''));

                                                        ///fourth
                                                        $user_ref_fourth = Reference::whereReferred_id($third_pay->user_id)->first();
                                                        if (is_object($user_ref_fourth)) {
                                                            $fourth_pay = UserCoin::whereUser_id($user_ref_fourth->user_id)->whereCoin_id($payment->usercoin->coin->id)->first();
                                                            if (!is_object($fourth_pay)) {
                                                                $fourth_pay = UserCoin::create([
                                                                            'user_id' => $user_ref_fourth->user_id,
                                                                            'coin_id' => $payment->usercoin->coin->id,
                                                                            'address' => null
                                                                ]);
                                                            }
                                                            $userSignalSub = UserEducationLicensePlan::whereUser_id($user_ref_fourth->user_id)->where('due_pay', '>', Carbon::now())->first();
                                                            if (is_object($fourth_pay) && is_object($userSignalSub)) {

                                                                //create user withdrawal data
                                                                $user_withdraw_fourth = new UserWithdrawal();
                                                                $user_withdraw_fourth->amount = $newUserReward;
                                                                $user_withdraw_fourth->user_id = $fourth_pay->user_id;
                                                                $user_withdraw_fourth->coin_id = $fourth_pay->id;
                                                                $user_withdraw_fourth->type = "Referral Bonus  Educational License";
                                                                $user_withdraw_fourth->status = true;
                                                                $user_withdraw_fourth->plan_id = $payment->plan_id;
                                                                $user_withdraw_fourth->save();
                                                                $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($fourth_pay->user_id)));
                                                                $userMoney->user_id = $fourth_pay->user_id;
                                                                $userMoney->amount = $userMoney->amount + $newUserReward;
                                                                $userMoney->save();
                                                                //transcation log
                                                                Transaction::create([
                                                                    'user_id' => $fourth_pay->user_id,
                                                                    'transaction_id' => $payment->transaction_id,
                                                                    'type' => 'Commissions',
                                                                    'name_type' => 'Referral Bonus',
                                                                    'coin_id' => $fourth_pay->id,
                                                                    'amount' => $newUserReward,
                                                                    'amount_profit' => $newUserReward,
                                                                    'description' => 'Referral Bonus Under  Educational License' . $payment->plan->name . ' license',
                                                                    'status' => true
                                                                ]);
                                                                $message_fourth = 'USD' . $newUserReward . " Educational License Fourth step Referral Bonus has been successfully sent to you with Transaction ID Is : #$payment->transaction_id";
                                                                $first = $fourth_pay->user->first_name;
                                                                $last = $fourth_pay->user->last_name;
                                                                $greeting = "Hello $first $last";
                                                                Mail::to($fourth_pay->user->email)->send(new MailSender('Referral Bonus  Educational License', $greeting, $message_fourth, '', ''));

                                                                ///five
                                                                $user_ref_five = Reference::whereReferred_id($fourth_pay->user_id)->first();
                                                                if (is_object($user_ref_five)) {
                                                                    $five_pay = UserCoin::whereUser_id($user_ref_five->user_id)->whereCoin_id($payment->usercoin->coin->id)->first();
                                                                    if (!is_object($five_pay)) {
                                                                        $five_pay = UserCoin::create([
                                                                                    'user_id' => $user_ref_five->user_id,
                                                                                    'coin_id' => $payment->usercoin->coin->id,
                                                                                    'address' => null
                                                                        ]);
                                                                    }
                                                                    $userSignalSub = UserEducationLicensePlan::whereUser_id($user_ref_five->user_id)->where('due_pay', '>', Carbon::now())->first();
                                                                    if (is_object($five_pay) && is_object($userSignalSub)) {

                                                                        //create user withdrawal data
                                                                        $user_withdraw_five = new UserWithdrawal();
                                                                        $user_withdraw_five->amount = $newUserReward;
                                                                        $user_withdraw_five->user_id = $five_pay->user_id;
                                                                        $user_withdraw_five->coin_id = $five_pay->id;
                                                                        $user_withdraw_five->type = "Referral Bonus  Educational License";
                                                                        $user_withdraw_five->status = true;
                                                                        $user_withdraw_five->plan_id = $payment->plan_id;
                                                                        $user_withdraw_five->save();
                                                                        $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($five_pay->user_id)));
                                                                        $userMoney->user_id = $five_pay->user_id;
                                                                        $userMoney->amount = $userMoney->amount + $newUserReward;
                                                                        $userMoney->save();
                                                                        //transcation log
                                                                        Transaction::create([
                                                                            'user_id' => $five_pay->user_id,
                                                                            'transaction_id' => $payment->transaction_id,
                                                                            'type' => 'Commissions',
                                                                            'name_type' => 'Referral Bonus',
                                                                            'coin_id' => $five_pay->id,
                                                                            'amount' => $newUserReward,
                                                                            'amount_profit' => $newUserReward,
                                                                            'description' => 'Referral Bonus Under  Educational License' . $payment->plan->name . ' license',
                                                                            'status' => true
                                                                        ]);
                                                                        $message_five = 'USD' . $newUserReward . " Educational License Fiveth step Referral Bonus has been successfully sent to you with Transaction ID Is : #$payment->transaction_id";
                                                                        $first = $five_pay->user->first_name;
                                                                        $last = $five_pay->user->last_name;
                                                                        $greeting = "Hello $first $last";
                                                                        Mail::to($five_pay->user->email)->send(new MailSender('Referral Bonus  Educational License', $greeting, $message_five, '', ''));

                                                                        ///six
                                                                        $user_ref_six = Reference::whereReferred_id($five_pay->user_id)->first();
                                                                        if (is_object($user_ref_six)) {
                                                                            $six_pay = UserCoin::whereUser_id($user_ref_six->user_id)->whereCoin_id($payment->usercoin->coin->id)->first();
                                                                            if (!is_object($six_pay)) {
                                                                                $six_pay = UserCoin::create([
                                                                                            'user_id' => $user_ref_six->user_id,
                                                                                            'coin_id' => $payment->usercoin->coin->id,
                                                                                            'address' => null
                                                                                ]);
                                                                            }
                                                                            $userSignalSub = UserEducationLicensePlan::whereUser_id($user_ref_six->user_id)->where('due_pay', '>', Carbon::now())->first();
                                                                            if (is_object($six_pay) && is_object($userSignalSub)) {

                                                                                //create user withdrawal data
                                                                                $user_withdraw_six = new UserWithdrawal();
                                                                                $user_withdraw_six->amount = $newUserReward;
                                                                                $user_withdraw_six->user_id = $six_pay->user_id;
                                                                                $user_withdraw_six->coin_id = $six_pay->id;
                                                                                $user_withdraw_six->type = "Referral Bonus  Educational License";
                                                                                $user_withdraw_six->status = true;
                                                                                $user_withdraw_six->plan_id = $payment->plan_id;
                                                                                $user_withdraw_six->save();
                                                                                $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($six_pay->user_id)));
                                                                                $userMoney->user_id = $six_pay->user_id;
                                                                                $userMoney->amount = $userMoney->amount + $newUserReward;
                                                                                $userMoney->save();
                                                                                //transcation log
                                                                                Transaction::create([
                                                                                    'user_id' => $six_pay->user_id,
                                                                                    'transaction_id' => $payment->transaction_id,
                                                                                    'type' => 'Commissions',
                                                                                    'name_type' => 'Referral Bonus',
                                                                                    'coin_id' => $six_pay->id,
                                                                                    'amount' => $newUserReward,
                                                                                    'amount_profit' => $newUserReward,
                                                                                    'description' => 'Referral Bonus Under  Educational License' . $payment->plan->name . ' license',
                                                                                    'status' => true
                                                                                ]);
                                                                                $message_six = 'USD' . $newUserReward . " Educational License Six step Referral Bonus has been successfully sent to you with Transaction ID Is : #$payment->transaction_id";
                                                                                $first = $six_pay->user->first_name;
                                                                                $last = $six_pay->user->last_name;
                                                                                $greeting = "Hello $first $last";
                                                                                Mail::to($six_pay->user->email)->send(new MailSender('Referral Bonus  Educational License', $greeting, $message_six, '', ''));

                                                                                ///seven
                                                                                $user_ref_seven = Reference::whereReferred_id($six_pay->user_id)->first();
                                                                                if (is_object($user_ref_seven)) {
                                                                                    $seven_pay = UserCoin::whereUser_id($user_ref_seven->user_id)->whereCoin_id($payment->usercoin->coin->id)->first();
                                                                                    if (!is_object($seven_pay)) {
                                                                                        $seven_pay = UserCoin::create([
                                                                                                    'user_id' => $user_ref_seven->user_id,
                                                                                                    'coin_id' => $payment->usercoin->coin->id,
                                                                                                    'address' => null
                                                                                        ]);
                                                                                    }
                                                                                    $userSignalSub = UserEducationLicensePlan::whereUser_id($user_ref_seven->user_id)->where('due_pay', '>', Carbon::now())->first();
                                                                                    if (is_object($seven_pay) && is_object($userSignalSub)) {

                                                                                        //create user withdrawal data
                                                                                        $user_withdraw_seven = new UserWithdrawal();
                                                                                        $user_withdraw_seven->amount = $newUserReward;
                                                                                        $user_withdraw_seven->user_id = $seven_pay->user_id;
                                                                                        $user_withdraw_seven->coin_id = $seven_pay->id;
                                                                                        $user_withdraw_seven->type = "Referral Bonus  Educational License";
                                                                                        $user_withdraw_seven->status = true;
                                                                                        $user_withdraw_seven->plan_id = $payment->plan_id;
                                                                                        $user_withdraw_seven->save();
                                                                                        $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($seven_pay->user_id)));
                                                                                        $userMoney->user_id = $seven_pay->user_id;
                                                                                        $userMoney->amount = $userMoney->amount + $newUserReward;
                                                                                        $userMoney->save();
                                                                                        //transcation log
                                                                                        Transaction::create([
                                                                                            'user_id' => $seven_pay->user_id,
                                                                                            'transaction_id' => $payment->transaction_id,
                                                                                            'type' => 'Commissions',
                                                                                            'name_type' => 'Referral Bonus',
                                                                                            'coin_id' => $seven_pay->id,
                                                                                            'amount' => $newUserReward,
                                                                                            'amount_profit' => $newUserReward,
                                                                                            'description' => 'Referral Bonus Under  Educational License' . $payment->plan->name . ' license',
                                                                                            'status' => true
                                                                                        ]);
                                                                                        $message_seven = 'USD' . $newUserReward . " Educational License Seven step Referral Bonus has been successfully sent to you with Transaction ID Is : #$payment->transaction_id";
                                                                                        $first = $seven_pay->user->first_name;
                                                                                        $last = $seven_pay->user->last_name;
                                                                                        $greeting = "Hello $first $last";
                                                                                        Mail::to($seven_pay->user->email)->send(new MailSender('Referral Bonus  Educational License', $greeting, $message_seven, '', ''));

                                                                                        ///eight
                                                                                        $user_ref_eight = Reference::whereReferred_id($seven_pay->user_id)->first();
                                                                                        if (is_object($user_ref_eight)) {
                                                                                            $eight_pay = UserCoin::whereUser_id($user_ref_eight->user_id)->whereCoin_id($payment->usercoin->coin->id)->first();
                                                                                            if (!is_object($eight_pay)) {
                                                                                                $eight_pay = UserCoin::create([
                                                                                                            'user_id' => $user_ref_eight->user_id,
                                                                                                            'coin_id' => $payment->usercoin->coin->id,
                                                                                                            'address' => null
                                                                                                ]);
                                                                                            }
                                                                                            $userSignalSub = UserEducationLicensePlan::whereUser_id($user_ref_eight->user_id)->where('due_pay', '>', Carbon::now())->first();
                                                                                            if (is_object($eight_pay) && is_object($userSignalSub)) {

                                                                                                //create user withdrawal data
                                                                                                $user_withdraw_eight = new UserWithdrawal();
                                                                                                $user_withdraw_eight->amount = $newUserReward;
                                                                                                $user_withdraw_eight->user_id = $eight_pay->user_id;
                                                                                                $user_withdraw_eight->coin_id = $eight_pay->id;
                                                                                                $user_withdraw_eight->type = "Referral Bonus  Educational License";
                                                                                                $user_withdraw_eight->status = true;
                                                                                                $user_withdraw_eight->plan_id = $payment->plan_id;
                                                                                                $user_withdraw_eight->save();
                                                                                                $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($eight_pay->user_id)));
                                                                                                $userMoney->user_id = $eight_pay->user_id;
                                                                                                $userMoney->amount = $userMoney->amount + $newUserReward;
                                                                                                $userMoney->save();
                                                                                                //transcation log
                                                                                                Transaction::create([
                                                                                                    'user_id' => $eight_pay->user_id,
                                                                                                    'transaction_id' => $payment->transaction_id,
                                                                                                    'type' => 'Commissions',
                                                                                                    'name_type' => 'Referral Bonus',
                                                                                                    'coin_id' => $eight_pay->id,
                                                                                                    'amount' => $newUserReward,
                                                                                                    'amount_profit' => $newUserReward,
                                                                                                    'description' => 'Referral Bonus Under  Educational License' . $payment->plan->name . ' license',
                                                                                                    'status' => true
                                                                                                ]);
                                                                                                $message_eight = 'USD' . $newUserReward . " Educational License Eight step Referral Bonus has been successfully sent to you with Transaction ID Is : #$payment->transaction_id";
                                                                                                $first = $eight_pay->user->first_name;
                                                                                                $last = $eight_pay->user->last_name;
                                                                                                $greeting = "Hello $first $last";
                                                                                                Mail::to($eight_pay->user->email)->send(new MailSender('Referral Bonus  Educational License', $greeting, $message_eight, '', ''));
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


                                $email = $payment->user->email;
                                $name = $payment->user->first_name . ' ' . $payment->user->last_name;
                                $greeting = "Hello $name";
                                $url = "https://sochain.com/tx/BTC/" . $data->txid;
                                $message = $payment->plan->name . " Education license  deposit has been confirmed";
                                $link = $url;
                                $link_name = " View on Blockchain";
                                Mail::to($email)->send(new MailSender('Education Plan License payment Confirmation', $greeting, $message, $link, $link_name));
                            }
                        }
                    }
                }

                if ($action == 'ethereum_address') {
                    $name = $payment->user->first_name . ' ' . $payment->user->last_name;
                    $greeting = "Hello admin $name deposited education license with Eth";
                    $text = "Eth is not supported fro  automation please kindly confirm this payment from admin under education license plan management";
                    //send admin email
                    Mail::to($setting->send_notify_email)->send(new MailSender('Eth deposit on education license confirmation required', $greeting, $text, '', ''));
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
