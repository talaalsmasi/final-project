<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brooming extends Model
{
    use HasFactory;

    // الحقول التي يمكن تعبئتها بشكل مباشر
    protected $fillable = [
        'user_id',
        'pet_id',
        'service_id',
        'appointment_date',
        'appointment_time',
        'status',
    ];

    // ربط الحجز بالمستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ربط الحجز بالحيوان الأليف
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    // ربط الحجز بالخدمة
    public function service()
    {
        return $this->belongsTo(BroomingService::class);
    }
}
