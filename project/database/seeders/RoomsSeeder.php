<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert([
            [
                'room_name' => 'Paw-some Suite',
                'room_type' => 'normal',
                'price_per_night' => 7.5,
                'status' => 'available',
                'image' => 'img/rooms/room1.jpg',
            ],
            [
                'room_name' => 'Whisker Wonderland',
                'room_type' => 'economy',
                'price_per_night' => 5.00,
                'status' => 'available',
                'image' => 'img/rooms/room2.jpg',
            ],
            [
                'room_name' => 'The Cozy Kennel',
                'room_type' => 'Economy',
                'price_per_night' => 5.00,
                'status' => 'available',
                'image' => 'img/rooms/room3.jpg',
            ],
            [
                'room_name' => 'Furry Friends Executive',
                'room_type' => 'VIP',
                'price_per_night' => 10,
                'status' => 'unavailable',
                'image' => 'img/rooms/room4.jpg',
            ],
            [
                'room_name' => 'Kitty Cuddle Room',
                'room_type' => 'normal',
                'price_per_night' => 7.5,
                'status' => 'available',
                'image' => 'img/rooms/room5.png',
            ],
            [
                'room_name' => 'Barking Good Room',
                'room_type' => 'normal',
                'price_per_night' => 7.5,
                'status' => 'available',
                'image' => 'img/rooms/room6.jpg',
            ],
            [
                'room_name' => 'Tail-Wagging Double',
                'room_type' => 'VIP',
                'price_per_night' => 10,
                'status' => 'available',
                'image' => 'img/rooms/room7.png',
            ],
            [
                'room_name' => 'Pampered Pup Suite',
                'room_type' => 'VIP',
                'price_per_night' => 10,
                'status' => 'unavailable',
                'image' => 'img/rooms/room8.jpg',
            ],
            [
                'room_name' => 'Cuddle Corner',
                'room_type' => 'normal',
                'price_per_night' => 7.5,
                'status' => 'available',
                'image' => 'img/rooms/room9.jpg',
            ],
            [
                'room_name' => 'Meow Manor',
                'room_type' => 'VIP',
                'price_per_night' => 10,
                'status' => 'available',
                'image' => 'img/rooms/room10.jpg',
            ],
        ]);
    }
}
