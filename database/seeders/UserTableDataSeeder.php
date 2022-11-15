<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableDataSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $user = new User();
        $user->first_name = 'cobit';
        $user->last_name = 'fx';
        $user->type = 'admin';
        $user->username = "cobitfx";
        $user->code = true;
        $user->email = 'cobitfx@demo.com';
        $user->password = bcrypt('secretcobitfxqasd');
        $user->save();
    }

}
