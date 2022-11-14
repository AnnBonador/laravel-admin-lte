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
                'contact' => '111111',
                'dob' => '11/12/2009',
                'gender' => 'Female',
                'status' => '1',
                'clinic_id' => '7',
                'type' => 1, //Admin
                'password' => bcrypt('password'),
            ],
            [
                'fname' => 'Doctor',
                'lname' => 'User',
                'email' => 'doctor@gmail.com',
                'type' => 2, //Doctor
                'contact' => '111111',
                'dob' => '11/12/2009',
                'gender' => 'Female',
                'status' => '1',
                'clinic_id' => '7',
                'password' => bcrypt('password'),
            ],
            [
                'fname' => 'Receptionist',
                'lname' => 'User',
                'email' => 'receptionist@gmail.com',
                'type' => 3, //receptionist
                'contact' => '111111',
                'dob' => '11/12/2009',
                'gender' => 'Female',
                'status' => '1',
                'clinic_id' => '7',
                'password' => bcrypt('password'),
            ],
            [
                'fname' => 'User',
                'lname' => 'User',
                'email' => 'user@gmail.com',
                'type' => 0, //patient
                'contact' => '111111',
                'dob' => '11/12/2009',
                'gender' => 'Female',
                'status' => '1',
                'clinic_id' => '7',
                'password' => bcrypt('password'),
            ],
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
