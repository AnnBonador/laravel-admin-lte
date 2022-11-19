<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
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
                'id' => 1,
                'name' => 'Multi Clinic',
                'title' => 'SMILEs',
                'footer' => 'HATAWAN',
                'email' => 'smiles@smiles.com',
                'logo' => '123.jpg',
                'favicon' => '123.jpg',
                'contact' => '+639127405540',
                'fb' => 'www.facebook.com'
            ]
        ];

        foreach ($data as $key => $setting) {
            Setting::create($setting);
        }
    }
}
