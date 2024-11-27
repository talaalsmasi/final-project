<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('Admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('Admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        // التحقق من البيانات
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => ['required', 'regex:/^07\d{8}$/'],
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        // تشفير كلمة المرور
        $data['password'] = bcrypt($data['password']);

        // التعامل مع تحميل الصورة
        if ($request->hasFile('image')) {
            // الحصول على اسم الملف الأصلي مع امتداد الصورة وتوليد اسم فريد
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();

            // نقل الصورة إلى مجلد التخزين (public/img/users)
            $request->file('image')->move(public_path('img/users'), $imageName);

            // حفظ مسار الصورة في قاعدة البيانات
            $data['image'] = 'img/users/' . $imageName;
        }



        // إنشاء المستخدم
        User::create($data);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('Admin.users.show', compact('user'));
    }

    public function edit($id)
{
    $user = User::findOrFail($id);
    $roles = Role::all();
    return view('Admin.users.edit', compact('user', 'roles'));
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    // التحقق من البيانات
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => [
            'required',
            'string',
            'email',
            'max:255',
            Rule::unique('users')->ignore($user->id), // استثناء البريد الإلكتروني الحالي من التحقق
        ],
        'phone' => ['required', 'regex:/^07\d{8}$/'], // تحقق من أن رقم الهاتف يبدأ بـ "07" ويتألف من 10 أرقام
        'password' => 'nullable|string|min:8|confirmed', // كلمة المرور اختيارية
        'role_id' => 'required|exists:roles,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' // تحقق من الصورة
    ]);

    // إذا تم إدخال كلمة المرور، يتم تشفيرها
    if ($request->filled('password')) {
        $data['password'] = bcrypt($data['password']);
    } else {
        unset($data['password']); // إزالة كلمة المرور من البيانات إذا لم يتم تقديمها
    }

    // التعامل مع الصورة إذا تم تحميلها
    if ($request->hasFile('image')) {
        // حذف الصورة القديمة إن وجدت
        if (!empty($user->image) && file_exists(public_path($user->image))) {
            unlink(public_path($user->image));
        }

        // تخزين الصورة الجديدة في public/img/users
        $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('img/users'), $imageName);

        // تخزين مسار الصورة في قاعدة البيانات
        $data['image'] = 'img/users/' . $imageName;
    }

    // تحديث بيانات المستخدم
    $user->update($data);

    return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
}




    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
