<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Investment;
use App\Models\Admin\Setting;
use App\Models\userTrackEarn;
use App\Mail\MailSender;
use Illuminate\Support\Facades\Mail;
use App\Models\Transaction;
use Illuminate\Support\Str;

class ShareFounderPoolFund extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'founder:pool';

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
        $setting = Setting::whereId(1)->first();
        $investments = Investment::whereStatus(false)->whereStatus_deposit(true)->where(function ($query) {
                    $query->where('plan_id', 7)
                            ->orWhere('plan_id', 8);
                })->get();
        $group_user = $investments->groupBy('user_id');
        if ($setting->founder_pool != 0.00) {
            $total_user = $group_user->count();
            $amount_to = $setting->founder_pool / $total_user;
            foreach ($group_user as $key => $user) {
                $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($key)));
                $userMoney->user_id = $key;
                $userMoney->amount = $userMoney->amount + $amount_to;
                $userMoney->save();
                //transcation log
                Transaction::create([
                    'user_id' => $key,
                    'transaction_id' => strtolower(Str::random(8)),
                    'type' => 'founder pool payment',
                    'name_type' => 'founder pool payment',
                    'status' => true,
                    'amount' => $amount_to,
                    'amount_profit' => $amount_to,
                    'description' => 'Founder pool payment Notification  ',
                ]);
                $name = $userMoney->user->first_name . ' ' . $userMoney->user->last_name;
                $greeting = "Hello $name";
                $text_p = "Founder pool payment of $$amount_to has been credited to your  <b>wallet<b/>";
                Mail::to($userMoney->user->email)->send(new MailSender('Founder pool payment Notification', $greeting, $text_p, '', ''));
            }
            $setting->update([
                'founder_pool' => 0
            ]);
            return 'success';
        }
    }

}
