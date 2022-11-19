<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin Seeder

        $user = User::create([
            'fname' => 'Admin',
            'lname' => 'User',
            'email' => 'admin1@gmail.com',
            'contact' => '111111',
            'dob' => '11/12/2009',
            'gender' => 'Female',
            'status' => '1',
            'clinic_id' => '7',
            'type' => 1, //Admin
            'password' => bcrypt('password'),
            'isClinicAdmin' => '27'
        ]);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
