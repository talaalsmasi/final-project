<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BroomingService extends Model
{
    use HasFactory;

    // الحقول التي يمكن تعبئتها بشكل مباشر
    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    // ربط الخدمة بحجوزات التجميل (Brooming)
    public function broomings()
    {
        return $this->hasMany(Brooming::class, 'service_id');
    }
}
