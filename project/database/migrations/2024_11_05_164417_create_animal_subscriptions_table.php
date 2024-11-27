<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('animal_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscription_id')->constrained('subscriptions')->onDelete('cascade'); // نوع الاشتراك
            $table->foreignId('pet_id')->constrained('pets')->onDelete('cascade'); // الحيوان المشترك
            $table->unsignedTinyInteger('month')->comment('Month of the subscription'); // شهر الاشتراك
            $table->unsignedTinyInteger('week_number')->comment('Week number within the month'); // رقم الأسبوع داخل الشهر
            $table->string('session_time')->comment('Time of the session'); // وقت الجلسة
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('animal_subscriptions');
    }
};
