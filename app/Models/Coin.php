<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    protected $fillable = [
        'name', 'address','photo','slug','status',
    ];
    
    public function usercoin() {
        return $this->hasMany(UserCoin::class, 'coin_id')->with('user');
    }
      public function usercoinUser() {
        return $this->hasOne(UserCoin::class, 'coin_id')->whereUser_id(\Illuminate\Support\Facades\Auth::user()->id)->where('address', '!=', '');
    }

}
