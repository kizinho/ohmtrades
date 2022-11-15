<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class Plan extends Model {

    protected $appends = ['fridays', 'captial'];
    protected $fillable = [
        'name', 'min', 'max', 'percentage', 'compound_id', 'image',
    ];

    public function compound() {
        return $this->belongsTo(Compound::class, 'compound_id');
    }

    public function investment() {
        return $this->hasMany(Investment::class, 'plan_id');
    }

    public function investmentAuth() {
        return $this->hasMany(Investment::class, 'plan_id')->whereUser_id(Auth::user()->id);
    }

    public function getFridaysAttribute() {
        $time_zone = new \DateTimeZone('Africa/Lagos');
        $first_friday_of_this_month = new \DateTime('first Friday of this month', $time_zone);
        $last_friday_of_this_month = new \DateTime('last Friday of this month', $time_zone);
        $now = new \DateTime(Carbon::now());
        $nowSet = new \DateTime();
        $nowSet->setTime(17, 15);
        $planName = $this->name;

        if ($planName == 'NFP TRADES') {

            if ($first_friday_of_this_month == Carbon::today()) {

                return true;
            }
        } else {
            return false;
        }


        return false;
    }

}
