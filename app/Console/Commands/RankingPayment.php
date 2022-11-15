<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\userTrackEarn;
use App\Mail\MailSender;
use Illuminate\Support\Facades\Mail;
use App\Models\Transaction;
use Illuminate\Support\Str;
class RankingPayment extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rank:payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $users = User::where('ref_count', '>=', 1000)->get();

        if (is_object($users)) {
            foreach ($users as $user) {
                $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($user->id)));
                if ($user->ref_count >= 100) {
                    if ($user->is_diamond == false) {

                        $userMoney->user_id = $user->id;
                        $userMoney->amount = $userMoney->amount + 2500;
                        $userMoney->save();
                        $user->update([
                            'is_diamond' => true
                        ]);
                        Transaction::create([
                            'user_id' => $user->id,
                            'transaction_id' => strtolower(Str::random(8)),
                            'type' => 'Diamond ranked payment',
                            'name_type' => 'Diamond ranked payment',
                            'status' => true,
                            'amount' => 2500,
                            'amount_profit' => 2500,
                            'description' => 'Diamond ranked payment Notification  ',
                        ]);
                        $name = $userMoney->user->first_name . ' ' . $userMoney->user->last_name;
                        $greeting = "Hello $name";
                        $text_p = "Diamond ranked payment of $2500 has been credited to your  <b>wallet<b/>";
                        Mail::to($userMoney->user->email)->send(new MailSender('Diamond ranked payment notification', $greeting, $text_p, '', ''));
                    }
                } elseif ($user->ref_count >= 50) {
                    if ($user->is_super == false) {
                        $userMoney->user_id = $user->id;
                        $userMoney->amount = $userMoney->amount + 1000;
                        $userMoney->save();
                        $user->update([
                            'is_super' => true
                        ]);
                        Transaction::create([
                            'user_id' => $user->id,
                            'transaction_id' => strtolower(Str::random(8)),
                            'type' => 'Super Star ranked payment',
                            'name_type' => 'Super Star ranked payment',
                            'status' => true,
                            'amount' => 1000,
                            'amount_profit' => 1000,
                            'description' => 'Super Star ranked payment Notification  ',
                        ]);
                        $name = $userMoney->user->first_name . ' ' . $userMoney->user->last_name;
                        $greeting = "Hello $name";
                        $text_p = "Super Star ranked payment of $1000 has been credited to your  <b>wallet<b/>";
                        Mail::to($userMoney->user->email)->send(new MailSender('Super Star ranked payment notification', $greeting, $text_p, '', ''));
                    }
                }
            }
            return 'success';
        }
    }

}
