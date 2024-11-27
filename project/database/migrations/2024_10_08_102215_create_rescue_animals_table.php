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
        Schema::create('rescue_animals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pet_id')->constrained('pets')->onDelete('cascade'); // العلاقة مع جدول الحيوانات
            $table->decimal('total_required_amount', 10, 2); // المبلغ المطلوب
            $table->decimal('current_donated_amount', 10, 2)->default(0); // المبلغ الذي تم التبرع به حتى الآن
            $table->text('description')->nullable(); // وصف للحالة أو احتياجات التبرع
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rescue_animals');
    }
};
