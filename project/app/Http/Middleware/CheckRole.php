<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role_id)
    {
        // التحقق من تسجيل الدخول وامتلاك المستخدم للدور المطلوب
        if (!Auth::check() || auth()->user()->role_id != $role_id) {
            Auth::logout(); // تسجيل خروج المستخدم غير المصرح له
            return redirect('/login')->with('error', 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}

