<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();  // كود الكوبون
            $table->decimal('discount', 8, 2);  // قيمة الخصم
            $table->enum('discount_type', ['percentage', 'fixed']);  // نوع الخصم
            $table->timestamp('expires_at')->nullable();  // تاريخ انتهاء الكوبون
            $table->boolean('is_active')->default(true);  // حالة الكوبون (فعال أو لا)
            $table->timestamps();  // تاريخ الإنشاء والتحديث
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
