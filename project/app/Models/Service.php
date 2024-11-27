<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    public $timestamps = false; // تعطيل timestamps
    protected $fillable = ['name', 'description', 'price']; // الحقول التي يمكن تعبئتها


    // العلاقات
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}

