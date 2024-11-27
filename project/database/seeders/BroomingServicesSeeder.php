<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BroomingServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            [
                'name' => 'Basic Bath',
                'price' => 10.00,
                'description' => 'A basic wash and rinse for your pet.',
            ],
            [
                'name' => 'Full Grooming',
                'price' => 15.00,
                'description' => 'Includes washing, drying, and styling.',
            ],

            [
                'name' => 'Flea Bath',
                'price' =>12.00,
                'description' => 'A bath specifically designed to remove fleas.',
            ],
            [
                'name' => 'Teeth Cleaning',
                'price' => 10,
                'description' => 'Cleaning your pet’s teeth for better oral health.',
            ],

            [
                'name' => 'Ear Cleaning and Pawdicure',
                'price' => 7.00,
                'description' => 'Cleaning your pet’s ears for better hygiene.',
            ],

            [
                'name' => 'Styling & Cut',
                'price' => 10.00,
                'description' => 'Stylish cuts for a trendy look.',
            ],
           
        ];

        DB::table('brooming_services')->insert($services);
    }
}
