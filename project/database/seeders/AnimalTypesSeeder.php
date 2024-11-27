<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnimalTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('animal_types')->insert([
            ['type_name' => 'Cat'],
            ['type_name' => 'Dog'],
            ['type_name' => 'Bird'],
            ['type_name' => 'Fish'],
            ['type_name' => 'Rabbit'],
            ['type_name' => 'Hamster'],
            ['type_name' => 'Turtle'],
            ['type_name' => 'Parrot'],
        ]);
    }
}
