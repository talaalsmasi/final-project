<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'booking_id',
        'appointment_id',
        'Brooming_id',
        'rating',
        'feedback',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function grooming()
    {
        return $this->belongsTo(Brooming::class);
    }
}
