<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositMessage extends Model
{
    use HasFactory;
     protected $fillable = [
        'message', 'invest_id', 'education_id','user_money_id'
    ];
}
