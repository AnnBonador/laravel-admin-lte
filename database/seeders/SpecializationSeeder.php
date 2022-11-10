<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Seeder;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Endodontist',
            'Orthodontist',
            'Periodontist',
            'Prosthodontist',
            'Prosthodontist',
        ];

        foreach ($data as $v) {
            Specialization::create(['name' => $v]);
        }
    }
}
