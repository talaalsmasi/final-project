<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxiRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'area_id',
        'driver_id',
        'status',
        'trip_type',
        'price'
    ];


    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
