<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // صاحب الموعد
            $table->foreignId('pet_id')->constrained('pets')->onDelete('cascade'); // الحيوان الأليف
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade'); // الطبيب
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade'); // الخدمة المطلوبة
            $table->date('appointment_date');
            $table->string(column: 'appointment_time');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // حالة الموعد
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
