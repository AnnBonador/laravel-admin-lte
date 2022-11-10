<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'fname' => 'Admin',
                'lname' => 'User',
                'email' => 'admin@gmail.com',
                'type' => 1,
                'password' => bcrypt('123456'),
            ],
            [
                'fname' => 'Doctor',
                'lname' => 'User',
                'email' => 'manager@gmail.com',
                'type' => 2,
                'password' => bcrypt('123456'),
            ],
            [
                'fname' => 'User',
                'lname' => 'User',
                'email' => 'user@gmail.com',
                'type' => 0,
                'password' => bcrypt('123456'),
            ],
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
