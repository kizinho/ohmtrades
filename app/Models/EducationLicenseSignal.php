<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationLicenseSignal extends Model {

    use HasFactory;

    protected $fillable = [
        'trading_pair', 'slug', 'content', 'image', 'price', 'analytic_link','title'
    ];

   public function getAbbreviated() {
        return str_limit(strip_tags($this->content), 80, '...');
    }   
    
}
