<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AviodTwicePayment extends Model
{
    use HasFactory;
    
     protected $fillable = [
        'reciever_id', 'level','type','payer_id'
    ];
}
