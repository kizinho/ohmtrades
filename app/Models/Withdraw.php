<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model {

    protected $fillable = [
        'user_id', 'transaction_id', 'status_withdraw', 'amount', 'description', 'address', 'usercoin_id', 'withdraw_from',
        'comment', 'withdraw_charge','invest_id', 'total_amount', 'message', 'confirm', 'status', 'amount_check', 'address_name'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id')->with('coin');
    }

    public function coin() {
        return $this->belongsTo(Coin::class, 'coin_id');
    }

    public function usercoin() {
        return $this->belongsTo(UserCoin::class, 'coin_id')->with('coin');
    }

}
