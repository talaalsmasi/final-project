<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Area;

class AreasTableSeeder extends Seeder
{
    public function run()
    {
        Area::create([
            'name' => 'Near Area',
            'description' => 'This area is close to the clinic, suitable for quick service.',
            'price_one_way' => 5,
            'price_two_way' => 8,
        ]);

        Area::create([
            'name' => 'Medium Distance Area',
            'description' => 'This area is at a moderate distance from the clinic.',
            'price_one_way' => 10,
            'price_two_way' => 18,
        ]);

        Area::create([
            'name' => 'Far Area',
            'description' => 'This area is far from the clinic, suitable for longer trips.',
            'price_one_way' => 20,
            'price_two_way' => 35,
        ]);
    }
}
