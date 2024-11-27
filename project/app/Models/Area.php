<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'one_way_price', 'two_way_price'];

    // علاقة مع السائقين
    public function drivers()
    {
        return $this->hasMany(Driver::class);
    }

    // علاقة مع طلبات التاكسي
    public function taxiRequests()
    {
        return $this->hasMany(TaxiRequest::class);
    }
}
