<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Driver;

class DriversTableSeeder extends Seeder
{
    public function run()
    {
        // Adding drivers for the three areas manually

        // Drivers for Area 1
        Driver::create([
            'user_id' => 30,
            'available' => true,
        ]);

        Driver::create([
            'user_id' => 31,
            'available' => false,
        ]);

        Driver::create([
            'user_id' => 32,
            'available' => true,
        ]);

        // Drivers for Area 2
        Driver::create([
            'user_id' => 33,
            'available' => true,
        ]);

        Driver::create([
            'user_id' => 34,
            'available' => false,
        ]);

      

    }
}
