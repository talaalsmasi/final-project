<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bookings')->insert([
            [
                'user_id' => 1,
                'pet_id' => 1,
                'room_id' => 1,
                'check_in_date' => Carbon::createFromFormat('Y-m-d', '2024-10-20'),
                'check_out_date' => Carbon::createFromFormat('Y-m-d', '2024-10-25'),
                'status' => 'approved',
            ],
            [
                'user_id' => 2,
                'pet_id' => 2,
                'room_id' => 2,
                'check_in_date' => Carbon::createFromFormat('Y-m-d', '2024-10-22'),
                'check_out_date' => Carbon::createFromFormat('Y-m-d', '2024-10-27'),
                'status' => 'pending',
            ],
            [
                'user_id' => 3,
                'pet_id' => 3,
                'room_id' => 1,
                'check_in_date' => Carbon::createFromFormat('Y-m-d', '2024-10-24'),
                'check_out_date' => Carbon::createFromFormat('Y-m-d', '2024-10-30'),
                'status' => 'rejected',
            ],
            [
                'user_id' => 1,
                'pet_id' => 4,
                'room_id' => 2,
                'check_in_date' => Carbon::createFromFormat('Y-m-d', '2024-10-15'),
                'check_out_date' => Carbon::createFromFormat('Y-m-d', '2024-10-20'),
                'status' => 'approved',
            ],
            [
                'user_id' => 4,
                'pet_id' => 1,
                'room_id' => 3,
                'check_in_date' => Carbon::createFromFormat('Y-m-d', '2024-10-18'),
                'check_out_date' => Carbon::createFromFormat('Y-m-d', '2024-10-23'),
                'status' => 'pending',
            ],
            [
                'user_id' => 5,
                'pet_id' => 2,
                'room_id' => 1,
                'check_in_date' => Carbon::createFromFormat('Y-m-d', '2024-10-10'),
                'check_out_date' => Carbon::createFromFormat('Y-m-d', '2024-10-15'),
                'status' => 'approved',
            ],
            [
                'user_id' => 6,
                'pet_id' => 3,
                'room_id' => 2,
                'check_in_date' => Carbon::createFromFormat('Y-m-d', '2024-10-12'),
                'check_out_date' => Carbon::createFromFormat('Y-m-d', '2024-10-17'),
                'status' => 'approved',
            ],
            [
                'user_id' => 3,
                'pet_id' => 4,
                'room_id' => 3,
                'check_in_date' => Carbon::createFromFormat('Y-m-d', '2024-10-05'),
                'check_out_date' => Carbon::createFromFormat('Y-m-d', '2024-10-10'),
                'status' => 'pending',
            ],
            [
                'user_id' => 4,
                'pet_id' => 1,
                'room_id' => 1,
                'check_in_date' => Carbon::createFromFormat('Y-m-d', '2024-10-14'),
                'check_out_date' => Carbon::createFromFormat('Y-m-d', '2024-10-19'),
                'status' => 'approved',
            ],
            [
                'user_id' => 5,
                'pet_id' => 2,
                'room_id' => 2,
                'check_in_date' => Carbon::createFromFormat('Y-m-d', '2024-10-16'),
                'check_out_date' => Carbon::createFromFormat('Y-m-d', '2024-10-21'),
                'status' => 'pending',
            ],
            [
                'user_id' => 2,
                'pet_id' => 3,
                'room_id' => 1,
                'check_in_date' => Carbon::createFromFormat('Y-m-d', '2024-10-09'),
                'check_out_date' => Carbon::createFromFormat('Y-m-d', '2024-10-14'),
                'status' => 'approved',
            ],
            [
                'user_id' => 6,
                'pet_id' => 4,
                'room_id' => 3,
                'check_in_date' => Carbon::createFromFormat('Y-m-d', '2024-10-11'),
                'check_out_date' => Carbon::createFromFormat('Y-m-d', '2024-10-16'),
                'status' => 'pending',
            ],
            [
                'user_id' => 1,
                'pet_id' => 2,
                'room_id' => 1,
                'check_in_date' => Carbon::createFromFormat('Y-m-d', '2024-10-20'),
                'check_out_date' => Carbon::createFromFormat('Y-m-d', '2024-10-25'),
                'status' => 'approved',
            ],
            [
                'user_id' => 2,
                'pet_id' => 3,
                'room_id' => 2,
                'check_in_date' => Carbon::createFromFormat('Y-m-d', '2024-10-12'),
                'check_out_date' => Carbon::createFromFormat('Y-m-d', '2024-10-17'),
                'status' => 'approved',
            ],
            [
                'user_id' => 3,
                'pet_id' => 4,
                'room_id' => 3,
                'check_in_date' => Carbon::createFromFormat('Y-m-d', '2024-10-30'),
                'check_out_date' => Carbon::createFromFormat('Y-m-d', '2024-11-05'),
                'status' => 'pending',
            ],
        ]);
    }
}

