<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false; // تعطيل timestamps
    protected $fillable = [
        'user_id',
        'total_price',
        'status',
        'payment_method', // Add the payment_method field
        'address',        // Add the address field
    ]; // الحقول التي يمكن تعبئتها


    // العلاقات
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}

