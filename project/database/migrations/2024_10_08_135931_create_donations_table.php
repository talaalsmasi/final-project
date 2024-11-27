<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rescue_animal_id')->constrained('rescue_animals')->onDelete('cascade'); // ربط مع جدول rescue_animals
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // ربط مع جدول المستخدمين
            $table->decimal('amount', 10, 2); // مبلغ التبرع
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('donations');
    }
};
