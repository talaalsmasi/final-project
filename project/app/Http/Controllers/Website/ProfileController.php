<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Rating;
use App\Models\Booking;
use App\Models\TaxiRequest;
use App\Models\Appointment;
use App\Models\Brooming;

use App\Models\Notification;
use Carbon\Carbon;
use App\Models\User;

use App\Models\AnimalType;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // دالة عرض صفحة البروفايل
    public function show()
    {
        // جلب المستخدم الحالي
        $user = Auth::user();
        // جلب الحيوانات الخاصة بالمستخدم
        $pets = $user->pets;

        return view('profile.profile', compact('user', 'pets'));
    }

    // دالة عرض نموذج إضافة حيوان
    public function showAddPetForm()
    {
        $animalTypes = AnimalType::all(); // جلب أنواع الحيوانات
        return view('profile.add-pet', compact('animalTypes'));
    }

    // دالة لإضافة حيوان جديد
    public function storePet(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'breed' => 'nullable|string|max:255',
            'birthday' => 'nullable|date|before_or_equal:today',
            'gender' => 'required|string',
            'animal_type_id' => 'required|exists:animal_types,id',
            'image' => 'nullable|image|max:2048',
        ]);

        // رفع الصورة إذا وُجدت
        if ($request->hasFile('image')) {
            // احصل على اسم الملف الأصلي وقم بتوليد اسم فريد
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();

            // قم بنقل الصورة إلى مجلد التخزين (public/img/pets)
            $request->file('image')->move(public_path('img/pets'), $imageName);

            // حفظ المسار بشكل صحيح في قاعدة البيانات
            $validatedData['image'] = 'img/pets/' . $imageName;
        }

        // ربط الحيوان بالمستخدم
        $pet = new Pet($validatedData);
        $pet->user_id = Auth::id();
        $pet->save();

        return redirect()->route('profile')->with('success', 'Pet added successfully!');
    }


    // دالة عرض نموذج تعديل الحيوان
    public function editPetForm(Pet $pet)
    {
        if (Auth::id() !== $pet->user_id) {
            return redirect()->route('profile')->withErrors('Unauthorized access.');
        }

        $animalTypes = AnimalType::all();
        return view('profile.edit-pet', compact('pet', 'animalTypes'));
    }

    // دالة لتحديث بيانات الحيوان
    public function updatePet(Request $request, Pet $pet)
{
    // التحقق من أن المستخدم الحالي هو مالك الحيوان
    if (Auth::id() !== $pet->user_id) {
        return redirect()->route('profile')->withErrors('Unauthorized access.');
    }

    // التحقق من صحة البيانات
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'breed' => 'nullable|string|max:255',
        'gender' => 'nullable|string|max:255',
        'birthday' => 'nullable|date',
        'animal_type_id' => 'required|exists:animal_types,id',
        'image' => 'nullable|image|max:2048',
    ]);

    // التعامل مع تحميل الصورة
    if ($request->hasFile('image')) {
        // حذف الصورة القديمة إذا كانت موجودة
        if ($pet->image && file_exists(public_path($pet->image))) {
            unlink(public_path($pet->image));
        }

        // الحصول على اسم الملف الأصلي مع توليد اسم فريد
        $imageName = time() . '_' . $request->file('image')->getClientOriginalName();

        // نقل الصورة إلى مجلد التخزين (public/img/pets)
        $request->file('image')->move(public_path('img/pets'), $imageName);

        // تحديث مسار الصورة في البيانات المعتمدة
        $validatedData['image'] = 'img/pets/' . $imageName;
    }

    // تحديث بيانات الحيوان
    $pet->update($validatedData);

    // إعادة التوجيه مع رسالة نجاح
    return redirect()->route('profile')->with('success', 'Pet updated successfully!');
}



    public function destroyPet($id)
{
    // العثور على الحيوان الأليف باستخدام الـ ID
    $pet = Pet::findOrFail($id);

    // حذف الحيوان الأليف
    $pet->delete();

    // إعادة توجيه المستخدم مع رسالة نجاح
    return redirect()->route('profile')->with('success', 'Pet deleted successfully!');
}

public function editInfo()
{
    $user = Auth::user(); // Get the currently authenticated user
    return view('Profile.editInfo', compact('user'));
}

// دالة لعرض المعلومات الشخصية
public function showInfo()
{
    $user = auth()->user(); // جلب بيانات المستخدم الحالي
    return view('profile.showInfo', compact('user')); // عرض معلومات المستخدم
}

public function update(Request $request, $id)
{
    // Validate the incoming request data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:15',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Add validation for image
    ]);

    // Find the user and update their details
    $user = User::findOrFail($id);
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->phone = $request->input('phone');

    // Handle image upload
    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($user->image && file_exists(public_path($user->image))) {
            unlink(public_path($user->image));
        }

        // Store the new image
        $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('img/users'), $imageName);

        // Update the image path in the database
        $user->image = 'img/users/' . $imageName;
    }

    // Save the user data
    $user->save();

    // Redirect back to profile with a success message
    return redirect()->route('profile')->with('success', 'Profile updated successfully.');
}


public function showRatingPage()
{
    $userId = auth()->id();

    // جلب المواعيد المقبولة أو المؤكدة
    $appointments = Appointment::where('user_id', $userId)
        ->whereIn('status', ['accepted', 'confirmed', 'approved']) // إضافة حالة confirmed
        ->where('appointment_date', '<', now())
        ->get();

    // جلب الحجوزات المقبولة أو المؤكدة
    $bookings = Booking::where('user_id', $userId)
        ->whereIn('status', ['accepted', 'confirmed', 'approved']) // إضافة حالة confirmed
        ->where('check_in_date', '<', now())
        ->get();

    // جلب خدمات التجميل المقبولة أو المؤكدة
    $groomings = Brooming::where('user_id', $userId)
        ->whereIn('status', ['accepted', 'confirmed', 'approved']) // إضافة حالة confirmed
        ->where('appointment_date', '<', now())
        ->get();

    // جلب طلبات التاكسي المكتملة
    $taxiRequests = TaxiRequest::where('user_id', $userId)
        ->where('status', 'completed')
        ->get();

    // التحقق من وجود أي مواعيد أو حجوزات أو خدمات أو طلبات تاكسي
    if ($appointments->isEmpty() && $bookings->isEmpty() && $groomings->isEmpty() && $taxiRequests->isEmpty()) {
        return redirect()->route('profile')->with('error', 'You do not have any eligible bookings to leave a rating.');
    }

    // تخزين أول عنصر متاح في الجلسة
    if (!$appointments->isEmpty()) {
        $appointment = $appointments->first();
        session(['appointment_id' => $appointment->id]);
    } elseif (!$bookings->isEmpty()) {
        $booking = $bookings->first();
        session(['booking_id' => $booking->id]);
    } elseif (!$groomings->isEmpty()) {
        $grooming = $groomings->first();
        session(['grooming_id' => $grooming->id]);
    } elseif (!$taxiRequests->isEmpty()) {
        $taxiRequest = $taxiRequests->first();
        session(['taxi_request_id' => $taxiRequest->id]);
    }

    // عرض صفحة التقييم
    return view('profile.rating');
}



public function storeRating(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'feedback' => 'nullable|string|max:255',
    ]);

    // استرجاع البيانات من الـ session
    $bookingId = session('booking_id');
    $appointmentId = session('appointment_id');
    $groomingId = session('grooming_id');

    // Check if at least one of the IDs is present for valid ratings
    $hasValidRatingSource = $bookingId || $appointmentId || $groomingId;

    if (!$hasValidRatingSource) {
        return redirect()->back()->with('error', 'You must provide a valid booking, appointment, or grooming ID to rate.');
    }

    // Create the rating
    Rating::create([
        'user_id' => auth()->id(),
        'booking_id' => $bookingId,
        'appointment_id' => $appointmentId,
        'grooming_id' => $groomingId,
        'rating' => $validatedData['rating'],
        'feedback' => $validatedData['feedback'],
    ]);

    // Clear the session data after storing the rating
    session()->forget(['booking_id', 'appointment_id', 'grooming_id']);

    return redirect()->route('profile')->with('success', 'Thank you for your feedback!');
}




}
