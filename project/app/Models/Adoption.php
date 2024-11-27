<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adoption extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pet_id',
        'reason',
        'can_feed',
        'can_treat',
        'has_other_pets',
        'status'
    ];

    // علاقة الربط بين طلب التبني والحيوان
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    // علاقة الربط بين طلب التبني والمستخدم الذي قدم الطلب
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

