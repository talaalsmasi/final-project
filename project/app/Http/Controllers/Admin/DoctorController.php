<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        // استرجاع جميع الأطباء مع المستخدمين المرتبطين بهم
        $doctors = Doctor::with('user')->get();
        return view('Admin.doctors.index', compact('doctors'));
    }

    public function create()
    {
        // استرجاع جميع المستخدمين لاختيار الطبيب من بينهم
        $users = User::all();
        return view('Admin.doctors.create', compact('users'));
    }

    public function store(Request $request)
{
    // طباعة البيانات للتحقق منها
    // dd($request->all());

    $data = $request->validate([
        'user_id' => 'required|exists:users,id', // التأكد من وجود المستخدم
        'about' => 'required|string|max:255',
    ]);

    // إنشاء الطبيب مع ربطه بالمستخدم
    Doctor::create([
        'user_id' => $data['user_id'],
        'about' => $data['about'],
    ]);

    return redirect()->route('admin.doctors.index')->with('success', 'Doctor created successfully.');
}


    public function show($id)
    {
        // عرض تفاصيل الطبيب مع معلومات المستخدم المرتبط به
        $doctor = Doctor::with('user')->findOrFail($id);
        return view('Admin.doctors.show', compact('doctor'));
    }

    public function edit($id)
    {
        // استرجاع الطبيب والمستخدمين لتحرير البيانات
        $doctor = Doctor::findOrFail($id);
        $users = User::all(); // المستخدمين لاختيار المستخدم المرتبط بالطبيب
        return view('Admin.doctors.edit', compact('doctor', 'users'));
    }

    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);

        $data = $request->validate([
            'user_id' => 'required|exists:users,id', // التأكد من وجود المستخدم
            'about' => 'required|string|max:255',
        ]);

        // تحديث بيانات الطبيب
        $doctor->update($data);

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor updated successfully.');
    }

    public function destroy($id)
    {
        // حذف الطبيب
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor deleted successfully.');
    }
}

