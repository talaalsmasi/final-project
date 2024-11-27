<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RescueAnimal extends Model
{
    use HasFactory;

    protected $fillable = [
        'pet_id',
        'total_required_amount',
        'current_donated_amount',
        'description',
    ];

    // العلاقة مع جدول الحيوانات
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }
}
