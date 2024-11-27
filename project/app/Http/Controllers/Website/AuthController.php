<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // دالة عرض نموذج التسجيل
    public function showRegisterForm()
    {
        return view('registration.signup');
    }


    public function signup(Request $request)
    {
        // تحقق من صحة البيانات مع القيود الجديدة
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'regex:/^\S+\s\S+$/'], // تحقق من أن الاسم يحتوي على مقطعين على الأقل
'email' => [
    'required',
    'string',
    'email',
    'max:255',
    'unique:users', // تحقق من أن الإيميل غير موجود مسبقًا
    'regex:/^[^@]+@[^@]+\.[^@]+$/', // تحقق من أن الإيميل يحتوي على نقطة
],
            'phone' => ['nullable', 'string', 'regex:/^07\d{8}$/'], // تحقق من أن الهاتف يتكون من 10 خانات ويبدأ بـ 07
            'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*[0-9]).+$/'], // كلمة المرور تحتوي على 8 خانات على الأقل ورقم واحد على الأقل
            'image' => 'nullable'    ], [
            // رسائل خطأ مخصصة
            'name.regex' => 'The name must contain at least two words.',
            'phone.regex' => 'The phone number must be 10 digits long and start with 07.',
            'password.regex' => 'The password must contain at least one number.',
            'image.mimes' => 'The image must be a file of type: jpg, jpeg, png, gif.',
            'image.max' => 'The image size must not exceed 2MB.'
        ]);

        // التعامل مع تحميل الصورة
        if ($request->hasFile('image')) {
            // الحصول على اسم الملف الأصلي مع امتداد الصورة وتوليد اسم فريد
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();

            // نقل الصورة إلى مجلد التخزين (public/img/users)
            $request->file('image')->move(public_path('img/users'), $imageName);

            // حفظ مسار الصورة في قاعدة البيانات
            $validatedData['image'] = 'img/users/' . $imageName;
        }

        // تشفير كلمة المرور
        $validatedData['password'] = bcrypt($validatedData['password']);

        // إضافة role_id بشكل افتراضي (مثلاً تعيينه كـ 2 ليكون مستخدم عادي)
        $validatedData['role_id'] = 2;

        // إنشاء مستخدم جديد
        User::create($validatedData);

        // إعادة توجيه المستخدم إلى صفحة تسجيل الدخول مع رسالة نجاح
        return redirect()->route('login')->with('success', 'User registered successfully. Please login.');
    }






    // دالة عرض نموذج تسجيل الدخول
    public function showLoginForm()
    {
        return view('registration.login');
    }

    // دالة معالجة تسجيل الدخول
    // public function login(Request $request)
    // {
    //     // تحقق من صحة بيانات تسجيل الدخول
    //     $credentials = $request->validate([
    //         'email' => ['required', 'string', 'email'],
    //         'password' => ['required', 'string'],
    //     ]);

    //     // محاولة تسجيل الدخول
    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();
    //         return redirect()->intended('/')->with('success', 'Login successful');
    //     }

    //     return back()->withErrors([
    //         'email' => 'The provided credentials do not match our records.',
    //     ])->onlyInput('email');
    // }

    public function login(Request $request)
{
    // تحقق من صحة بيانات تسجيل الدخول
    $credentials = $request->validate([
        'email' => ['required', 'string', 'email'],
        'password' => ['required', 'string'],
    ]);

    // محاولة تسجيل الدخول
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // التحقق من دور المستخدم وتوجيهه للصفحة المناسبة
        if (auth()->user()->role_id == 1) {
            // المستخدم هو Admin، قم بإعادة توجيهه إلى لوحة التحكم الإدارية
            return redirect()->route('admin.dashboard.index')->with('success', 'Admin login successful');
        } elseif (auth()->user()->role_id == 2) {
            // المستخدم هو مستخدم عادي، قم بإعادة توجيهه إلى الصفحة العادية
            return redirect()->intended('/')->with('success', 'Login successful');
        } elseif (auth()->user()->role_id == 3) {
            // المستخدم هو طبيب، قم بإعادة توجيهه إلى لوحة تحكم الطبيب
            return redirect()->route('doctor.info')->with('success', 'Doctor login successful');
        } elseif (auth()->user()->role_id == 4) {
            // المستخدم هو سائق، قم بإعادة توجيهه إلى لوحة تحكم السائق
            return redirect()->route('driver.info')->with('success', 'Driver login successful');
        }
    }


    // إذا فشل تسجيل الدخول
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
}

    // دالة تسجيل الخروج
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logged out successfully');
    }
}
