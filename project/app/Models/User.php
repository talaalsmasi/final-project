<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



class User extends Authenticatable

{

    use Notifiable; // لإضافة إشعارات البريد الإلكتروني وغيرها

    public $timestamps = false; // تعطيل timestamps

    protected $fillable = ['name', 'email', 'phone', 'password', 'role_id','image']; // الحقول التي يمكن تعبئتها

    // العلاقات
    public function role()
    {
        return $this->belongsTo(Role::class);
    }


    public function pets()
    {
        return $this->hasMany(Pet::class);
    }
    public function doctor()
{
    return $this->hasOne(Doctor::class);
}

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    public function posts()
{
    return $this->hasMany(Post::class);
}

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function registrations()
{
    return $this->hasMany(EventRegistration::class);
}
public function driver()
{
    return $this->hasOne(Driver::class);
}


}
