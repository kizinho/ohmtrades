<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Mail\MailSender;
use Illuminate\Support\Facades\Mail;

class CheckUserInvest extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:invest';

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
        $users = User::whereCode(true)->get();
        foreach ($users as $user) {
            if (empty($user->activeIn)) {
                //send message 
                $link = url('deposits');
                $link_name = "Purchase Plan";
                $name = $user->first_name . ' ' . $user->last_name;
                $greeting = "Hello $name";
                $text_p = "Once again, we congratulate you for taking a bold step in registering with us .  
Your account is still inactive because you are yet to purchase a trading package.   <br><br>To activate your account and start earning weekly income, you need to purchase a package within your budget.
To purchase a package kindly click on this link below,";
                Mail::to($user->email)->send(new MailSender('Purchase plan notification', $greeting, $text_p, $link, $link_name));
            }
        }
        return 'success';
    }

}
