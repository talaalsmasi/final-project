<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Call each individual seeder here
        $this->call([
            RolesSeeder::class,
            UsersSeeder::class,
            DoctorsSeeder::class,
            AnimalTypesSeeder::class,
            PetsSeeder::class,
            ServicesSeeder::class,
            AppointmentsSeeder::class,
            RoomsSeeder::class,
            BookingsSeeder::class,
            CategoriesSeeder::class,
            ProductsSeeder::class,
            OrdersSeeder::class,
            OrderItemsSeeder::class,
            BroomingServicesSeeder::class,
            BroomingsSeeder::class,
            // RatingsSeeder::class,
            PostsSeeder::class,
            RescueAnimalsSeeder::class,
            EventsSeeder::class,
            SubscriptionsSeeder::class,
            // AreasTableSeeder::class,
            DriversTableSeeder::class
        ]);
    }
}
