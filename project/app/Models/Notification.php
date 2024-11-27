<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications'; // تحديد الجدول المخصص للإشعارات
    protected $fillable = ['user_id', 'message', 'is_read'];

    // العلاقة مع المستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // طريقة للتحقق من حالة الإشعار
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }
}

