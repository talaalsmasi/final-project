<?php
namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\About;
use Illuminate\Validation\Rule;


class DrInfoController extends Controller
{
    public function show()
    {
        $doctor = Auth::user();
        $about = $doctor->about;

        return view('doctor.info.show', compact('doctor', 'about'));
    }

    public function edit()
    {
        $doctor = Auth::user();
        $about = $doctor->about;

        return view('doctor.info.edit', compact('doctor', 'about'));
    }

    public function update(Request $request)
    {
        $doctor = Auth::user();

        // التحقق من صحة البيانات المدخلة
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($doctor->id), // استثناء البريد الإلكتروني الحالي من التحقق
            ],
            'phone' => ['required', 'regex:/^07\d{8}$/'], // تحقق من أن رقم الهاتف يبدأ بـ "07" ويتألف من 10 أرقام
            'about' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // تحديث المعلومات الشخصية للطبيب
        $doctor->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
        ]);

        // تحديث "عن الطبيب"
        if ($doctor->doctor) {
            $doctor->doctor->update(['about' => $validatedData['about']]);
        } else {
            $doctor->doctor()->create(['about' => $validatedData['about']]);
        }

        // معالجة الصورة الشخصية إذا تم رفع صورة جديدة
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if (!empty($doctor->image) && file_exists(public_path($doctor->image))) {
                unlink(public_path($doctor->image));
            }

            // تخزين الصورة الجديدة في المسار public/img/doctors
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('img/doctors'), $imageName);

            // تحديث مسار الصورة في قاعدة البيانات
            $doctor->update(['image' => 'img/doctors/' . $imageName]);
        }

        return redirect()->route('doctor.info')->with('success', 'Information updated successfully.');
    }

}


