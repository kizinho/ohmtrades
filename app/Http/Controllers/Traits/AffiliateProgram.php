<?php

namespace App\Http\Controllers\Traits;

use App\Models\userTrackEarn;
use App\Models\Transaction;
use App\Models\Reference;
use App\Mail\MailSender;
use App\Models\Investment;
use Illuminate\Support\Facades\Mail;
use App\Models\Admin\Setting;
use App\Models\AviodTwicePayment;
use App\Models\RecordPayment;

trait AffiliateProgram {

    public function runAffiliate($payment, $type) {
        $setting = Setting::whereId(1)->first();
        $allPoint = 0.5;
        $user_ref = Reference::whereReferred_id($payment->user_id)->first();
        $reward = $payment->amount;
        $firstUserReward = 8 / 100 * $reward;
        $secondUserReward = 6 / 100 * $reward;
        $thirdUserReward = 2 / 100 * $reward;
        $fourthUserReward = 3 / 100 * $reward;
        $firthUserReward = 4 / 100 * $reward;
        $allUserReward = $setting->level_all / 100 * $reward;
        $allUserRewardPoints = $allPoint / 100 * $reward;
        if (is_object($user_ref)) {
            $user_ref_invest = Investment::whereUser_id($user_ref->user_id)->whereStatus_deposit(true)->whereStatus(false)->first();
            $checkAvoidPayTwice = AviodTwicePayment::whereType('invest')->whereReciever_id($user_ref->user_id)->wherePayer_id($payment->user_id)->first();
            //avoid twice
            if (is_object($user_ref_invest) && !is_object($checkAvoidPayTwice)) {

                //first reward
                $newFirstUserReward = $firstUserReward;
                $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($user_ref->user_id)));
                $userMoney->user_id = $user_ref->user_id;
                $userMoney->amount = $userMoney->amount + $newFirstUserReward;
                $userMoney->save();
                //track avoid payment
                $avoidTwice = new AviodTwicePayment();
                $avoidTwice->reciever_id = $user_ref->user_id;
                $avoidTwice->type = 'invest';
                $avoidTwice->payer_id = $payment->user_id;
                $avoidTwice->level = 1;
                $avoidTwice->save();
                //transcation log
                Transaction::create([
                    'user_id' => $user_ref->user_id,
                    'transaction_id' => $payment->transaction_id,
                    'type' => 'Commissions',
                    'name_type' => 'Referral Bonus',
                    'amount' => $newFirstUserReward,
                    'amount_profit' => $newFirstUserReward,
                    'description' => 'Referral Bonus Under ' . $payment->plan->name,
                    'status' => true
                ]);
                $message = 'USD' . $newFirstUserReward . " Referral Bonus has been successfully sent to wallet";
                $first = $user_ref->user->email;
                $last = $user_ref->user->username;
                $greeting = "Hello $first $last";
                Mail::to($user_ref->user->email)->send(new MailSender('Referral Bonus Payment', $greeting, $message, '', ''));
            } //second reward
            $user_ref_second = Reference::whereReferred_id($user_ref->user_id)->first();

            if (is_object($user_ref_second)) {
                $user_ref_invest_second = Investment::whereUser_id($user_ref_second->user_id)->whereStatus_deposit(true)->whereStatus(false)->first();
                $user_count_direct_invest_second = Reference::whereUser_id($user_ref->user_id)->pluck('referred_id');
                $user_count_direct_second_fetch = Investment::whereIn('user_id', $user_count_direct_invest_second)->whereStatus_deposit(true)->whereStatus(false)->get();
                $user_count_direct_second_unique = $user_count_direct_second_fetch->unique('user_id');
                $user_count_direct_second = count($user_count_direct_second_unique);
                $checkAvoidPayTwiceSecond = AviodTwicePayment::whereType('invest')->whereReciever_id($user_ref_second->user_id)->whereLevel(2)->first();
                //avoid twice
                if (is_object($user_ref_invest_second) && !is_object($checkAvoidPayTwiceSecond)) {

                    $newSecondUserReward = $secondUserReward;
                    //record payment
                    if ($user_count_direct_second <= 4) {
                        $secondRecordPayment = new RecordPayment();
                        $secondRecordPayment->user_id = $user_ref_second->user_id;
                        $secondRecordPayment->payer_id = $payment->user_id;
                        $secondRecordPayment->plan_id = $payment->plan->id;
                        $secondRecordPayment->amount = $newSecondUserReward;
                        $secondRecordPayment->type = "invest";
                        $secondRecordPayment->level = 2;
                        $secondRecordPayment->transaction_id = $payment->transaction_id;
                        $secondRecordPayment->save();
                    }
                    //release record payment
                    if ($user_count_direct_second >= 4 && $user_count_direct_second <= 4) {
                        $userRecordSecond = RecordPayment::whereUser_id($user_ref_second->user_id)->whereLevel(2)->whereStatus(false)->whereType('invest')->get();
                        foreach ($userRecordSecond as $recordSecond) {
                            $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($recordSecond->user_id)));
                            $userMoney->user_id = $recordSecond->user_id;
                            $userMoney->amount = $userMoney->amount + $recordSecond->amount;
                            $userMoney->save();
                            //track avoid payment
                            $avoidTwiceSecond = new AviodTwicePayment();
                            $avoidTwiceSecond->reciever_id = $recordSecond->user_id;
                            $avoidTwiceSecond->type = 'invest';
                            $avoidTwiceSecond->level = 2;
                            $avoidTwiceSecond->save();
                            //transcation log
                            Transaction::create([
                                'user_id' => $recordSecond->user_id,
                                'transaction_id' => $recordSecond->transaction_id,
                                'type' => 'Commissions',
                                'name_type' => 'Referral Bonus',
                                'amount' => $recordSecond->amount,
                                'amount_profit' => $recordSecond->amount,
                                'description' => 'Referral Bonus Under ' . $recordSecond->plan->name,
                                'status' => true
                            ]);
                            $message_second = 'USD' . $recordSecond->amount . " Referral Bonus has been successfully sent to wallet";
                            $first = $recordSecond->user->first_name;
                            $last = $recordSecond->user->last_name;
                            $greeting = "Hello $first $last";
                            Mail::to($recordSecond->user->email)->send(new MailSender('Referral Bonus', $greeting, $message_second, '', ''));
                            $recordSecond->update([
                                'status' => true
                            ]);
                        }
                    }
                }

//                                //third reward
                $user_ref_third = Reference::whereReferred_id($user_ref_second->user_id)->first();

                if (is_object($user_ref_third)) {

                    $user_ref_invest_third = Investment::whereUser_id($user_ref_third->user_id)->whereStatus_deposit(true)->whereStatus(false)->first();
                    $user_count_direct_invest_third = Reference::whereUser_id($user_ref->user_id)->pluck('referred_id');

                    $user_count_direct_third_fetch = Investment::whereIn('user_id', $user_count_direct_invest_third)->whereStatus_deposit(true)->whereStatus(false)->get();
                    $user_count_direct_third_unique = $user_count_direct_third_fetch->unique('user_id');
                    $user_count_direct_third = count($user_count_direct_third_unique);

                    $checkAvoidPayTwiceThird = AviodTwicePayment::whereType('invest')->whereReciever_id($user_ref_third->user_id)->whereLevel(3)->first();

                    //avoid twice
                    if (is_object($user_ref_third) && is_object($user_ref_invest_third) && !is_object($checkAvoidPayTwiceThird)) {
                        $newThirdUserReward = $thirdUserReward;
                        //record payment
                        if ($user_count_direct_third <= 3) {
                            $thirdRecordPayment = new RecordPayment();
                            $thirdRecordPayment->user_id = $user_ref_third->user_id;
                            $thirdRecordPayment->payer_id = $payment->user_id;
                            $thirdRecordPayment->amount = $newThirdUserReward;
                            $thirdRecordPayment->plan_id = $payment->plan->id;
                            $thirdRecordPayment->type = "invest";
                            $thirdRecordPayment->level = 3;
                            $thirdRecordPayment->transaction_id = $payment->transaction_id;
                            $thirdRecordPayment->save();
                        }
                        //release record payment
                        if ($user_count_direct_third >= 3 && $user_count_direct_third <= 3) {
                            $userRecordThird = RecordPayment::whereUser_id($user_ref_third->user_id)->whereLevel(3)->whereStatus(false)->whereType('invest')->get();
                            foreach ($userRecordThird as $recordThird) {
                                $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($recordThird->user_id)));
                                $userMoney->user_id = $recordThird->user_id;
                                $userMoney->amount = $userMoney->amount + $recordThird->amount;
                                $userMoney->save();
                                //track avoid payment
                                $avoidTwiceThird = new AviodTwicePayment();
                                $avoidTwiceThird->reciever_id = $recordThird->user_id;
                                $avoidTwiceThird->type = 'invest';
                                $avoidTwiceThird->level = 3;
                                $avoidTwiceThird->save();
                                //transcation log
                                Transaction::create([
                                    'user_id' => $recordThird->user_id,
                                    'transaction_id' => $recordThird->transaction_id,
                                    'type' => 'Commissions',
                                    'name_type' => 'Referral Bonus',
                                    'amount' => $recordThird->amount,
                                    'amount_profit' => $recordThird->amount,
                                    'description' => 'Referral Bonus Under ' . $recordThird->plan->name,
                                    'status' => true
                                ]);
                                $message_third = 'USD' . $recordThird->amount . " Referral Bonus has been successfully sent to wallet";
                                $first = $recordThird->user->first_name;
                                $last = $recordThird->user->last_name;
                                $greeting = "Hello $first $last";
                                Mail::to($recordThird->user->email)->send(new MailSender('Referral Bonus', $greeting, $message_third, '', ''));
                                $recordThird->update([
                                    'status' => true
                                ]);
                            }
                        }
                    }

                    //                                //fourth reward
                    $user_ref_fourth = Reference::whereReferred_id($user_ref_third->user_id)->first();

                    if (is_object($user_ref_fourth)) {
                        $user_ref_invest_fourth = Investment::whereUser_id($user_ref_fourth->user_id)->whereStatus_deposit(true)->whereStatus(false)->first();
                        $user_count_direct_invest_fourth = Reference::whereUser_id($user_ref->user_id)->pluck('referred_id');
                        $user_count_direct_fourth_fetch = Investment::whereIn('user_id', $user_count_direct_invest_fourth)->whereStatus_deposit(true)->whereStatus(false)->get();
                        $user_count_direct_fourth_unique = $user_count_direct_fourth_fetch->unique('user_id');
                        $user_count_direct_fourth = count($user_count_direct_fourth_unique);
                        $checkAvoidPayTwiceFourth = AviodTwicePayment::whereType('invest')->whereReciever_id($user_ref_fourth->user_id)->whereLevel(4)->first();
                        //avoid twice
                        if (is_object($user_ref_invest_fourth) && !is_object($checkAvoidPayTwiceFourth)) {
                            //record payment
                            if ($user_count_direct_fourth <= 2) {
                                $fourthRecordPayment = new RecordPayment();
                                $fourthRecordPayment->user_id = $user_ref_fourth->user_id;
                                $fourthRecordPayment->payer_id = $payment->user_id;
                                $fourthRecordPayment->plan_id = $payment->plan->id;
                                $fourthRecordPayment->amount = $fourthUserReward;
                                $fourthRecordPayment->type = "invest";
                                $fourthRecordPayment->level = 4;
                                $fourthRecordPayment->transaction_id = $payment->transaction_id;
                                $fourthRecordPayment->save();
                            }
                            //release record payment
                            if ($user_count_direct_fourth >= 2 && $user_count_direct_fourth <= 2) {
                                $userRecordFourth = RecordPayment::whereUser_id($user_ref_fourth->user_id)->whereLevel(4)->whereStatus(false)->whereType('invest')->get();
                                foreach ($userRecordFourth as $recordFourth) {
                                    $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($recordFourth->user_id)));
                                    $userMoney->user_id = $recordFourth->user_id;
                                    $userMoney->amount = $userMoney->amount + $recordFourth->amount;
                                    $userMoney->save();
                                    //track avoid payment
                                    $avoidTwiceFourth = new AviodTwicePayment();
                                    $avoidTwiceFourth->reciever_id = $recordFourth->user_id;
                                    $avoidTwiceFourth->type = 'invest';
                                    $avoidTwiceFourth->level = 4;
                                    $avoidTwiceFourth->save();
                                    //transcation log
                                    Transaction::create([
                                        'user_id' => $recordFourth->user_id,
                                        'transaction_id' => $recordFourth->transaction_id,
                                        'type' => 'Commissions',
                                        'name_type' => 'Referral Bonus',
                                        'amount' => $recordFourth->amount,
                                        'amount_profit' => $recordFourth->amount,
                                        'description' => 'Referral Bonus Under ' . $recordFourth->plan->name,
                                        'status' => true
                                    ]);
                                    $message_Fourth = 'USD' . $recordFourth->amount . " Referral Bonus has been successfully sent to wallet";
                                    $first = $recordFourth->user->first_name;
                                    $last = $recordFourth->user->last_name;
                                    $greeting = "Hello $first $last";
                                    Mail::to($recordFourth->user->email)->send(new MailSender('Referral Bonus', $greeting, $message_Fourth, '', ''));
                                    $recordFourth->update([
                                        'status' => true
                                    ]);
                                }
                            }
                        }
                        //                                //firth reward
                        $user_ref_firth = Reference::whereReferred_id($user_ref_fourth->user_id)->first();

                        if (is_object($user_ref_firth)) {
                            $user_ref_invest_firth = Investment::whereUser_id($user_ref_firth->user_id)->whereStatus_deposit(true)->whereStatus(false)->first();
                            $user_count_direct_invest_firth = Reference::whereUser_id($user_ref->user_id)->pluck('referred_id');
                            $user_count_direct_firth_fetch = Investment::whereIn('user_id', $user_count_direct_invest_firth)->whereStatus_deposit(true)->whereStatus(false)->get();
                            $user_count_direct_firth_unique = $user_count_direct_firth_fetch->unique('user_id');
                            $user_count_direct_firth = count($user_count_direct_firth_unique);
                            $checkAvoidPayTwiceFirth = AviodTwicePayment::whereType('invest')->whereReciever_id($user_ref_firth->user_id)->whereLevel(5)->first();
                            //avoid twice
                            if (is_object($user_ref_invest_firth) && !is_object($checkAvoidPayTwiceFirth)) {
                                //record payment
                                if ($user_count_direct_firth <= 3) {
                                    $firthRecordPayment = new RecordPayment();
                                    $firthRecordPayment->user_id = $user_ref_firth->user_id;
                                    $firthRecordPayment->payer_id = $payment->user_id;
                                    $firthRecordPayment->plan_id = $payment->plan->id;
                                    $firthRecordPayment->amount = $firthUserReward;
                                    $firthRecordPayment->type = "invest";
                                    $firthRecordPayment->level = 5;
                                    $firthRecordPayment->transaction_id = $payment->transaction_id;
                                    $firthRecordPayment->save();
                                }
                                //release record payment
                                if ($user_count_direct_firth >= 3 && $user_count_direct_firth <= 3) {
                                    $userRecordFirth = RecordPayment::whereUser_id($user_ref_firth->user_id)->whereLevel(5)->whereStatus(false)->whereType('invest')->get();
                                    foreach ($userRecordFirth as $recordFirth) {
                                        $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($recordFirth->user_id)));
                                        $userMoney->user_id = $recordFirth->user_id;
                                        $userMoney->amount = $userMoney->amount + $recordFirth->amount;
                                        $userMoney->save();
                                        //track avoid payment
                                        $avoidTwiceFirth = new AviodTwicePayment();
                                        $avoidTwiceFirth->reciever_id = $recordFirth->user_id;
                                        $avoidTwiceFirth->type = 'invest';
                                        $avoidTwiceFirth->level = 5;
                                        $avoidTwiceFirth->save();
                                        //transcation log
                                        Transaction::create([
                                            'user_id' => $recordFirth->user_id,
                                            'transaction_id' => $recordFirth->transaction_id,
                                            'type' => 'Commissions',
                                            'name_type' => 'Referral Bonus',
                                            'amount' => $recordFirth->amount,
                                            'amount_profit' => $recordFirth->amount,
                                            'description' => 'Referral Bonus Under ' . $recordFirth->plan->name,
                                            'status' => true
                                        ]);
                                        $message_Firth = 'USD' . $recordFirth->amount . " Referral Bonus has been successfully sent to wallet";
                                        $first = $recordFirth->user->first_name;
                                        $last = $recordFirth->user->last_name;
                                        $greeting = "Hello $first $last";
                                        Mail::to($recordFirth->user->email)->send(new MailSender('Referral Bonus', $greeting, $message_Firth, '', ''));
                                        $recordFirth->update([
                                            'status' => true
                                        ]);
                                    }
                                }
                            }
                            //                                //six reward
                            $user_ref_six = Reference::whereReferred_id($user_ref_firth->user_id)->first();
                            if (is_object($user_ref_six)) {
                                $user_ref_invest_six = Investment::whereUser_id($user_ref_six->user_id)->whereStatus_deposit(true)->whereStatus(false)->first();
                                $checkAvoidPayTwiceSix = AviodTwicePayment::whereType('invest')->whereReciever_id($user_ref_six->user_id)->whereLevel(6)->first();
                                //avoid twice
                                if (is_object($user_ref_invest_six) && !is_object($checkAvoidPayTwiceSix)) {
                                    $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($user_ref_six->user_id)));
                                    $userMoney->user_id = $user_ref_six->user_id;
                                    $userMoney->amount = $userMoney->amount + $allUserReward;
                                    $userMoney->save();
                                    //track avoid payment
                                    $avoidTwiceSix = new AviodTwicePayment();
                                    $avoidTwiceSix->reciever_id = $user_ref_six->user_id;
                                    $avoidTwiceSix->type = 'invest';
                                    $avoidTwiceSix->level = 6;
                                    $avoidTwiceSix->save();
                                    //transcation log
                                    Transaction::create([
                                        'user_id' => $user_ref_six->user_id,
                                        'transaction_id' => $payment->transaction_id,
                                        'type' => 'Commissions',
                                        'name_type' => 'Referral Bonus',
                                        'amount' => $allUserReward,
                                        'amount_profit' => $allUserReward,
                                        'description' => 'Referral Bonus Under ' . $payment->plan->name,
                                        'status' => true
                                    ]);
                                    $message_six = 'USD' . $allUserReward . " Referral Bonus has been successfully sent to wallet";
                                    $first = $user_ref_six->user->first_name;
                                    $last = $user_ref_six->user->last_name;
                                    $greeting = "Hello $first $last";
                                    Mail::to($user_ref_six->user->email)->send(new MailSender('Referral Bonus', $greeting, $message_six, '', ''));
                                }

                                //                                //seven reward
                                $user_ref_seven = Reference::whereReferred_id($user_ref_six->user_id)->first();

                                if (is_object($user_ref_seven)) {
                                    $user_ref_invest_seven = Investment::whereUser_id($user_ref_seven->user_id)->whereStatus_deposit(true)->whereStatus(false)->first();
                                    $checkAvoidPayTwiceSeven = AviodTwicePayment::whereType('invest')->whereReciever_id($user_ref_seven->user_id)->whereLevel(7)->first();
                                    //avoid twice
                                    if (is_object($user_ref_invest_seven) && !is_object($checkAvoidPayTwiceSeven)) {
                                        $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($user_ref_seven->user_id)));
                                        $userMoney->user_id = $user_ref_seven->user_id;
                                        $userMoney->amount = $userMoney->amount + $allUserReward;
                                        $userMoney->save();
                                        //track avoid payment
                                        $avoidTwiceSeven = new AviodTwicePayment();
                                        $avoidTwiceSeven->reciever_id = $user_ref_seven->user_id;
                                        $avoidTwiceSeven->type = 'invest';
                                        $avoidTwiceSeven->level = 7;
                                        $avoidTwiceSeven->save();
                                        //transcation log
                                        Transaction::create([
                                            'user_id' => $user_ref_seven->user_id,
                                            'transaction_id' => $payment->transaction_id,
                                            'type' => 'Commissions',
                                            'name_type' => 'Referral Bonus',
                                            'amount' => $allUserReward,
                                            'amount_profit' => $allUserReward,
                                            'description' => 'Referral Bonus Under ' . $payment->plan->name,
                                            'status' => true
                                        ]);
                                        $message_seven = 'USD' . $allUserReward . " Referral Bonus has been successfully sent to wallet";
                                        $first = $user_ref_seven->user->first_name;
                                        $last = $user_ref_seven->user->last_name;
                                        $greeting = "Hello $first $last";
                                        Mail::to($user_ref_seven->user->email)->send(new MailSender('Referral Bonus', $greeting, $message_seven, '', ''));
                                    }
                                    //                                //eight reward
                                    $user_ref_eight = Reference::whereReferred_id($user_ref_seven->user_id)->first();

                                    if (is_object($user_ref_eight)) {
                                        $user_ref_invest_eight = Investment::whereUser_id($user_ref_eight->user_id)->whereStatus_deposit(true)->whereStatus(false)->first();
                                        $checkAvoidPayTwiceEight = AviodTwicePayment::whereType('invest')->whereReciever_id($user_ref_eight->user_id)->whereLevel(8)->first();
                                        //avoid twice
                                        if (is_object($user_ref_invest_eight) && !is_object($checkAvoidPayTwiceEight)) {
                                            $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($user_ref_eight->user_id)));
                                            $userMoney->user_id = $user_ref_eight->user_id;
                                            $userMoney->amount = $userMoney->amount + $allUserRewardPoints;
                                            $userMoney->save();
                                            //track avoid payment
                                            $avoidTwiceEight = new AviodTwicePayment();
                                            $avoidTwiceEight->reciever_id = $user_ref_eight->user_id;
                                            $avoidTwiceEight->type = 'invest';
                                            $avoidTwiceEight->level = 8;
                                            $avoidTwiceEight->save();
                                            //transcation log
                                            Transaction::create([
                                                'user_id' => $user_ref_eight->user_id,
                                                'transaction_id' => $payment->transaction_id,
                                                'type' => 'Commissions',
                                                'name_type' => 'Referral Bonus',
                                                'amount' => $allUserRewardPoints,
                                                'amount_profit' => $allUserRewardPoints,
                                                'description' => 'Referral Bonus Under ' . $payment->plan->name,
                                                'status' => true
                                            ]);
                                            $message_eight = 'USD' . $allUserRewardPoints . " Referral Bonus has been successfully sent to wallet";
                                            $first = $user_ref_eight->user->first_name;
                                            $last = $user_ref_eight->user->last_name;
                                            $greeting = "Hello $first $last";
                                            Mail::to($user_ref_eight->user->email)->send(new MailSender('Referral Bonus', $greeting, $message_eight, '', ''));
                                        }
                                        //                                //nine reward
                                        $user_ref_nine = Reference::whereReferred_id($user_ref_eight->user_id)->first();

                                        if (is_object($user_ref_nine)) {
                                            $user_ref_invest_nine = Investment::whereUser_id($user_ref_nine->user_id)->whereStatus_deposit(true)->whereStatus(false)->first();
                                            $checkAvoidPayTwiceNine = AviodTwicePayment::whereType('invest')->whereReciever_id($user_ref_nine->user_id)->whereLevel(9)->first();
                                            //avoid twice
                                            if (is_object($user_ref_invest_nine) && !is_object($checkAvoidPayTwiceNine)) {
                                                $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($user_ref_nine->user_id)));
                                                $userMoney->user_id = $user_ref_nine->user_id;
                                                $userMoney->amount = $userMoney->amount + $allUserRewardPoints;
                                                $userMoney->save();
                                                //track avoid payment
                                                $avoidTwiceNine = new AviodTwicePayment();
                                                $avoidTwiceNine->reciever_id = $user_ref_nine->user_id;
                                                $avoidTwiceNine->type = 'invest';
                                                $avoidTwiceNine->level = 9;
                                                $avoidTwiceNine->save();
                                                //transcation log
                                                Transaction::create([
                                                    'user_id' => $user_ref_nine->user_id,
                                                    'transaction_id' => $payment->transaction_id,
                                                    'type' => 'Commissions',
                                                    'name_type' => 'Referral Bonus',
                                                    'amount' => $allUserRewardPoints,
                                                    'amount_profit' => $allUserRewardPoints,
                                                    'description' => 'Referral Bonus Under ' . $payment->plan->name,
                                                    'status' => true
                                                ]);
                                                $message_nine = 'USD' . $allUserRewardPoints . " Referral Bonus has been successfully sent to wallet";
                                                $first = $user_ref_nine->user->first_name;
                                                $last = $user_ref_nine->user->last_name;
                                                $greeting = "Hello $first $last";
                                                Mail::to($user_ref_nine->user->email)->send(new MailSender('Referral Bonus', $greeting, $message_nine, '', ''));
                                            }   //                                //ten reward
                                            $user_ref_ten = Reference::whereReferred_id($user_ref_nine->user_id)->first();

                                            if (is_object($user_ref_ten)) {
                                                $user_ref_invest_ten = Investment::whereUser_id($user_ref_ten->user_id)->whereStatus_deposit(true)->whereStatus(false)->first();
                                                $checkAvoidPayTwiceTen = AviodTwicePayment::whereType('invest')->whereReciever_id($user_ref_ten->user_id)->whereLevel(10)->first();
                                                //avoid twice
                                                if (is_object($user_ref_invest_ten) && !is_object($checkAvoidPayTwiceTen)) {
                                                    $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($user_ref_ten->user_id)));
                                                    $userMoney->user_id = $user_ref_ten->user_id;
                                                    $userMoney->amount = $userMoney->amount + $allUserReward;
                                                    $userMoney->save();
                                                    //track avoid payment
                                                    $avoidTwiceTen = new AviodTwicePayment();
                                                    $avoidTwiceTen->reciever_id = $user_ref_ten->user_id;
                                                    $avoidTwiceTen->type = 'invest';
                                                    $avoidTwiceTen->level = 10;
                                                    $avoidTwiceTen->save();
                                                    //transcation log
                                                    Transaction::create([
                                                        'user_id' => $user_ref_ten->user_id,
                                                        'transaction_id' => $payment->transaction_id,
                                                        'type' => 'Commissions',
                                                        'name_type' => 'Referral Bonus',
                                                        'amount' => $allUserReward,
                                                        'amount_profit' => $allUserReward,
                                                        'description' => 'Referral Bonus Under ' . $payment->plan->name,
                                                        'status' => true
                                                    ]);
                                                    $message_ten = 'USD' . $allUserReward . " Referral Bonus has been successfully sent to wallet";
                                                    $first = $user_ref_ten->user->first_name;
                                                    $last = $user_ref_ten->user->last_name;
                                                    $greeting = "Hello $first $last";
                                                    Mail::to($user_ref_ten->user->email)->send(new MailSender('Referral Bonus', $greeting, $message_ten, '', ''));
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
