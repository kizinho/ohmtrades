<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordPayment extends Model {

    use HasFactory;

    protected $fillable = [
        'user_id', 'plan_id', 'type', 'amount','payer','transaction_id','status','level'
    ];

    public function plan() {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

}
