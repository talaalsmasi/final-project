<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('taxi_requests', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('driver_id')->constrained('drivers')->onDelete('cascade');
        $table->enum('status', ['pending', 'approved', 'completed'])->default('pending');
        $table->string('trip_type')->default('one_way'); // نوع الرحلة (وجهة أو وجهتين)
        $table->decimal('price', 8, 2); // إضافة عمود السعر مباشرة هنا
        $table->timestamps();
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxi_requests');
    }
};
