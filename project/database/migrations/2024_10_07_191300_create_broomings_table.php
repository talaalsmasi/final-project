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
        Schema::create('broomings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // ربط الحجز بالمستخدم
            $table->foreignId('pet_id')->constrained('pets')->onDelete('cascade');   // ربط الحجز بالحيوان الأليف
            $table->date('appointment_date');
            $table->string('appointment_time');
            $table->foreignId('service_id')->constrained('brooming_services')->onDelete('cascade'); // ربط الحجز بالخدمة
            $table->string('status')->default('pending'); // حالة الحجز
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('broomings');
    }
};
