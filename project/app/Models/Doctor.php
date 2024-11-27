<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    public $timestamps = false; // تعطيل timestamps
    protected $fillable = ['name', 'about' , 'user_id']; // الحقول التي يمكن تعبئتها


    // العلاقات
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    public function user()
{
    return $this->belongsTo(User::class);
}

}

