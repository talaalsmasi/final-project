<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    // تحديد اسم الجدول (إذا لم يكن مطابقاً لاسم الموديل)
    protected $table = 'donations';

    // تحديد الحقول القابلة للملء
    protected $fillable = [
        'user_id',
        'rescue_animal_id',
        'amount',
    ];

    // العلاقة مع المستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // العلاقة مع الحيوان المحتاج للتبرع
    public function rescueAnimal()
    {
        return $this->belongsTo(RescueAnimal::class);
    }
}
