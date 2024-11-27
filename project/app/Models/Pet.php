<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    public $timestamps = false; // تعطيل timestamps
    protected $fillable = [
        'user_id', 'name', 'breed','gender', 'birthday', 'image', 'animal_type_id',
        'last_vaccination_date', 'is_rescue', 'total_required_amount', 'current_donated_amount'
    ];

    // العلاقات
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function animalType()
    {
        return $this->belongsTo(AnimalType::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    public function bookings()
{
    return $this->hasMany(Booking::class);
}
public function scopeOwnedByAdmin($query)
{
    // نفترض أن دور الأدمن له role_id = 1
    return $query->whereHas('user', function ($q) {
        $q->where('role_id', 1); // نفترض أن 1 هو دور الأدمن
    });
}
public function broomings() {
    return $this->hasMany(Brooming::class);
}

public function subscriptions()
{
    return $this->hasMany(AnimalSubscription::class, 'pet_id');
}


}
