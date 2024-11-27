<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BroomingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $broomings = [
            [
                'user_id' => 1,
                'pet_id' => 1,
                'appointment_date' => '2024-10-15',
                'appointment_time' => '10:00 AM - 10:30 AM',
                'service_id' => 1,
                'status' => 'pending',
            ],
            [
                'user_id' => 2,
                'pet_id' => 2,
                'appointment_date' => '2024-10-16',
                'appointment_time' => '10:30 AM - 11:00 AM',
                'service_id' => 2,
                'status' => 'approved',
            ],
            [
                'user_id' => 3,
                'pet_id' => 3,
                'appointment_date' => '2024-10-17',
                'appointment_time' => '11:00 AM - 11:30 AM',
                'service_id' => 3,
                'status' => 'pending',
            ],
            [
                'user_id' => 4,
                'pet_id' => 4,
                'appointment_date' => '2024-10-18',
                'appointment_time' => '11:30 AM - 12:00 PM',
                'service_id' => 1,
                'status' => 'pending',
            ],
            [
                'user_id' => 5,
                'pet_id' => 5,
                'appointment_date' => '2024-10-19',
                'appointment_time' => '12:00 PM - 12:30 PM',
                'service_id' => 2,
                'status' => 'approved',
            ],
            [
                'user_id' => 1,
                'pet_id' => 6,
                'appointment_date' => '2024-10-20',
                'appointment_time' => '12:30 PM - 1:00 PM',
                'service_id' => 3,
                'status' => 'pending',
            ],
            [
                'user_id' => 2,
                'pet_id' => 7,
                'appointment_date' => '2024-10-21',
                'appointment_time' => '1:00 PM - 1:30 PM',
                'service_id' => 1,
                'status' => 'pending',
            ],
            [
                'user_id' => 3,
                'pet_id' => 8,
                'appointment_date' => '2024-10-22',
                'appointment_time' => '1:30 PM - 2:00 PM',
                'service_id' => 2,
                'status' => 'approved',
            ],
            [
                'user_id' => 4,
                'pet_id' => 9,
                'appointment_date' => '2024-10-23',
                'appointment_time' => '2:00 PM - 2:30 PM',
                'service_id' => 3,
                'status' => 'pending',
            ],
            [
                'user_id' => 5,
                'pet_id' => 10,
                'appointment_date' => '2024-10-24',
                'appointment_time' => '2:30 PM - 3:00 PM',
                'service_id' => 1,
                'status' => 'approved',
            ],
            [
                'user_id' => 1,
                'pet_id' => 11,
                'appointment_date' => '2024-10-25',
                'appointment_time' => '3:00 PM - 3:30 PM',
                'service_id' => 2,
                'status' => 'pending',
            ],
            [
                'user_id' => 2,
                'pet_id' => 12,
                'appointment_date' => '2024-10-26',
                'appointment_time' => '3:30 PM - 4:00 PM',
                'service_id' => 3,
                'status' => 'approved',
            ],
            [
                'user_id' => 3,
                'pet_id' => 13,
                'appointment_date' => '2024-10-27',
                'appointment_time' => '4:00 PM - 4:30 PM',
                'service_id' => 1,
                'status' => 'pending',
            ],
            [
                'user_id' => 4,
                'pet_id' => 14,
                'appointment_date' => '2024-10-28',
                'appointment_time' => '4:30 PM - 5:00 PM',
                'service_id' => 2,
                'status' => 'approved',
            ],
            [
                'user_id' => 5,
                'pet_id' => 15,
                'appointment_date' => '2024-10-29',
                'appointment_time' => '5:00 PM - 5:30 PM',
                'service_id' => 3,
                'status' => 'pending',
            ],
        ];

        DB::table('broomings')->insert($broomings);
    }
}

