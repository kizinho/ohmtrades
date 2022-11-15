<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Compound;

class CompoundTableDataSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $com = new Compound();
        $com->id = 1;
        $com->name = '3 months';
        $com->compound = 2190;
        $com->save();
//        //compound 2
        $com2 = new Compound();
        $com2->name = '1 Month';
        $com2->compound = 730;
        $com2->save();
//        //compound 3
//        $com3 = new Compound();
//        $com3->name = 'Daily';
//        $com3->compound = 8760;
//        $com3->save();
//        //compound 4
//        $com4 = new Compound();
//        $com4->name = '72 HOURS';
//        $com4->compound = 72;
//        $com4->save();
//        //compound 5
//        $com5 = new Compound();
//        $com5->name = '1 DAY';
//        $com5->compound = 24;
//        $com5->save();
//        //compound 6
//        $com6 = new Compound();
//        $com6->name = '14 DAYS';
//        $com6->compound = 336;
//        $com6->save();
    }

}
