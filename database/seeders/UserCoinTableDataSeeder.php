<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserCoin;

class UserCoinTableDataSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $user_coin = new UserCoin();
        $user_coin->user_id = 1;
        $user_coin->address = 'ibreamenrrjjfkewwww';
        $user_coin->coin_id = 1;
        $user_coin->save();
    }

}
