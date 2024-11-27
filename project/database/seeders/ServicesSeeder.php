<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            [
                'name' => 'General Checkup',
                'description' => 'A complete health check for pets',
                'price' => 10.00,
            ],
            [
                'name' => 'Vaccination',
                'description' => 'Routine vaccinations for pets',
                'price' => 15.00,
            ],
            [
                'name' => 'Dental Care',
                'description' => 'Dental cleaning and care services for pets.',
                'price' => 10.00,
            ],
            [
                'name' => 'Consultation', // خدمة الاستشارة
                'description' => 'Consultation services for pet health and wellness.',
                'price' => 10.00,
            ],



        ]);
    }
}
