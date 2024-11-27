<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnimalType extends Model
{
    public $timestamps = false; // تعطيل timestamps
    protected $fillable = ['type_name']; // الحقول التي يمكن تعبئتها


    // العلاقات
    public function pets()
    {
        return $this->hasMany(Pet::class);
    }
}
