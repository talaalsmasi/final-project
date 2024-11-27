<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orderItems = [
            ['order_id' => 1, 'product_id' => 1, 'quantity' => 2],
            ['order_id' => 1, 'product_id' => 2, 'quantity' => 1],
            ['order_id' => 2, 'product_id' => 1, 'quantity' => 1],
            ['order_id' => 2, 'product_id' => 3, 'quantity' => 4],
            ['order_id' => 3, 'product_id' => 4, 'quantity' => 3],
            ['order_id' => 3, 'product_id' => 5, 'quantity' => 2],
            ['order_id' => 4, 'product_id' => 2, 'quantity' => 1],
            ['order_id' => 5, 'product_id' => 3, 'quantity' => 1],
            ['order_id' => 5, 'product_id' => 6, 'quantity' => 1],
            ['order_id' => 6, 'product_id' => 7, 'quantity' => 2],
            ['order_id' => 7, 'product_id' => 8, 'quantity' => 1],
            ['order_id' => 8, 'product_id' => 9, 'quantity' => 5],
            ['order_id' => 9, 'product_id' => 10, 'quantity' => 3],
            ['order_id' => 10, 'product_id' => 11, 'quantity' => 4],
         
            // Add more items as needed
        ];

        DB::table('order_items')->insert($orderItems);
    }
}
