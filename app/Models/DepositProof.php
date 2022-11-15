<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositProof extends Model
{
    use HasFactory;
     protected $fillable = [
        'path', 'invest_id', 'education_id','user_money_id'
    ];
}
