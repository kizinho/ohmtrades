<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Investment;
use App\Models\Transaction;
use App\Models\Admin\Setting;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\UserWithdrawal;
use App\Mail\MailSender;
use Illuminate\Support\Facades\Mail;
use App\Models\userTrackEarn;
use \App\Http\Controllers\Traits\ProfitOver;

class monthlyProfit extends Command {

    use ProfitOver;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monthly:profit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'monthly profit payout';

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
            if ($setting->investment_payment_mode == false) {
//                $investments = Investment::whereStatus(0)->whereStatus_deposit(1)->where('updated_at', '<', Carbon::now()->subDays(4))->get();
                $investments = Investment::whereStatus(0)->whereStatus_deposit(1)->get();
                foreach ($investments as $invest) {
                    if ($invest->getFridaysAttribute() == true) {
                        $profit = $invest->amount * $invest->plan->percentage / 100;
                        $daily_profit = $profit;
                        //userwithdrawal

                        $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($invest->user_id)));
                        $userMoney->user_id = $invest->user_id;
                        $userMoney->amount = $userMoney->amount + $daily_profit;
                        $userMoney->save();
                        //update investment 
                        $update_investmentP = Investment::findOrFail($invest->id);
                        $update_investmentP->run_count = $invest->run_count + 1;
                        $update_investmentP->earn = $invest->earn + $daily_profit;
                        $update_investmentP->save();

                        //transcation log
                        Transaction::create([
                            'user_id' => $invest->user_id,
                            'transaction_id' => $invest->transaction_id,
                            'type' => $invest->plan->name,
                            'name_type' => 'Monthly Profit',
                            'status' => true,
                            'amount' => $daily_profit,
                            'amount_profit' => $daily_profit,
                            'description' => 'Profit Notification Under ' . $invest->plan->name,
                        ]);
                        $name = $invest->user->first_name . ' ' . $invest->user->last_name;
                        $greetingP = "Hello $name";
                        $text_p = "Profit of $$daily_profit has been credited to your  <b>wallet<b/>";
                        Mail::to($invest->user->email)->send(new MailSender('First friday of the month profit trade notification', $greetingP, $text_p, '', ''));
                        $return_amount = $invest->amount;
//                        $userMoney->user_id = $invest->user_id;
//                        $userMoney->amount = $userMoney->amount + $invest->amount;
//                        $userMoney->save();
//                        $user_withdrawM = new UserWithdrawal();
//                        $user_withdrawM->amount = $invest->amount;
//                        $user_withdrawM->user_id = $invest->user_id;
//                        $user_withdrawM->coin_id = $invest->usercoin->id;
//                        $user_withdrawM->type = "Main Balance";
//                        $user_withdrawM->status = false;
//                        $user_withdrawM->main_invest = false;
//                        $user_withdrawM->plan_id = $invest->plan_id;
//                        $user_withdrawM->save();
                        //we not paying user initial deposit untill they request for it
                        //update investment 
                        $update_investment = Investment::findOrFail($invest->id);
                        $update_investment->status = true;
                        $update_investment->save();

                        //transcation log
                        Transaction::create([
                            'user_id' => $invest->user_id,
                            'transaction_id' => $invest->transaction_id,
                            'type' => $invest->plan->name,
                            'name_type' => 'Return Investment Amount',
                            'status' => true,
                            'amount' => $return_amount,
                            'amount_profit' => $return_amount,
                            'description' => 'You Investment Amount Returned  Under ' . $invest->plan->name
                        ]);
                        $name = $invest->user->first_name . ' ' . $invest->user->last_name;
                        $greeting = "Hello $name";
                        $text = "Your investment of $$invest->amount have been returned.";
                        Mail::to($invest->user->email)->send(new MailSender('Investment  Completed', $greeting, $text, '', ''));
                        static::runAffiliateProfitOver($update_investment, $update_investment->plan->id, $update_investment->run_count, $daily_profit);
                    }
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
