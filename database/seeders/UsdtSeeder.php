<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coin;

class UsdtSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $coin = new Coin();
        $coin->name = 'USDT (trc20)';
        $coin->slug = str_slug('Usdt Address', '_');
        $coin->address = 'TDiku7M4JpJVkFA9wkctAoctfPmGy8M1Sh';
        $coin->status = true;
        $coin->photo = 'coins/usdt_address.png';
        $coin->save();
    }

}
