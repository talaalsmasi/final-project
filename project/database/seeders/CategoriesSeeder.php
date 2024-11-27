<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Food',
                'description' => 'High-quality food for pets, including dry and wet options.',
            ],
            [
                'name' => 'Toys',
                'description' => 'A variety of toys to keep your pets entertained and active.',
            ],
            [
                'name' => 'Hygiene',
                'description' => 'Hygiene products including shampoos, grooming tools, and more.',
            ],
            [
                'name' => 'Health Supplements',
                'description' => 'Supplements for enhancing pet health and wellbeing.',
            ],
            [
                'name' => 'Accessories',
                'description' => 'Various accessories such as collars, leashes, and harnesses.',
            ],
            [
                'name' => 'Bedding',
                'description' => 'Comfortable bedding options for your pets to rest and sleep.',
            ],
            [
                'name' => 'Grooming',
                'description' => 'Grooming supplies including brushes, clippers, and grooming wipes.',
            ],
            [
                'name' => 'Travel',
                'description' => 'Products designed for traveling with your pets comfortably.',
            ],
            [
                'name' => 'Training',
                'description' => 'Training tools and aids for effective pet training.',
            ],
            [
                'name' => 'Clothing',
                'description' => 'Clothes and costumes for pets for special occasions.',
            ],
        ]);
    }
}
