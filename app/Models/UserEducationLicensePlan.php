<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEducationLicensePlan extends Model {

    use HasFactory;

    protected $dates = ['due_pay'];
    protected $fillable = [
        'transaction_id', 'user_id', 'amount', 'education_license_id','amount_check', 'due_pay', 'status_deposit', 'status'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

  

    public function plan() {
        return $this->belongsTo(EducationLicensePlan::class, 'education_license_id');
    }

    public function plans() {
        return $this->hasMany(EducationLicensePlan::class, 'education_license_id');
    }

    public function proofImages() {
        return $this->hasMany(DepositProof::class, 'education_id');
    }

    public function proofMessage() {
        return $this->hasMany(DepositMessage::class, 'education_id');
    }

}
