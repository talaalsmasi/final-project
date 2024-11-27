<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\User;
use App\Models\Service;
use App\Models\AnimalType;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::with('user', 'appointments.service','animalType')->get();
        return view('Admin.pets.index', compact('pets'));
    }

    public function create()
{
    $users = User::all();
    $animalTypes = AnimalType::all(); // تأكد من استخدام plural

    return view('Admin.pets.create', compact('users', 'animalTypes')); // تعديل المتغير هنا
}

public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'breed' => 'nullable|string|max:255',
        'birthday' => 'required|date|before_or_equal:today',
        'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg',
        'user_id' => 'required|exists:users,id',
        'gender' => 'required|string',
        'animal_type_id' => 'required|exists:animal_types,id',
    ]);

    if ($request->hasFile('image')) {
        // احصل على اسم الملف الأصلي وقم بتوليد اسم فريد
        $imageName = time() . '_' . $request->file('image')->getClientOriginalName();

        // قم بنقل الصورة إلى مجلد التخزين (public/img/pets)
        $request->file('image')->move(public_path('img/pets'), $imageName);

        // حفظ المسار بشكل صحيح في قاعدة البيانات
        $data['image'] = 'img/pets/' . $imageName; // تم تعديل $validatedData إلى $data
    }

    Pet::create($data);
    return redirect()->route('admin.pets.index')->with('success', 'Pet created successfully.');
}


    public function show(Pet $pet)
    {
        $pet->load('user', 'appointments.service');
        return view('Admin.pets.show', compact('pet'));
    }

    public function edit($id)
{
    $pet = Pet::findOrFail($id);
    $users = User::all(); // استرجاع المستخدمين (المالكين)
    $animalTypes = AnimalType::all(); // استرجاع الأنواع الحيوانية

    return view('Admin.pets.edit', compact('pet', 'users', 'animalTypes')); // تمرير المتغيرات إلى view
}

public function update(Request $request, Pet $pet)
{
    // التحقق من البيانات
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'breed' => 'nullable|string|max:255',
        'birthday' => 'required|date|before_or_equal:today',
        'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg',
        'user_id' => 'required|exists:users,id',
        'animal_type_id' => 'required|exists:animal_types,id',
    ]);

    // التعامل مع الصورة إذا تم تحميلها
    if ($request->hasFile('image')) {
        // حذف الصورة القديمة إن وجدت
        if (!empty($user->image) && file_exists(public_path($pet->image))) {
            unlink(public_path($pet->image));
        }

        // تخزين الصورة الجديدة في public/img/users
        $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('img/users'), $imageName);

        // تخزين مسار الصورة في قاعدة البيانات
        $data['image'] = 'img/users/' . $imageName;
    }

    // تحديث بيانات الحيوان الأليف
    $pet->update($data);

    return redirect()->route('admin.pets.index')->with('success', 'Pet updated successfully.');
}


    public function destroy($id)
{
    $pet = Pet::findOrFail($id);
    $pet->delete();

    return redirect()->route('admin.pets.index')->with('success', 'Pet deleted successfully.');
}

}
