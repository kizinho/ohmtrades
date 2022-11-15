<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\weeklyProfit;
use App\Console\Commands\AutoWithdrawal;
use App\Console\Commands\AutoConfirmWithdrawal;
use App\Console\Commands\AutoDeposit;
use App\Console\Commands\AutoFundDeposit;
use App\Console\Commands\ConfirmEducationLicense;
use App\Console\Commands\monthlyProfit;
use App\Console\Commands\ShareFounderPoolFund;
use App\Console\Commands\RankingPayment;
use App\Console\Commands\CheckUserInvest;
use App\Console\Commands\MessageUsers;

class Kernel extends ConsoleKernel {

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        weeklyProfit::class,
        monthlyProfit::class,
        AutoWithdrawal::class,
        AutoConfirmWithdrawal::class,
        AutoDeposit::class,
        AutoFundDeposit::class,
        ConfirmEducationLicense::class,
        ShareFounderPoolFund::class,
        RankingPayment::class,
        CheckUserInvest::class,
        MessageUsers::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule) {
        $schedule->command('weekly:profit')
                ->weekdays()->hourly()->timezone('Africa/Lagos');
        $schedule->command('monthly:profit')
                ->hourly()->fridays()->timezone('Africa/Lagos');
        $schedule->command('founder:pool')
                ->lastDayOfMonth('15:00')->timezone('Africa/Lagos');
       // $schedule->command('rank:payment')->hourly();
        $schedule->command('user:invest')->dailyAt('12:00');
        $schedule->command('user:message')->everyThirtyMinutes();

//        $schedule->command('auto:withraw')
//                ->hourly()
//                ->days([Schedule::SUNDAY, Schedule::SATURDAY])->timezone('Africa/Lagos');
//        $schedule->command('confirm:payouts')->everyFiveMinutes();
//        $schedule->command('auto:deposit')->everyFiveMinutes();
//        $schedule->command('auto:educationlicense')->everyFiveMinutes();
//        $schedule->command('fund:deposit')->everyFiveMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands() {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }

}
