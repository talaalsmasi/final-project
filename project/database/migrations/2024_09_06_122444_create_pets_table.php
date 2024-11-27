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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // مالك الحيوان
            $table->string('name');
            $table->string('breed')->nullable();
            $table->string('gender')->nullable();
            $table->date('birthday')->nullable(); // تاريخ الميلاد لتذكير المستخدم
            $table->string('image')->nullable();
            $table->foreignId('animal_type_id')->nullable()->constrained('animal_types')->onDelete('cascade'); // نوع الحيوان
            $table->date('last_vaccination_date')->nullable(); // آخر تاريخ للتطعيم
            $table->boolean('is_rescue')->default(false); // للتحديد إذا كان الحيوان ضمن حيوانات الإنقاذ
            $table->decimal('total_required_amount', 10, 2)->nullable(); // المبلغ المطلوب للتبرع
            $table->decimal('current_donated_amount', 10, 2)->default(0); // المبلغ الذي تم التبرع به
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
