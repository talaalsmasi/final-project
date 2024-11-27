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
        Schema::create('adoptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // المستخدم الذي يقدم الطلب
            $table->foreignId('pet_id')->constrained('pets')->onDelete('cascade'); // الحيوان المطلوب تبنيه
            $table->text('reason'); // سبب التبني
            $table->boolean('can_feed'); // هل يمكنه توفير الطعام؟
            $table->boolean('can_treat'); // هل يمكنه معالجة الحيوان؟
            $table->boolean('has_other_pets'); // هل لديه حيوانات أليفة أخرى؟
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // حالة الطلب
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adoptions');
    }
};
