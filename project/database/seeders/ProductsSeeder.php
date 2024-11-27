<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            // Food Products
            ['category_id' => 1, 'name' => 'Premium Dog Food', 'description' => 'High-quality dog food for all breeds.', 'price' => 25.99, 'stock_quantity' => 50, 'image' => 'img/products/product1.jpg'],
            ['category_id' => 1, 'name' => 'Organic Cat Food', 'description' => 'Made with organic ingredients for your cat.', 'price' => 22.49, 'stock_quantity' => 30, 'image' => 'img/products/product2.jpg'],
            ['category_id' => 1, 'name' => 'Bird Seed Mix', 'description' => 'Nutritious seed mix for all types of birds.', 'price' => 15.99, 'stock_quantity' => 100, 'image' => 'img/products/product3.jpg'],
            ['category_id' => 1, 'name' => 'Fish Flakes', 'description' => 'Quality flakes for a healthy diet for fish.', 'price' => 10.99, 'stock_quantity' => 75, 'image' => 'img/products/product4.jpg'],

            // Toys Products
            ['category_id' => 2, 'name' => 'Rubber Bone Toy', 'description' => 'Durable rubber bone for dogs.', 'price' => 9.99, 'stock_quantity' => 60, 'image' => 'img/products/product5.jpg'],
            ['category_id' => 2, 'name' => 'Catnip Mouse', 'description' => 'Interactive cat toy filled with catnip.', 'price' => 7.49, 'stock_quantity' => 80, 'image' => 'img/products/product6.jpg'],
            ['category_id' => 2, 'name' => 'Squeaky Duck Toy', 'description' => 'Fun squeaky toy for dogs.', 'price' => 11.99, 'stock_quantity' => 40, 'image' => 'img/products/product7.jpg'],
            ['category_id' => 2, 'name' => 'Interactive Feather Wand', 'description' => 'Engaging wand toy for cats.', 'price' => 8.99, 'stock_quantity' => 50, 'image' => 'img/products/product8.jpg'],

            // Hygiene Products
            ['category_id' => 3, 'name' => 'Pet Shampoo', 'description' => 'Gentle shampoo for all pet types.', 'price' => 12.99, 'stock_quantity' => 35, 'image' => 'img/products/product9.jpg'],
            ['category_id' => 3, 'name' => 'Flea Treatment', 'description' => 'Effective flea treatment for dogs and cats.', 'price' => 19.99, 'stock_quantity' => 20, 'image' => 'img/products/product10.jpg'],
            ['category_id' => 3, 'name' => 'Ear Cleaner', 'description' => 'Safe cleaner for pet ears.', 'price' => 5.99, 'stock_quantity' => 60, 'image' => 'img/products/product11.jpg'],
            ['category_id' => 3, 'name' => 'Pet Toothbrush', 'description' => 'Soft toothbrush for pets.', 'price' => 3.49, 'stock_quantity' => 100, 'image' => 'img/products/product12.jpg'],

            // Accessories Products
            ['category_id' => 5, 'name' => 'Leather Dog Collar', 'description' => 'Stylish leather collar for dogs.', 'price' => 15.99, 'stock_quantity' => 45, 'image' => 'img/products/product13.jpg'],
            ['category_id' => 5, 'name' => 'Cat Harness', 'description' => 'Adjustable harness for cats.', 'price' => 12.49, 'stock_quantity' => 30, 'image' => 'img/products/product14.jpg'],
            ['category_id' => 5, 'name' => 'Travel Pet Carrier', 'description' => 'Comfortable carrier for travel.', 'price' => 29.99, 'stock_quantity' => 25, 'image' => 'img/products/product15.jpg'],
            ['category_id' => 5, 'name' => 'Pet Water Bottle', 'description' => 'Portable water bottle for pets.', 'price' => 10.99, 'stock_quantity' => 50, 'image' => 'img/products/product16.jpg'],

            // Health Care Products
            ['category_id' => 4, 'name' => 'Joint Care Supplements', 'description' => 'Supports joint health in pets.', 'price' => 19.99, 'stock_quantity' => 40, 'image' => 'img/products/product17.jpg'],
            ['category_id' => 4, 'name' => 'Multivitamins for Dogs', 'description' => 'Complete multivitamin for dogs.', 'price' => 22.99, 'stock_quantity' => 30, 'image' => 'img/products/product18.jpg'],
            ['category_id' => 4, 'name' => 'Flea & Tick Prevention', 'description' => 'Prevents fleas and ticks effectively.', 'price' => 24.99, 'stock_quantity' => 25, 'image' => 'img/products/product19.jpg'],
            ['category_id' => 4, 'name' => 'Digestive Aid', 'description' => 'Helps support digestive health.', 'price' => 15.99, 'stock_quantity' => 35, 'image' => 'img/products/product20.jpg'],

            // Training Equipment Products
            ['category_id' => 9, 'name' => 'Training Clicker', 'description' => 'Helps with positive reinforcement training.', 'price' => 5.99, 'stock_quantity' => 50, 'image' => 'img/products/product21.jpg'],
            ['category_id' => 9, 'name' => 'Dog Training Pads', 'description' => 'Absorbent pads for potty training.', 'price' => 17.99, 'stock_quantity' => 30, 'image' => 'img/products/product22.jpg'],
            ['category_id' => 9, 'name' => 'Pet Training Book', 'description' => 'Guide for training pets effectively.', 'price' => 12.99, 'stock_quantity' => 20, 'image' => 'img/products/product23.jpg'],
            ['category_id' => 9, 'name' => 'Agility Training Set', 'description' => 'Complete agility training set for dogs.', 'price' => 49.99, 'stock_quantity' => 10, 'image' => 'img/products/product24.jpg'],

            // Grooming Supplies Products
            ['category_id' => 7, 'name' => 'Pet Grooming Kit', 'description' => 'Complete grooming kit for pets.', 'price' => 29.99, 'stock_quantity' => 15, 'image' => 'img/products/product25.jpg'],
            ['category_id' => 7, 'name' => 'Fur Brush', 'description' => 'Brush for removing loose fur.', 'price' => 8.99, 'stock_quantity' => 25, 'image' => 'img/products/product26.jpg'],
            ['category_id' => 7, 'name' => 'Nail Clipper', 'description' => 'Safe nail clipper for pets.', 'price' => 6.99, 'stock_quantity' => 40, 'image' => 'img/products/product27.jpg'],
            ['category_id' => 7, 'name' => 'Pet Bathing Gloves', 'description' => 'Gloves for easy bathing.', 'price' => 12.49, 'stock_quantity' => 30, 'image' => 'img/products/product28.jpg'],

            // Beds Products
            ['category_id' => 6, 'name' => 'Orthopedic Dog Bed', 'description' => 'Comfortable bed for dogs.', 'price' => 39.99, 'stock_quantity' => 20, 'image' => 'img/products/product29.jpg'],
            ['category_id' => 6, 'name' => 'Cat Bed', 'description' => 'Soft bed for cats.', 'price' => 29.99, 'stock_quantity' => 25, 'image' => 'img/products/product30.jpg'],
            ['category_id' => 6, 'name' => 'Pet Mat', 'description' => 'Durable mat for pets.', 'price' => 19.99, 'stock_quantity' => 30, 'image' => 'img/products/product31.jpg'],
            ['category_id' => 6, 'name' => 'Heated Pet Bed', 'description' => 'Heated bed for extra warmth.', 'price' => 49.99, 'stock_quantity' => 15, 'image' => 'img/products/product32.jpg'],

            // Clothing Products
            ['category_id' => 10, 'name' => 'Dog Sweater', 'description' => 'Warm sweater for dogs.', 'price' => 19.99, 'stock_quantity' => 30, 'image' => 'img/products/product33.jpg'],
            ['category_id' => 10, 'name' => 'Cat Costume', 'description' => 'Fun costume for cats.', 'price' => 15.99, 'stock_quantity' => 25, 'image' => 'img/products/product34.jpg'],
            ['category_id' => 10, 'name' => 'Pet Raincoat', 'description' => 'Raincoat to keep pets dry.', 'price' => 22.49, 'stock_quantity' => 20, 'image' => 'img/products/product35.jpg'],
            ['category_id' => 10, 'name' => 'Dog Boots', 'description' => 'Protective boots for dogs.', 'price' => 24.99, 'stock_quantity' => 15, 'image' => 'img/products/product36.jpg'],

            // Transport Products
            ['category_id' => 8, 'name' => 'Pet Carrier Bag', 'description' => 'Comfortable carrier for travel.', 'price' => 29.99, 'stock_quantity' => 10, 'image' => 'img/products/product37.jpg'],
            ['category_id' => 8, 'name' => 'Dog Seat Cover', 'description' => 'Protective cover for car seats.', 'price' => 19.99, 'stock_quantity' => 15, 'image' => 'img/products/product38.jpg'],
            ['category_id' => 8, 'name' => 'Pet Stroller', 'description' => 'Stroller for pets to enjoy outdoor walks.', 'price' => 59.99, 'stock_quantity' => 8, 'image' => 'img/products/product39.jpg'],
            ['category_id' => 8, 'name' => 'Portable Water Bottle', 'description' => 'Convenient water bottle for travel.', 'price' => 12.99, 'stock_quantity' => 30, 'image' => 'img/products/product40.jpg'],
        ]);
    }
}
