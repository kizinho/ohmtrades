<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWithdrawal extends Model {

    protected $fillable = [
        'plan_id', 'user_id', 'coin_id', 'amount', 'type', 'status', 'main_invest', 'main_paid', 'deposit_user_paid', 'user_deposit', 'transaction_id'
    ];

    public function coin() {
        return $this->belongsTo(Coin::class, 'site_coin_id');
    }

    public function usercoin() {
        return $this->belongsTo(UserCoin::class, 'coin_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

       public function proofImages() {
        return $this->hasMany(DepositProof::class, 'user_money_id');
    }

    public function proofMessage() {
        return $this->hasMany(DepositMessage::class, 'user_money_id');
    }
}
