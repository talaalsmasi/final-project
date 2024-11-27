<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('doctors')->insert([
            [
                'user_id' => 4,
                'about' => 'Graduated from Jordan University of Science and Technology  and has 12 years of experience.',
            ],
            [
                'user_id' => 5,
                'about' => 'Graduated from the University of Jordan and has 10 years of experience.',
            ],
            [
                'user_id' => 6,
                'about' => 'Graduated from Jordan University of Science and Technology and has 14 years of experience.',
            ],
        ]);
    }
}

