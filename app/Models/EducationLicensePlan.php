<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationLicensePlan extends Model
{
    use HasFactory;
     protected $fillable = [
        'name', 'amount', 'compound_id',
    ];

    public function compound() {
        return $this->belongsTo(Compound::class, 'compound_id');
    }

    public function buyEducationPlan() {
        return $this->hasMany(UserEducationLicensePlan::class, 'education_license_id');
    }
}
