<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Investment extends Model {

    protected $appends = ['fridays'];
    protected $dates = ['due_pay', 'time_pay'];
    protected $fillable = [
        'transaction_id', 'user_id', 'plan_id', 'is_taken', 'earn', 'coin_id', 'amount', 'run_count', 'amount_check', 'due_pay', 'time_pay', 'status_deposit', 'deposit_investment_charge', 'settled_status', 'status', 'user_withdrawal_id'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function usercoin() {
        return $this->belongsTo(UserCoin::class, 'coin_id');
    }

    public function coin() {
        return $this->belongsTo(Coin::class, 'coin_id');
    }

    public function plan() {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    public function plans() {
        return $this->hasMany(Plan::class, 'plan_id');
    }

    public function proofImages() {
        return $this->hasMany(DepositProof::class, 'invest_id');
    }

    public function proofMessage() {
        return $this->hasMany(DepositMessage::class, 'invest_id');
    }

    public function cal() {
        $weeks = round($this->plan->compound->compound * 0.001369);
        $profit = $this->amount * $this->plan->percentage / 100;
        $months = (int) $weeks * 4;
        $earnAmount = $profit * $months;
        return round($this->earn / ($earnAmount / 100), 1);
    }

    public function calTotal() {
        $weeks = round($this->plan->compound->compound * 0.001369);
        $profit = $this->amount * $this->plan->percentage / 100;
        $months = (int) $weeks * 4;
        $earnAmount = $profit * $months;
        return $earnAmount;
    }

    public function getFridaysAttribute() {
        $time_zone = new \DateTimeZone('Africa/Lagos');
        $first_friday_of_this_month = new \DateTime('first Friday of this month', $time_zone);
        $last_friday_of_this_month = new \DateTime('last Friday of this month', $time_zone);
        $now = new \DateTime(Carbon::now());
        $nowSet = new \DateTime();
        $nowSet->setTime(17, 15);
        $planName = $this->plan->name;
        if ($planName == 'NFP TRADES') {

            if ($first_friday_of_this_month == Carbon::today()) {

                return true;
            }
        } else {
            return false;
        }


        return false;
    }

}
