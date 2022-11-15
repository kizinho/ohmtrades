<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable {

    use Notifiable,
        HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'type', 'last_name', 'verified_code', 'email', 'token', 'ref_check', 'password', 'can_withdraw', 'code', 'phone_no', 'photo', 'nick_name', 'fb',
        'country', 'whatsapp', 'skyp', 'insta', 'tele', 'tw','username','ref_count','is_diamond','is_super','updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function usercoin() {
        return $this->hasMany(UserCoin::class, 'coin_id');
    }

    public function userMoney() {
        return $this->hasMany(UserWithdrawal::class, 'user_id')->whereStatus(true);
    }

    public function userPlan() {
        return $this->hasMany(Investment::class, 'user_id');
    }

    public function userPlanOne() {
        return $this->hasOne(Investment::class, 'user_id')->orderBy('created_at', 'desc');
    }

    public function coin() {
        return $this->hasMany(UserCoin::class, 'user_id')->orderBy('created_at', 'desc')->where('address', '!=', '')->with('userWithdraw');
    }

     public function coinWallet() {
        return $this->hasMany(UserCoin::class, 'user_id')->orderBy('created_at', 'desc')->where('address', '!=', '');
    }
    public function earn() {
        return $this->hasOne(userTrackEarn::class, 'user_id');
    }

    public function activeIn() {
        return $this->hasOne(Investment::class, 'user_id')->whereNotNull('due_pay');
    }

}
