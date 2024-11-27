<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;


    protected $fillable = ['user_id', 'available'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    // علاقة مع طلبات التاكسي
    public function taxiRequests()
    {
        return $this->hasMany(TaxiRequest::class);
    }
}

