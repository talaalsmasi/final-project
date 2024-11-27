<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subscription;


class SubscriptionsSeeder extends Seeder
{
    public function run(): void
    {
        // Insert some example subscription types
        Subscription::create([
            'name' => 'Protection and Security Training 🛡️',
            'description' => 'Enhance your pet’s sense of protection and security!
This training is designed for pets that need to develop protective behaviors. Trainers will work on improving command response and building confidence in your pet. Free samples of suitable nutrition products will be available during the event, with experts to help you choose the right products for training.',
            'price' => 50.00,
            'image' => 'img/subscriptions/subs1.jpg'
        ]);

        Subscription::create([
            'name' => 'Basic Obedience Training 🎓',
            'description' => 'Learn the basics to improve your pet’s interactions with its environment!
In basic obedience training, your pet will learn essential commands like "sit," "come," and "stay." This training is crucial for maintaining a balanced and comfortable behavior for your pet and your family. There will be free product samples to aid in training, and consultants will be on hand to help you select the most suitable products..',
            'price' => 40.00,
            'image' => 'img/subscriptions/subs7.jpg'
        ]);

        Subscription::create([
            'name' => 'Agility and Movement Training 🐕‍🦺',
            'description' => 'For active pets who love movement and challenges!
This training focuses on improving fitness and agility for active pets, including obstacles, jumping, and climbing. It helps your pet enjoy daily activities and stay in good physical health. Free samples of products that support these activities will be available, along with guidance from experts to choose the best products.',
            'price' => 30.00,
            'image' => 'img/subscriptions/sub2.jpg'
        ]);

        Subscription::create([
            'name' => 'Social Interaction Training 🐾',
            'description' => 'Make your pet more friendly and social!
In this training, social interaction skills will be reinforced, helping your pet feel more comfortable when interacting with other animals and people. You’ll have the chance to try products that enhance social behavior, with specialists available to offer advice and select the best products.',
            'price' => 60.00,
            'image' => 'img/subscriptions/sub1.jpg'
        ]);

        Subscription::create([
            'name' => 'Stress and Anxiety Management Training 😌',
            'description' => 'Help your pet overcome anxiety and fear!
This training targets pets that experience anxiety or fear. Your pet will be trained on how to relax and adapt to new situations. Get free samples of calming products that help reduce stress, with guidance from experts to help you choose the products that suit your pet’s needs.',
            'price' => 60.00,
            'image' => 'img/subscriptions/subs5.jpg'
        ]);

        Subscription::create([
            'name' => 'Advanced Obedience Training 🚀',
            'description' => 'For obedience pros: take training to the next level!
This training is ideal for pets that have completed basic obedience and are ready for new challenges. It includes learning advanced commands like "wait until I arrive," "search," and "retrieve." Free samples of products that support advanced training will be provided, along with expert guidance to help you choose the best options for your pet.',
            'price' => 60.00,
            'image' => 'img/subscriptions/subs6.jpg'
        ]);

    }

}
