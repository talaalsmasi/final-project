<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ratings = [
            [
                'user_id' => 17,
                'booking_id' => 1,
                'appointment_id' => null,
                'brooming_id' => null,
                'rating' => 5,
                'feedback' => 'Excellent service!',
                'created_at' => '10/10/2024'
            ],
           
            [
                'user_id' => 3,
                'booking_id' => null,
                'appointment_id' => null,
                'brooming_id' => null,
                'rating' => 5,
                'feedback' => 'My pet loved the grooming!',
            ],
            [
                'user_id' => 1,
                'booking_id' => null,
                'appointment_id' => null,
                'brooming_id' => null,
                'rating' => 3,
                'feedback' => 'It was okay, but could be better.',
            ],
            [
                'user_id' => 2,
                'booking_id' => null,
                'appointment_id' => null,
                'brooming_id' => null,
                'rating' => 2,
                'feedback' => 'Not satisfied with the service.',
            ],
            [
                'user_id' => 23,
                'booking_id' => null,
                'appointment_id' => null,
                'brooming_id' => 2,
                'rating' => 4,
                'feedback' => 'Good service overall.',
            ],
            // Add more ratings as needed
            [
                'user_id' => 21,
                'booking_id' => null,
                'appointment_id' => null,
                'brooming_id' => null,
                'rating' => 5,
                'feedback' => 'Amazing! Highly recommended.',
            ],
            [
                'user_id' => 22,
                'booking_id' => null,
                'appointment_id' => null,
                'brooming_id' => null,
                'rating' => 3,
                'feedback' => 'It was decent, not great.',
            ],
            [
                'user_id' => 10,
                'booking_id' => null,
                'appointment_id' => null,
                'brooming_id' => null,
                'rating' => 4,
                'feedback' => 'Very friendly staff.',
            ],
            [
                'user_id' => 12,
                'booking_id' => null,
                'appointment_id' => null,
                'brooming_id' => null,
                'rating' => 5,
                'feedback' => 'Best experience ever!',
            ],
            // Continue adding as needed...
        ];

        DB::table('ratings')->insert($ratings);
    }
}
