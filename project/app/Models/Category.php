<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false; // تعطيل timestamps
    protected $fillable = ['name', 'description']; // الحقول التي يمكن تعبئتها


    // العلاقات
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

