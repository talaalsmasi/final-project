<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalSubscription extends Model
{
    use HasFactory;

    // الحقول القابلة للتعبئة
    protected $fillable = [
        'subscription_id', // نوع الاشتراك
        'pet_id',          // الحيوان المشترك
        'month',           // شهر الاشتراك
        'week_number',     // رقم الأسبوع في الشهر
        'day',             // اليوم (0 = الأحد، 2 = الثلاثاء، 4 = الخميس)
        'session_time',    // وقت الجلسة
    ];

    /**
     * العلاقة مع الاشتراك (Subscription)
     */
    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    /**
     * العلاقة مع الحيوان الأليف (Pet)
     */
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }
}
