<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;

class APetsForAdoptionController extends Controller
{
    // عرض جميع الحيوانات المتاحة للتبني
    public function index(Request $request)
    {
        $pets = Pet::whereHas('user', function ($query) {
            $query->where('role_id', 1); // فقط المستخدمين الذين لديهم role_id = 1
        })->get();

        return view('Admin.petsForAdoption.index', compact('pets'));
    }

    // عرض نموذج إضافة حيوان جديد للتبني
    public function create()
    {
        return view('Admin.petsForAdoptions.create');
    }

    // تخزين بيانات الحيوان الجديد
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'birthday' => 'required|date',
            'animal_type_id' => 'required|exists:animal_types,id',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // حفظ الصورة
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('pets', 'public');
        }

        Pet::create($data);

        return redirect()->route('admin.petsForAdoption.index')->with('success', 'Pet added successfully.');
    }

    // عرض تفاصيل الحيوان
    public function show(Pet $pet)
    {
        return view('Admin.adoptions.show', compact('pet'));
    }

    // عرض نموذج تعديل الحيوان
    public function edit(Pet $pet)
    {
        return view('Admin.adoptions.edit', compact('pet'));
    }

    // تحديث بيانات الحيوان
    public function update(Request $request, Pet $pet)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'birthday' => 'required|date',
            'animal_type_id' => 'required|exists:animal_types,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // تحديث الصورة إذا تم رفع صورة جديدة
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('pets', 'public');
        }

        $pet->update($data);

        return redirect()->route('admin.petsForAdoption.index')->with('success', 'Pet updated successfully.');
    }

    // حذف الحيوان
    public function destroy(Pet $pet)
    {
        $pet->delete();
        return redirect()->route('admin.petsForAdoption.index')->with('success', 'Pet deleted successfully.');
    }
}
