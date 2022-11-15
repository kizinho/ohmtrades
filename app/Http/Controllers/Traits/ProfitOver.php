<?php

namespace App\Http\Controllers\Traits;

use App\Models\userTrackEarn;
use App\Models\Transaction;
use App\Models\Reference;
use App\Mail\MailSender;
use App\Models\Investment;
use Illuminate\Support\Facades\Mail;
use App\Models\RecordPayment;

trait ProfitOver {

    public function runAffiliateProfitOver($payment, $plan, $run, $profit) {
        if ($plan != 3 || $plan != 4) {
            $allPoint = 2.5;
            $allPercent = 5;
            $allEqual = 10;
            $allReward = $allPercent / 100 * $profit;
            $allPercentEqual = $allEqual / 100 * $profit;
            $allUserRewardPoints = $allPoint / 100 * $profit;
            $user_ref = Reference::whereReferred_id($payment->user_id)->first();
            if (is_object($user_ref)) {
                $user_ref_invest = Investment::whereUser_id($user_ref->user_id)->whereStatus_deposit(true)->whereStatus(false)->first();
                $user_count_direct_invest = Reference::whereUser_id($user_ref->user_id)->pluck('user_id');
                $user_count_direct_fetch = Investment::whereIn('user_id', $user_count_direct_invest)->get();
                $user_count_direct_unique = $user_count_direct_fetch->unique('user_id');
                $user_count_direct = count($user_count_direct_unique);
                if (is_object($user_ref_invest) && $run <= 1) {


                    //first reward
                    $newFirstUserReward = $allReward;
                    //record payment
                    if ($user_count_direct <= 5) {
                        $recordPayment = new RecordPayment();
                        $recordPayment->user_id = $user_ref->user_id;
                        $recordPayment->payer_id = $payment->user_id;
                        $recordPayment->plan_id = $payment->plan->id;
                        $recordPayment->amount = $newFirstUserReward;
                        $recordPayment->type = "profit";
                        $recordPayment->level = 1;
                        $recordPayment->transaction_id = $payment->transaction_id;
                        $recordPayment->save();
                    }
                    //release record payment

                    if ($user_count_direct >= 5 && $user_count_direct <= 5) {
                        $userRecord = RecordPayment::whereUser_id($user_ref->user_id)->whereLevel(1)->whereStatus(false)->whereType('profit')->get();
                        foreach ($userRecord as $record) {
                            $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($record->user_id)));
                            $userMoney->user_id = $record->user_id;
                            $userMoney->amount = $userMoney->amount + $record->amount;
                            $userMoney->save();
                            //track avoid payment
                            $avoidTwice = new AviodTwicePayment();
                            $avoidTwice->reciever_id = $record->user_id;
                            $avoidTwice->type = 'profit';
                            $avoidTwice->level = 1;
                            $avoidTwice->save();
                            //transcation log
                            Transaction::create([
                                'user_id' => $record->user_id,
                                'transaction_id' => $record->transaction_id,
                                'type' => 'Commissions',
                                'name_type' => 'Referral Bonus',
                                'amount' => $record->amount,
                                'amount_profit' => $record->amount,
                                'description' => 'Referral Bonus Under ' . $record->plan->name,
                                'status' => true
                            ]);
                            $message = 'USD' . $record->amount . " Referral Bonus has been successfully sent to wallet";
                            $first = $record->user->first_name;
                            $last = $record->user->last_name;
                            $greeting = "Hello $first $last";
                            Mail::to($record->user->email)->send(new MailSender('Referral Bonus', $greeting, $message, '', ''));
                            $record->update([
                                'status' => true
                            ]);
                        }
                    }
                }
                //second reward
                $user_ref_second = Reference::whereReferred_id($user_ref->user_id)->first();
                if (is_object($user_ref_second)) {
                    $user_ref_invest_second = Investment::whereUser_id($user_ref_second->user_id)->whereStatus_deposit(true)->whereStatus(false)->first();
                    $user_count_direct_invest_second = Reference::whereUser_id($user_ref_second->user_id)->pluck('user_id');
                    $user_count_direct_second_fetch = Investment::whereIn('user_id', $user_count_direct_invest_second)->get();
                    $user_count_direct_second_unique = $user_count_direct_second_fetch->unique('user_id');
                    $user_count_direct_second = count($user_count_direct_second_unique);
                    if (is_object($user_ref_invest_second) && $run <= 3) {
                        if ($run == 1) {
                            $newSecondUserReward = $allReward;
                        } elseif ($run == 2 || $run == 3) {

                            $newSecondUserReward = $allUserRewardPoints;
                        }


                        //record payment
                        if ($user_count_direct_second <= 10) {
                            $secondRecordPayment = new RecordPayment();
                            $secondRecordPayment->user_id = $user_ref_second->user_id;
                            $secondRecordPayment->payer_id = $payment->user_id;
                            $secondRecordPayment->plan_id = $payment->plan->id;
                            $secondRecordPayment->amount = $newSecondUserReward;
                            $secondRecordPayment->type = "profit";
                            $secondRecordPayment->level = 2;
                            $secondRecordPayment->transaction_id = $payment->transaction_id;
                            $secondRecordPayment->save();
                        }
                        //release record payment
                        if ($user_count_direct_second >= 10 && $user_count_direct_second <= 10) {
                            $userRecordSecond = RecordPayment::whereUser_id($user_ref_second->user_id)->whereLevel(2)->whereStatus(false)->whereType('profit')->get();
                            $filterSecond = $userRecordSecond->unique('payer_id');
                            foreach ($filterSecond as $recordSecond) {
                                $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($recordSecond->user_id)));
                                $userMoney->user_id = $recordSecond->user_id;
                                $userMoney->amount = $userMoney->amount + $recordSecond->amount;
                                $userMoney->save();
                                //track avoid payment
                                $avoidTwiceSecond = new AviodTwicePayment();
                                $avoidTwiceSecond->reciever_id = $recordSecond->user_id;
                                $avoidTwiceSecond->type = 'profit';
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
                        $user_count_direct_invest_third = Reference::whereUser_id($user_ref_third->user_id)->pluck('user_id');
                        $user_count_direct_third_fetch = Investment::whereIn('user_id', $user_count_direct_invest_third)->get();
                        $user_count_direct_third_unique = $user_count_direct_third_fetch->unique('user_id');
                        $user_count_direct_third = count($user_count_direct_third_unique);
                        $user_ref_invest_third = Investment::whereUser_id($user_ref_third->user_id)->whereStatus_deposit(true)->whereStatus(false)->first();
                        if (is_object($user_ref_invest_third) && $run <= 4) {
                            if ($run == 1) {
                                $newThirdUserReward = $allReward;
                            } elseif ($run == 2 || $run == 3 || $run == 4) {

                                $newThirdUserReward = $allUserRewardPoints;
                            }

                            //record payment
                            if ($user_count_direct_third <= 15) {
                                $thirdRecordPayment = new RecordPayment();
                                $thirdRecordPayment->user_id = $user_ref_third->user_id;
                                $thirdRecordPayment->payer_id = $payment->user_id;
                                $thirdRecordPayment->amount = $newThirdUserReward;
                                $thirdRecordPayment->plan_id = $payment->plan->id;
                                $thirdRecordPayment->type = "profit";
                                $thirdRecordPayment->level = 3;
                                $thirdRecordPayment->transaction_id = $payment->transaction_id;
                                $thirdRecordPayment->save();
                            }
                            //release record payment
                            if ($user_count_direct_third >= 15 && $user_count_direct_third <= 15) {
                                $userRecordThird = RecordPayment::whereUser_id($user_ref_third->user_id)->whereLevel(3)->whereStatus(false)->whereType('profit')->get();
                             $filterThird = $userRecordThird->unique('payer_id');
                                foreach ($filterThird as $recordThird) {
                                    $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($recordThird->user_id)));
                                    $userMoney->user_id = $recordThird->user_id;
                                    $userMoney->amount = $userMoney->amount + $recordThird->amount;
                                    $userMoney->save();
                                    //track avoid payment
                                    $avoidTwiceThird = new AviodTwicePayment();
                                    $avoidTwiceThird->reciever_id = $recordThird->user_id;
                                    $avoidTwiceThird->type = 'profit';
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
                            $user_count_direct_invest_fourth = Reference::whereUser_id($user_ref_fourth->user_id)->pluck('user_id');
                            $user_count_direct_fourth_fetch = Investment::whereIn('user_id', $user_count_direct_invest_fourth)->get();
                            $user_count_direct_fourth_unique = $user_count_direct_fourth_fetch->unique('user_id');
                            $user_count_direct_fourth = count($user_count_direct_fourth_unique);

                            if (is_object($user_ref_invest_fourth) && $run <= 4) {
                                if ($run == 1 || $run == 2) {
                                    $fourthUserReward = $allReward;
                                } elseif ($run == 3 || $run == 4) {

                                    $fourthUserReward = $allUserRewardPoints;
                                }

                                //record payment
                                if ($user_count_direct_fourth <= 20) {
                                    $fourthRecordPayment = new RecordPayment();
                                    $fourthRecordPayment->user_id = $user_ref_fourth->user_id;
                                    $fourthRecordPayment->payer_id = $payment->user_id;
                                    $fourthRecordPayment->plan_id = $payment->plan->id;
                                    $fourthRecordPayment->amount = $fourthUserReward;
                                    $fourthRecordPayment->type = "profit";
                                    $fourthRecordPayment->level = 4;
                                    $fourthRecordPayment->transaction_id = $payment->transaction_id;
                                    $fourthRecordPayment->save();
                                }
                                //release record payment
                                if ($user_count_direct_fourth >= 20 && $user_count_direct_fourth <= 20) {
                                    $userRecordFourth = RecordPayment::whereUser_id($user_ref_fourth->user_id)->whereLevel(4)->whereStatus(false)->whereType('profit')->get();
                                    $filterFourth = $userRecordFourth->unique('payer_id');
                                    foreach ($filterFourth as $recordFourth) {
                                        $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($recordFourth->user_id)));
                                        $userMoney->user_id = $recordFourth->user_id;
                                        $userMoney->amount = $userMoney->amount + $recordFourth->amount;
                                        $userMoney->save();
                                        //track avoid payment
                                        $avoidTwiceFourth = new AviodTwicePayment();
                                        $avoidTwiceFourth->reciever_id = $recordFourth->user_id;
                                        $avoidTwiceFourth->type = 'profit';
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
                                $user_count_direct_invest_firth = Reference::whereUser_id($user_ref_firth->user_id)->pluck('user_id');
                                $user_count_direct_firth_fetch = Investment::whereIn('user_id', $user_count_direct_invest_firth)->get();
                                $user_count_direct_firth_unique = $user_count_direct_firth_fetch->unique('user_id');
                                $user_count_direct_firth = count($user_count_direct_firth_unique);
                                if (is_object($user_ref_invest_firth) && $run <= 4) {
                                    if ($run == 1 || $run == 2 || $run == 3) {
                                        $firthUserReward = $allReward;
                                    } elseif ($run == 4) {

                                        $firthUserReward = $allUserRewardPoints;
                                    }

                                    //record payment
                                    if ($user_count_direct_firth <= 30) {
                                        $firthRecordPayment = new RecordPayment();
                                        $firthRecordPayment->user_id = $user_ref_firth->user_id;
                                        $firthRecordPayment->payer_id = $payment->user_id;
                                        $firthRecordPayment->plan_id = $payment->plan->id;
                                        $firthRecordPayment->amount = $firthUserReward;
                                        $firthRecordPayment->type = "profit";
                                        $firthRecordPayment->level = 5;
                                        $firthRecordPayment->transaction_id = $payment->transaction_id;
                                        $firthRecordPayment->save();
                                    }
                                    //release record payment
                                    if ($user_count_direct_firth >= 30 && $user_count_direct_firth <= 30) {
                                        $userRecordFirth = RecordPayment::whereUser_id($user_ref_firth->user_id)->whereLevel(5)->whereStatus(false)->whereType('profit')->get();
                                        $filterFirth = $userRecordFirth->unique('payer_id');
                                        foreach ($filterFirth as $recordFirth) {
                                            $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($recordFirth->user_id)));
                                            $userMoney->user_id = $recordFirth->user_id;
                                            $userMoney->amount = $userMoney->amount + $recordFirth->amount;
                                            $userMoney->save();
                                            //track avoid payment
                                            $avoidTwiceFirth = new AviodTwicePayment();
                                            $avoidTwiceFirth->reciever_id = $recordFirth->user_id;
                                            $avoidTwiceFirth->type = 'profit';
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
                                    $user_count_direct_invest_six = Reference::whereUser_id($user_ref_six->user_id)->pluck('user_id');
                                    $user_count_direct_six_fetch = Investment::whereIn('user_id', $user_count_direct_invest_six)->get();
                                    $user_count_direct_six_unique = $user_count_direct_six_fetch->unique('user_id');
                                    $user_count_direct_six = count($user_count_direct_six_unique);

                                    if (is_object($user_ref_invest_six) && $run <= 4) {
                                        if ($run == 1) {
                                            $sixUserReward = $allPercentEqual;
                                        } elseif ($run == 2 || $run == 3) {

                                            $sixUserReward = $allReward;
                                        } elseif ($run == 4) {

                                            $sixUserReward = $allUserRewardPoints;
                                        }
                                        //record payment
                                        if ($user_count_direct_six <= 40) {
                                            $sixRecordPayment = new RecordPayment();
                                            $sixRecordPayment->user_id = $user_ref_six->user_id;
                                            $sixRecordPayment->payer_id = $payment->user_id;
                                            $sixRecordPayment->plan_id = $payment->plan->id;
                                            $sixRecordPayment->amount = $sixUserReward;
                                            $sixRecordPayment->type = "profit";
                                            $sixRecordPayment->level = 6;
                                            $sixRecordPayment->transaction_id = $payment->transaction_id;
                                            $sixRecordPayment->save();
                                        }
                                        //release record payment
                                        if ($user_count_direct_six >= 40 && $user_count_direct_six <= 40) {
                                            $userRecordSix = RecordPayment::whereUser_id($user_ref_six->user_id)->whereLevel(6)->whereStatus(false)->whereType('profit')->get();
                                            $filterSix = $userRecordSix->unique('payer_id');
                                            foreach ($filterSix as $recordSix) {
                                                $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($recordSix->user_id)));
                                                $userMoney->user_id = $recordSix->user_id;
                                                $userMoney->amount = $userMoney->amount + $recordSix->amount;
                                                $userMoney->save();
                                                //track avoid payment
                                                $avoidTwiceSix = new AviodTwicePayment();
                                                $avoidTwiceSix->reciever_id = $recordSix->user_id;
                                                $avoidTwiceSix->type = 'profit';
                                                $avoidTwiceSix->level = 6;
                                                $avoidTwiceSix->save();
                                                //transcation log
                                                Transaction::create([
                                                    'user_id' => $recordSix->user_id,
                                                    'transaction_id' => $recordSix->transaction_id,
                                                    'type' => 'Commissions',
                                                    'name_type' => 'Referral Bonus',
                                                    'amount' => $recordSix->amount,
                                                    'amount_profit' => $recordSix->amount,
                                                    'description' => 'Referral Bonus Under ' . $recordSix->plan->name,
                                                    'status' => true
                                                ]);
                                                $message_six = 'USD' . $recordSix->amount . " Referral Bonus has been successfully sent to wallet";
                                                $first = $recordSix->user->first_name;
                                                $last = $recordSix->user->last_name;
                                                $greeting = "Hello $first $last";
                                                Mail::to($recordSix->user->email)->send(new MailSender('Referral Bonus', $greeting, $message_six, '', ''));
                                                $recordSix->update([
                                                    'status' => true
                                                ]);
                                            }
                                        }
                                    }


                                    //                                //seven reward
                                    $user_ref_seven = Reference::whereReferred_id($user_ref_six->user_id)->first();

                                    if (is_object($user_ref_seven)) {
                                        $user_ref_invest_seven = Investment::whereUser_id($user_ref_seven->user_id)->whereStatus_deposit(true)->whereStatus(false)->first();
                                        $user_count_direct_invest_seven = Reference::whereUser_id($user_ref_seven->user_id)->pluck('user_id');
                                        $user_count_direct_seven_fetch = Investment::whereIn('user_id', $user_count_direct_invest_seven)->get();
                                        $user_count_direct_seven_unique = $user_count_direct_seven_fetch->unique('user_id');
                                        $user_count_direct_seven = count($user_count_direct_seven_unique);

                                        if (is_object($user_ref_invest_seven) && $run <= 6) {
                                            if ($run == 1 || $run == 2) {
                                                $sevenUserReward = $allPercentEqual;
                                            } elseif ($run == 3 || $run == 4) {

                                                $sevenUserReward = $allReward;
                                            } elseif ($run == 5 || $run == 6) {

                                                $sevenUserReward = $allUserRewardPoints;
                                            }
                                            //record payment
                                            if ($user_count_direct_seven <= 60) {
                                                $sevenRecordPayment = new RecordPayment();
                                                $sevenRecordPayment->user_id = $user_ref_seven->user_id;
                                                $sevenRecordPayment->payer_id = $payment->user_id;
                                                $sevenRecordPayment->plan_id = $payment->plan->id;
                                                $sevenRecordPayment->amount = $sevenUserReward;
                                                $sevenRecordPayment->type = "profit";
                                                $sevenRecordPayment->level = 7;
                                                $sevenRecordPayment->transaction_id = $payment->transaction_id;
                                                $sevenRecordPayment->save();
                                            }
                                            //release record payment
                                            if ($user_count_direct_seven >= 60 && $user_count_direct_seven <= 60) {
                                                $userRecordSeven = RecordPayment::whereUser_id($user_ref_seven->user_id)->whereLevel(7)->whereStatus(false)->whereType('profit')->get();
                                                 $filterSeven= $userRecordSeven->unique('payer_id');
                                                foreach ($filterSeven as $recordSeven) {
                                                    $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($recordSeven->user_id)));
                                                    $userMoney->user_id = $recordSeven->user_id;
                                                    $userMoney->amount = $userMoney->amount + $recordSeven->amount;
                                                    $userMoney->save();
                                                    //track avoid payment
                                                    $avoidTwiceSeven = new AviodTwicePayment();
                                                    $avoidTwiceSeven->reciever_id = $recordSeven->user_id;
                                                    $avoidTwiceSeven->type = 'profit';
                                                    $avoidTwiceSeven->level = 7;
                                                    $avoidTwiceSeven->save();
                                                    //transcation log
                                                    Transaction::create([
                                                        'user_id' => $recordSeven->user_id,
                                                        'transaction_id' => $recordSeven->transaction_id,
                                                        'type' => 'Commissions',
                                                        'name_type' => 'Referral Bonus',
                                                        'amount' => $recordSeven->amount,
                                                        'amount_profit' => $recordSeven->amount,
                                                        'description' => 'Referral Bonus Under ' . $recordSeven->plan->name,
                                                        'status' => true
                                                    ]);
                                                    $message_seven = 'USD' . $recordSeven->amount . " Referral Bonus has been successfully sent to wallet";
                                                    $first = $recordSeven->user->first_name;
                                                    $last = $recordSeven->user->last_name;
                                                    $greeting = "Hello $first $last";
                                                    Mail::to($recordSeven->user->email)->send(new MailSender('Referral Bonus', $greeting, $message_seven, '', ''));
                                                    $recordSeven->update([
                                                        'status' => true
                                                    ]);
                                                }
                                            }
                                        }
                                        //                                //eight reward
                                        $user_ref_eight = Reference::whereReferred_id($user_ref_seven->user_id)->first();

                                        if (is_object($user_ref_eight)) {
                                            $user_ref_invest_eight = Investment::whereUser_id($user_ref_eight->user_id)->whereStatus_deposit(true)->whereStatus(false)->first();
                                            $user_count_direct_invest_eight = Reference::whereUser_id($user_ref_eight->user_id)->pluck('user_id');
                                            $user_count_direct_eight_fetch = Investment::whereIn('user_id', $user_count_direct_invest_eight)->get();
                                            $user_count_direct_eight_unique = $user_count_direct_eight_fetch->unique('user_id');
                                            $user_count_direct_eight = count($user_count_direct_eight_unique);

                                            if (is_object($user_ref_invest_eight) && $run <= 6) {
                                                if ($run == 1 || $run == 2 || $run == 3) {
                                                    $eightUserReward = $allPercentEqual;
                                                } elseif ($run == 4 || $run == 5 || $run == 6) {

                                                    $eightUserReward = $allReward;
                                                }

                                                //record payment
                                                if ($user_count_direct_eight <= 80) {
                                                    $eightRecordPayment = new RecordPayment();
                                                    $eightRecordPayment->user_id = $user_ref_eight->user_id;
                                                    $eightRecordPayment->payer_id = $payment->user_id;
                                                    $eightRecordPayment->plan_id = $payment->plan->id;
                                                    $eightRecordPayment->amount = $eightUserReward;
                                                    $eightRecordPayment->type = "profit";
                                                    $eightRecordPayment->level = 8;
                                                    $eightRecordPayment->transaction_id = $payment->transaction_id;
                                                    $eightRecordPayment->save();
                                                }
                                                //release record payment
                                                if ($user_count_direct_eight >= 80 && $user_count_direct_eight <= 80) {
                                                    $userRecordEight = RecordPayment::whereUser_id($user_ref_eight->user_id)->whereLevel(8)->whereStatus(false)->whereType('profit')->get();
                                                     $filterEight = $userRecordEight->unique('payer_id');
                                                    foreach ($filterEight as $recordEight) {
                                                        $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($recordEight->user_id)));
                                                        $userMoney->user_id = $recordEight->user_id;
                                                        $userMoney->amount = $userMoney->amount + $recordEight->amount;
                                                        $userMoney->save();
                                                        //track avoid payment
                                                        $avoidTwiceEight = new AviodTwicePayment();
                                                        $avoidTwiceEight->reciever_id = $recordEight->user_id;
                                                        $avoidTwiceEight->type = 'profit';
                                                        $avoidTwiceEight->level = 8;
                                                        $avoidTwiceEight->save();
                                                        //transcation log
                                                        Transaction::create([
                                                            'user_id' => $recordEight->user_id,
                                                            'transaction_id' => $recordEight->transaction_id,
                                                            'type' => 'Commissions',
                                                            'name_type' => 'Referral Bonus',
                                                            'amount' => $recordEight->amount,
                                                            'amount_profit' => $recordEight->amount,
                                                            'description' => 'Referral Bonus Under ' . $recordEight->plan->name,
                                                            'status' => true
                                                        ]);
                                                        $message_eight = 'USD' . $recordEight->amount . " Referral Bonus has been successfully sent to wallet";
                                                        $first = $recordEight->user->first_name;
                                                        $last = $recordEight->user->last_name;
                                                        $greeting = "Hello $first $last";
                                                        Mail::to($recordEight->user->email)->send(new MailSender('Referral Bonus', $greeting, $message_eight, '', ''));
                                                        $recordEight->update([
                                                            'status' => true
                                                        ]);
                                                    }
                                                }
                                            }
                                            //                                //nine reward
                                            $user_ref_nine = Reference::whereReferred_id($user_ref_eight->user_id)->first();

                                            if (is_object($user_ref_nine)) {
                                                $user_ref_invest_nine = Investment::whereUser_id($user_ref_nine->user_id)->whereStatus_deposit(true)->whereStatus(false)->first();
                                                $user_count_direct_invest_nine = Reference::whereUser_id($user_ref_nine->user_id)->pluck('user_id');
                                                $user_count_direct_nine_fetch = Investment::whereIn('user_id', $user_count_direct_invest_nine)->get();
                                                $user_count_direct_nine_unique = $user_count_direct_nine_fetch->unique('user_id');
                                                $user_count_direct_nine = count($user_count_direct_nine_unique);

                                                if (is_object($user_ref_invest_nine) && $run <= 6) {
                                                    if ($run == 1 || $run == 2 || $run == 3 || $run == 4 || $run == 5 || $run == 6) {
                                                        $nineUserReward = $allPercentEqual;
                                                    }
                                                    //record payment
                                                    if ($user_count_direct_nine <= 120) {
                                                        $nineRecordPayment = new RecordPayment();
                                                        $nineRecordPayment->user_id = $user_ref_nine->user_id;
                                                        $nineRecordPayment->payer_id = $payment->user_id;
                                                        $nineRecordPayment->plan_id = $payment->plan->id;
                                                        $nineRecordPayment->amount = $nineUserReward;
                                                        $nineRecordPayment->type = "profit";
                                                        $nineRecordPayment->level = 9;
                                                        $nineRecordPayment->transaction_id = $payment->transaction_id;
                                                        $nineRecordPayment->save();
                                                    }
                                                    //release record payment
                                                    if ($user_count_direct_nine >= 120 && $user_count_direct_nine <= 120) {
                                                        $userRecordNine = RecordPayment::whereUser_id($user_ref_nine->user_id)->whereLevel(9)->whereStatus(false)->whereType('profit')->get();
                                                        $filterNine = $userRecordNine->unique('payer_id');
                                                        foreach ($filterNine as $recordNine) {
                                                            $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($recordNine->user_id)));
                                                            $userMoney->user_id = $recordNine->user_id;
                                                            $userMoney->amount = $userMoney->amount + $recordNine->amount;
                                                            $userMoney->save();
                                                            //track avoid payment
                                                            $avoidTwiceNine = new AviodTwicePayment();
                                                            $avoidTwiceNine->reciever_id = $recordNine->user_id;
                                                            $avoidTwiceNine->type = 'profit';
                                                            $avoidTwiceNine->level = 9;
                                                            $avoidTwiceNine->save();
                                                            //transcation log
                                                            Transaction::create([
                                                                'user_id' => $recordNine->user_id,
                                                                'transaction_id' => $recordNine->transaction_id,
                                                                'type' => 'Commissions',
                                                                'name_type' => 'Referral Bonus',
                                                                'amount' => $recordNine->amount,
                                                                'amount_profit' => $recordNine->amount,
                                                                'description' => 'Referral Bonus Under ' . $recordNine->plan->name,
                                                                'status' => true
                                                            ]);
                                                            $message_nine = 'USD' . $recordNine->amount . " Referral Bonus has been successfully sent to wallet";
                                                            $first = $recordNine->user->first_name;
                                                            $last = $recordNine->user->last_name;
                                                            $greeting = "Hello $first $last";
                                                            Mail::to($recordNine->user->email)->send(new MailSender('Referral Bonus', $greeting, $message_nine, '', ''));
                                                            $recordNine->update([
                                                                'status' => true
                                                            ]);
                                                        }
                                                    }
                                                }
//                                //ten reward
                                                $user_ref_ten = Reference::whereReferred_id($user_ref_nine->user_id)->first();

                                                if (is_object($user_ref_ten)) {
                                                    $user_ref_invest_ten = Investment::whereUser_id($user_ref_ten->user_id)->whereStatus_deposit(true)->whereStatus(false)->first();

                                                    $user_count_direct_invest_ten = Reference::whereUser_id($user_ref_ten->user_id)->pluck('user_id');
                                                    $user_count_direct_ten_fetch = Investment::whereIn('user_id', $user_count_direct_invest_ten)->get();
                                                    $user_count_direct_ten_unique = $user_count_direct_ten_fetch->unique('user_id');
                                                    $user_count_direct_ten = count($user_count_direct_ten_unique);

                                                    if (is_object($user_ref_invest_ten) && $run <= 6) {
                                                        if ($run == 1 || $run == 2 || $run == 3 || $run == 4 || $run == 5 || $run == 6) {
                                                            $tenUserReward = $allPercentEqual;
                                                        }

                                                        //record payment
                                                        if ($user_count_direct_ten <= 120) {
                                                            $tenRecordPayment = new RecordPayment();
                                                            $tenRecordPayment->user_id = $user_ref_ten->user_id;
                                                            $tenRecordPayment->payer_id = $payment->user_id;
                                                            $tenRecordPayment->plan_id = $payment->plan->id;
                                                            $tenRecordPayment->amount = $tenUserReward;
                                                            $tenRecordPayment->type = "profit";
                                                            $tenRecordPayment->level = 10;
                                                            $tenRecordPayment->transaction_id = $payment->transaction_id;
                                                            $tenRecordPayment->save();
                                                        }
                                                        //release record payment
                                                        if ($user_count_direct_ten >= 120 && $user_count_direct_ten <= 120) {
                                                            $userRecordTen = RecordPayment::whereUser_id($user_ref_ten->user_id)->whereLevel(10)->whereStatus(false)->whereType('profit')->get();
                                                            $filterTen = $userRecordTen->unique('payer_id');
                                                            foreach ($filterTen as $recordTen) {
                                                                $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($recordTen->user_id)));
                                                                $userMoney->user_id = $recordTen->user_id;
                                                                $userMoney->amount = $userMoney->amount + $recordTen->amount;
                                                                $userMoney->save();
                                                                //track avoid payment
                                                                $avoidTwiceTen = new AviodTwicePayment();
                                                                $avoidTwiceTen->reciever_id = $recordTen->user_id;
                                                                $avoidTwiceTen->type = 'profit';
                                                                $avoidTwiceTen->level = 10;
                                                                $avoidTwiceTen->save();
                                                                //transcation log
                                                                Transaction::create([
                                                                    'user_id' => $recordTen->user_id,
                                                                    'transaction_id' => $recordTen->transaction_id,
                                                                    'type' => 'Commissions',
                                                                    'name_type' => 'Referral Bonus',
                                                                    'amount' => $recordTen->amount,
                                                                    'amount_profit' => $recordTen->amount,
                                                                    'description' => 'Referral Bonus Under ' . $recordTen->plan->name,
                                                                    'status' => true
                                                                ]);
                                                                $message_ten = 'USD' . $recordTen->amount . " Referral Bonus has been successfully sent to wallet";
                                                                $first = $recordTen->user->first_name;
                                                                $last = $recordTen->user->last_name;
                                                                $greeting = "Hello $first $last";
                                                                Mail::to($recordTen->user->email)->send(new MailSender('Referral Bonus', $greeting, $message_ten, '', ''));
                                                                $recordTen->update([
                                                                    'status' => true
                                                                ]);
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
