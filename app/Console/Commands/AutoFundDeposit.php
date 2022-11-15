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

class AutoFundDeposit extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fund:deposit';

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
                            $payment = UserWithdrawal::whereAmount_check($data->amounts_received[0]->amount)
                                            ->whereUser_deposit(true)->whereDeposit_user_paid(false)->first();
                            if (is_object($payment)) {
                                $payment->update([
                                    'status' => true,
                                    'deposit_user_paid' => true
                                ]);

                                $userMoney = userTrackEarn::firstOrNew(array('user_id' => ($payment->user_id)));
                                $userMoney->user_id = $invest->user_id;
                                $userMoney->amount = $userMoney->amount + $payment->amount;
                                $userMoney->save();
                                //trans update
                                Transaction::whereTransaction_id($payment->transaction_id)->update([
                                    'status' => true
                                ]);

                                $email = $payment->user->email;
                                $name = $payment->user->first_name . ' ' . $payment->user->last_name;
                                $greeting = "Hello $name";
                                $url = "https://sochain.com/tx/BTC/" . $data->txid;
                                $message = "your deposit has been confirmed and fund credited to your walllet";
                                $link = $url;
                                $link_name = " View on Blockchain";
                                Mail::to($email)->send(new MailSender('Deposit confirmed from Blockchain', $greeting, $message, $link, $link_name));
                            }
                        }
                    }
                }

                if ($action == 'ethereum_address') {
                    $name = $payment->user->first_name . ' ' . $payment->user->last_name;
                    $greeting = "Hello admin $name deposited with Eth to  fund the wallet";
                    $text = "Eth is not supported fro  automation please kindly confirm this from admin deposit fund";
                    //send admin email
                    Mail::to($setting->send_notify_email)->send(new MailSender('Eth deposit fund confirmation required', $greeting, $text, '', ''));
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
