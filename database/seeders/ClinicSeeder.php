<?php

namespace Database\Seeders;

use App\Models\Clinic;
use Illuminate\Database\Seeder;

class ClinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Smiles Clinic',
                'email' => 'smiles@smiles.com',
                'contact' => '09206025068',
                'status' => '1',
                'address' => '51 Somewhere',
                'country' => 'Philippines',
                'city' => 'Quezon City',
                'specialization_id' => 'Endodontist'
            ]
        ];

        foreach ($data as $key => $clinic) {
            Clinic::create($clinic);
        }
    }
}
