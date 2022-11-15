<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Mail\MailSender;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
class MessageUsers extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:message';

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
        $users = User::whereCode(true)->where('updated_at', '<', Carbon::now()->subDays(1))->take(10)->get();
        foreach ($users as $user) {
            //send message 
            $link = url('referral');
            $link_name = "Affiliate Link";
            $name = $user->first_name . ' ' . $user->last_name;
            $greeting = "Hello $name";
            $text_p = "Do you know that our affiliate program can earn you more than the regular earnings you get on your plans. The bigger your affiliate network, the more bonuses and rewards you receive.
<br>Start affiliating today to earn more with us .
<br><br>
Click the link below to see the bonuses and rewards that awaits you when you affiliate.";
            Mail::to($user->email)->send(new MailSender('Affiliate Network notification', $greeting, $text_p, $link, $link_name));
            $user->update(['code' => true]);
        }
        return 'success';
    }

}
