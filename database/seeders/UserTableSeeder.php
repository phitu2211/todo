<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User;
        $admin->username = "User01";
        $admin->password = bcrypt('123123123');
        $admin->save();
        $user = new User;
        $user->username = "User02";
        $user->password = bcrypt('123123123');
        $user->save();
    }
}
