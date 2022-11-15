<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use BlockIo;
use App\Models\Coin;
use App\Models\Admin\Setting;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use App\Mail\MailSender;
use Illuminate\Support\Facades\Mail;
use App\Models\Withdraw;

class AutoConfirmWithdrawal extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'confirm:payouts';

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
                    $block_auto = $block_io->get_transactions(array('type' => 'sent'));
                    foreach ($block_auto->data->txs as $data) {
                        if ($data->confidence >= 1 && $data->confirmations >= 3) {
                            $payment = Withdraw::whereAmount_check($data->amounts_sent[0]->amount)->whereConfirm(true)->whereStatus(false)->whereStatus_withdraw(false)->first();
                            if (is_object($payment)) {
                                $payment->update([
                                    'status' => true,
                                    'status_withdraw' => true
                                ]);
                                //trans update
                                Transaction::whereTransaction_id($payment->transaction_id)->update([
                                    'status' => true
                                ]);
                                $email = $payment->user->email;
                                $name = $payment->user->first_name . ' ' . $payment->user->last_name;
                                $greeting = "Hello $name";
                                $url = "https://sochain.com/tx/BTC/" . $data->txid;
                                $message = "Payment successfully sent to your bitcoin wallet";
                                $link = $url;
                                $link_name = " View on Blockchain";
                                Mail::to($email)->send(new MailSender('Withdraw Payout confirmation', $greeting, $message, $link, $link_name));
                            }
                        }
                    }
                }

                if ($action == 'ethereum_address') {
                    $name = $payment->user->first_name . ' ' . $payment->user->last_name;
                    $greeting = "Hello admin $name Paypout confirmation with Eth";
                    $text = "Eth payout confirmation can only be done via admin panel, please go to admin and confirm this payment";
                    //send admin email
                    Mail::to($setting->send_notify_email)->send(new MailSender('Eth Payout confirmation', $greeting, $text, '', ''));
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
