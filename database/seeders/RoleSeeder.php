<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
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
                'name' => 'Super-Admin',
            ],
            [
                'name' => 'Doctor',
            ],
            [
                'name' => 'Receptionist',
            ],
        ];

        foreach ($users as $key => $roles) {
            Role::create($roles);
        }
    }
}
