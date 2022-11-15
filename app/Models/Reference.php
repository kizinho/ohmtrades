<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model {

    protected $fillable = [
        'user_id', 'referred_id',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    
     public function ref() {
        return $this->belongsTo(User::class, 'referred_id');
    }

    public function userRef() {
        return $this->hasMany(User::class, 'id', 'referred_id')->with('activeIn');
    }

  

}
