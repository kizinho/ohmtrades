<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanTableDataSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $plan = new Plan();
        $plan->name = 'Premium';
        $plan->percentage = 5.7;
        $plan->min = 50;
        $plan->max =9999;
        
        $plan->compound_id = 1;
        $plan->save();

//        //plan2
        $plan2 = new Plan();
        $plan2->name = 'NFP TRADES';
        $plan2->percentage = 10.2;
        $plan2->min = 100000;
        $plan2->max = 49999;
        $plan2->compound_id = 1;
        $plan2->save();
        
//        //plan3
        $plan3 = new \App\Models\EducationLicensePlan();
        $plan3->name = 'Educational plan';
        $plan3->amount = 100;
        $plan3->compound_id = 2;
        $plan3->save();
//        //plan4
//        $plan4 = new Plan();
//        $plan4->name = 'Gold';
//        $plan4->min = 10000;
//        $plan4->percentage = 20;
//        $plan4->max = 100000000;
//        $plan4->compound_id = 1;
//        $plan4->save();
        //plan5
//        $plan5 = new Plan();
//        $plan5->name = 'PLAN 5';
//        $plan5->percentage = 80;
//        $plan5->min = 10005;
//        $plan5->max = 100000;
//        $plan5->compound_id = 5;
//        $plan5->ref = 6;
//        $plan5->save();
//        //plan6
//        $plan6 = new Plan();
//        $plan6->name = 'PLAN 6';
//        $plan6->percentage = 20;
//        $plan6->min = 1;
//        $plan6->max = 108;
//        $plan6->ref = 6;
//        $plan6->compound_id = 6;
//        $plan6->save();
    }

}
