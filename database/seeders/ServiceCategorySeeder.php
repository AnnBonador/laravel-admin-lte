<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'General Dentistry',
            'Pediatric Dentistry',
            'Oral Medicine',
            'Oral & Maxillofacial Surgery',
            'Orthodontics',
            'Prosthodontics',
            'Temporomandibular Joint Disorders/Orofacial Pain',
        ];

        foreach ($data as $v) {
            ServiceCategory::create(['name' => $v]);
        }
    }
}
