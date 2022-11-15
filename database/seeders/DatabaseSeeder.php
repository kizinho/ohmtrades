<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $this->call(CoinTableDataSeeder::class);
        $this->call(UserTableDataSeeder::class);
        $this->call(UserCoinTableDataSeeder::class);
        $this->call(CompoundTableDataSeeder::class);
        $this->call(PlanTableDataSeeder::class);
        $this->call(settingsSeeder::class);
        $this->call(UsdtSeeder::class);
    }

}
