<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    // Fillable fields for mass assignment
    protected $fillable = ['name', 'description', 'price', 'image'];


    // Relationship with AnimalSubscription
    public function animalSubscriptions()
    {
        return $this->hasMany(AnimalSubscription::class);
    }
}
