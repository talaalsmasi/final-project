<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false; // تعطيل timestamps
    protected $fillable = ['name'];

    // العلاقات
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
