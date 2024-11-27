<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event; // تأكد من وجود الموديل
use Carbon\Carbon;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // إضافة بيانات تجريبية للأحداث
        Event::insert([
            [
                'title' => 'Pet Dental Health',
                'description' => 'Join us for a comprehensive session on pet dental care!
In this event, experts will share essential tips and knowledge on maintaining your pet’s dental hygiene, preventing common dental issues, and understanding the importance of regular check-ups. Representatives from top pet brands will be present, distributing free samples of their dental care products and offering personalized guidance on selecting the right product for your pet.',
                'event_date' => '2024-12-12',
                'event_time' => '10:00:00',
                'capacity' => 50,
                'registered_count' => 20,
                'image' => 'img/events/event1.jpg', // مسار الصورة
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Pet Fur Workshop',
                'image' => 'img/events/event2.jpg',
                'description' => 'Learn how to keep your pet’s coat shiny and healthy!
At this event, veterinarians and grooming specialists will provide insights on how to care for your pet’s fur, from proper brushing techniques to diet tips that enhance coat quality. You’ll also get to try free samples of fur-care products provided by leading brands, with professionals available to help you pick the best products for your furry friend.',
                'capacity' => 50,
                'registered_count' => 50, // السعة مكتملة
                'event_date' => Carbon::create('2024', '12', '15'),
                'event_time' => '10:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Understanding Your Pet',
                'image' => 'img/events/event3.jpg',
                'description' => 'Improve your bond and communication with your pet!
This workshop is perfect for pet owners who want to better understand their pets’ needs and behavior. Trainers and behaviorists will be on hand to share tips on handling pets gently and building trust. Free product samples from various brands will be available, and representatives will help you find the best tools and treats for strengthening your connection with your pet.',
                'capacity' => 100,
                'registered_count' => 100, // السعة مكتملة
                'event_date' => Carbon::create('2024', '11', '25'),
                'event_time' => '18:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Positive pet Behavior',
                'description' => 'Enhance your pet’s behavior with positive reinforcement techniques!
In this event, certified pet trainers will demonstrate effective ways to encourage good behavior in pets. From basic commands to reducing anxiety, this session covers it all. Attendees will receive free product samples from partnering brands, including treats and training tools, with experts available to help choose the best options for your pet’s training needs.',
                'event_date' => '2024-12-03',
                'event_time' => '18:00:00',
                'capacity' => 100,
                'registered_count' => 60,
                'image' => 'img/events/event4.jpg', // مسار الصورة
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // يمكنك إضافة المزيد من الأحداث بهذه الطريقة

            [
                'title' => 'Balanced Diets',
                'description' => 'Discover the importance of a balanced diet for your pet!
This event will focus on creating balanced meal plans tailored to your pet’s needs, featuring talks by veterinary nutritionists who will discuss food selection, portion control, and special dietary requirements. Several pet food companies will be there, offering free samples and providing advice on the best products to keep your pet healthy and happy.

',
                'event_date' => '2024-11-01',
                'event_time' => '18:00:00',
                'capacity' => 100,
                'registered_count' => 60,
                'image' => 'img/events/event5.jpg', // مسار الصورة
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'title' => 'Active Pets, Happy Pets',
                'description' => 'Learn how to keep your pet active and healthy!
In this session, pet trainers and veterinarians will explain the benefits of regular exercise for pets and suggest activities to improve mobility and energy levels. Attendees can try out various pet fitness products, with brand representatives on hand to offer guidance and provide free product samples to help kickstart an active lifestyle for your pet.',
                'event_date' => '2024-12-10',
                'event_time' => '18:00:00',
                'capacity' => 100,
                'registered_count' => 60,
                'image' => 'img/events/event6.jpg', // مسار الصورة
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'title' => 'Senior Pet Care',
                'description' => 'Support your pet in their senior years with expert advice on aging gracefully!
This event focuses on the unique needs of senior pets, covering topics like joint health, cognitive function, and diet adjustments. Experts will be available to provide tips and answer questions. You’ll also have access to free samples of senior-friendly products, and company representatives will help you choose the best options for your aging companion.',
                'event_date' => '2024-12-07',
                'event_time' => '18:00:00',
                'capacity' => 100,
                'registered_count' => 60,
                'image' => 'img/events/event7.jpg', // مسار الصورة
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
