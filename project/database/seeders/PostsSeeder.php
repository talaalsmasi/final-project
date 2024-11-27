<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            [
                'user_id' =>6,
                'title' => 'The Joy of Pets',
                'image' => 'img/posts/post1.jpg',
                'content' => 'Pets bring so much joy, love, and companionship into our lives. Their loyalty, playfulness, and unique personalities brighten our days and offer comfort through every moment.',
                'likes' => 12,
            ],
            [
                'user_id' => 4,
                'title' => 'Our Clients Await ',
                'image' => 'img/posts/post2.png',
                'content' => 'Our clients are eagerly waiting for their pet’s doctor appointments, ensuring their beloved companions get the best care.',
                'likes' => 20,
            ],
            [
                'user_id' => 5,
                'title' => 'Dogs Love Car Windows',
                'image' => 'img/posts/post3.png',
                'content' => 'There’s something magical about the wind in their fur and the world rushing by as dogs gaze out the car window. ',
                'likes' => 18,
            ],
            [
                'user_id' => 4,
                'title' => 'Pet Dental Care Event ',
                'image' => 'img/posts/post4.jpg',
                'content' => 'Mark your calendars! On December 12th, we’re hosting a special event all about the importance of pet dental care. This is a wonderful opportunity for pet owners and animal lovers to learn about keeping their furry friends’ teeth healthy and strong.',
                'likes' => 5,
            ],
            [
                'user_id' => 5,
                'title' => 'Vet Check-Up Day',
                'image' => 'img/posts/post5.jpg',
                'content' => 'Regular vet check-ups are essential to keep our pets healthy and happy. From routine exams to preventative care, these visits help ensure a long, joyful life for our furry friends. 🐾👩‍⚕️',
                'likes' => 9,
            ],
            [
                'user_id' => 6,
                'title' => 'Balanced Meal Planning',
                'image' => 'img/posts/post6.jpg',
                'content' => 'Taking care of your pet’s diet goes beyond just feeding; it’s about ensuring they receive balanced, nutritious meals tailored to their needs. ',
                'likes' => 7,
            ],
            [
                'user_id' => 4,
                'title' => 'Puppy Meets New Family',
                'image' => 'img/posts/post7.jpg',
                'content' => 'Today marked a beautiful new beginning for our little friend, Bobby, as he met his forever family. After patiently waiting and receiving all the love and care he needed, Bobby finally found a place to call home.',
                'likes' => 15,
            ],
            [
                'user_id' => 4,
                'title' => 'Grooming Moments',
                'image' => 'img/posts/post8.jpg',
                'content' => 'Here’s a snapshot of one of our lovely pets during their grooming session. Grooming isn’t just about cleaning; it’s a moment of comfort and care that enhances the health and beauty of our little friends.',
                'likes' => 14,
            ],
            [
                'user_id' => 5,
                'title' => 'Healthy Fur, Happy Pets',
                'image' => 'img/posts/post9.jpg',
                'content' => 'Keeping your pet’s coat shiny and healthy is more than just grooming  it’s a reflection of their overall well-being! Our hair health products are designed to support soft, shiny fur and a strong, healthy coat.',
                'likes' => 10,
            ],
            [
                'user_id' => 5,
                'title' => 'Treat Time for Your Pets!',
                'image' => 'img/posts/post10.png',
                'content' => 'Our pets deserve the best, and nothing says "good job" or "I love you" like a tasty treat! We’ve stocked up on a variety of delicious, healthy treats that cater to every pet’s taste and dietary needs.',
                'likes' => 8,
            ],
            [
                'user_id' => 6,
                'title' => 'Subscriptions Update',
                'image' => 'img/posts/post11.png',
                'content' => '
Training & Subscriptions Update

Exciting news for pet parents! Our training programs and subscription options are here to help your furry friends learn new skills and stay active. ',
                'likes' => 6,
            ],
            [
                'user_id' => 6,
                'title' => 'Post-bath photo',
                'image' => 'img/posts/post12.jpg',
                'content' => 'Nothing beats the fresh smell of cleanliness as Bondoq reunites with his owner after a thorough bath.',
                'likes' => 11,
            ],
            [
                'user_id' => 4,
                'title' => 'Fluffy Awaits New Family',
                'image' => 'img/posts/post13.jpg',
                'content' => 'Today, we’re sharing the story of Fluffy, a beautiful cat eagerly waiting to find a warm home and a loving family. With her soft fur and sparkling eyes, Fluffy is looking for a family to shower her with the love and care she deserves.',
                'likes' => 4,
            ],
            [
                'user_id' => 5,
                'title' => 'Pre-surgery photo',
                'image' => 'img/posts/post14.jpg',
                'content' => 'Here’s a look at Fluffy getting ready for her big day! Preparations for her operation were carefully done to ensure everything went smoothly. The veterinary team took special care to make sure she was comfortable and calm before going into surgery.',
                'likes' => 5,
            ],
            [
                'user_id' => 6,
                'title' => 'Animals feel.',
                'image' => 'img/posts/post15.jpg',
                'content' => 'Here’s a photo we took to say goodbye to Maggie as his owner leaves for a trip.',
                'likes' => 9,
            ],
        ]);
    }
}

