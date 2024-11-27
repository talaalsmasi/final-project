<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = [
            [
                'user_id' => 1,
                'total_price' => 100.00,
                'status' => 'pending',
                'payment_method' => 'Visa',
                'address' => 'Amman, Jordan',
            ],
            [
                'user_id' => 2,
                'total_price' => 150.00,
                'status' => 'completed',
                'payment_method' => 'Cash',
                'address' => 'Irbid, Jordan',
            ],
            [
                'user_id' => 3,
                'total_price' => 200.00,
                'status' => 'pending',
                'payment_method' => 'Visa',
                'address' => 'Zarqa, Jordan',
            ],
            [
                'user_id' => 4,
                'total_price' => 120.00,
                'status' => 'completed',
                'payment_method' => 'Cash',
                'address' => 'Aqaba, Jordan',
            ],
            [
                'user_id' => 5,
                'total_price' => 90.00,
                'status' => 'pending',
                'payment_method' => 'Visa',
                'address' => 'Mafraq, Jordan',
            ],
            [
                'user_id' => 1,
                'total_price' => 250.00,
                'status' => 'completed',
                'payment_method' => 'Cash',
                'address' => 'Karak, Jordan',
            ],
            [
                'user_id' => 2,
                'total_price' => 300.00,
                'status' => 'pending',
                'payment_method' => 'Visa',
                'address' => 'Ajloun, Jordan',
            ],
            [
                'user_id' => 3,
                'total_price' => 75.00,
                'status' => 'completed',
                'payment_method' => 'Cash',
                'address' => 'Madaba, Jordan',
            ],
            [
                'user_id' => 4,
                'total_price' => 60.00,
                'status' => 'pending',
                'payment_method' => 'Visa',
                'address' => 'Tafila, Jordan',
            ],
            [
                'user_id' => 5,
                'total_price' => 45.00,
                'status' => 'completed',
                'payment_method' => 'Cash',
                'address' => 'Jerash, Jordan',
            ],
            // Add more orders as needed
        ];

        DB::table('orders')->insert($orders);
    }
}
