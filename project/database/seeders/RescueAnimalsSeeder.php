<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RescueAnimalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rescue_animals')->insert([
            [
                'pet_id' => 7, // ضع هنا الـ pet_id المناسب من جدول pets
                'total_required_amount' => 70.00,
                'current_donated_amount' => 10.00,
                'description' => 'This animal needs surgery due to an injury.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pet_id' => 8, // ضع هنا الـ pet_id المناسب من جدول pets
                'total_required_amount' => 30.00,
                'current_donated_amount' => 4.00,
                'description' => 'Vaccination and food for this rescued pet.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pet_id' => 9, // ضع هنا الـ pet_id المناسب من جدول pets
                'total_required_amount' => 60.00,
                'current_donated_amount' => 6.00,
                'description' => 'This animal requires medical attention and a safe place.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pet_id' => 10, // ضع هنا الـ pet_id المناسب من جدول pets
                'total_required_amount' => 100.00,
                'current_donated_amount' => 18.00,
                'description' => 'This pet requires daily medication and therapy.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pet_id' => 11, // ضع هنا الـ pet_id المناسب من جدول pets
                'total_required_amount' => 100.00,
                'current_donated_amount' => 60.00,
                'description' => 'This rescued pet is recovering from surgery and needs follow-up care.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pet_id' => 12, // ضع هنا الـ pet_id المناسب من جدول pets
                'total_required_amount' => 30.00,
                'current_donated_amount' => 1.00,
                'description' => 'Urgent care needed for this rescued animal due to severe malnutrition.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

