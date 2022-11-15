<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model {

    protected $fillable = [
        'user_id', 'transaction_id', 'coin_id', 'amount', 'name_type', 'status', 'amount_profit', 'description', 'type', 'deposit_investment_charge', 'withdraw_charge'
    ];

    public function usercoin() {
        return $this->belongsTo(UserCoin::class, 'coin_id')->with('coin');
    }

    public function getPlan() {
        return preg_replace('/[^0-9]/', '', $this->description);
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id')->with('coin');
    }

}
