<?php
namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\Doctor;
use Illuminate\Http\Request;

class UserAppointmentController extends Controller
{
    // عرض صفحة إنشاء الحجز
    // public function create()
    // {
    //     // التحقق من تسجيل الدخول
    //     if (!auth()->check()) {
    //         // إذا لم يكن مسجل الدخول، إعادة التوجيه إلى صفحة تسجيل الدخول مع رسالة
    //         return redirect()->route('login')->with('error', 'You must log in first.');
    //     }

    //     // جلب الحيوانات الخاصة بالمستخدم المسجل
    //     $pets = Pet::where('user_id', auth()->id())->get();
    //     $doctors = Doctor::all();
    //     $services = Service::all();

    //     // التحقق من وجود البيانات المطلوبة
    //     if ($pets->isEmpty() || $doctors->isEmpty() || $services->isEmpty()) {
    //         return redirect()->back()->with('error', 'There is not enough data to create an appointment.');
    //     }

    //     // تمرير البيانات إلى صفحة إنشاء الحجز
    //     return view('appointments.createAppointment', compact('pets', 'services', 'doctors'));
    // }

    public function create(Request $request)
    {
        // التحقق من تسجيل الدخول
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must log in first.');
        }

        // جلب الحيوانات الخاصة بالمستخدم
        $pets = Pet::where('user_id', auth()->id())->get();
        $doctors = Doctor::all();
        $services = Service::all();

        // التحقق من وجود البيانات المطلوبة
        if ($pets->isEmpty() || $doctors->isEmpty() || $services->isEmpty()) {
            return redirect()->back()->with('error', 'There is not enough data to create an appointment.');
        }

        // الأوقات المتاحة لكل يوم
        $availableTimes = [
            "10:00 AM - 10:30 AM", "10:30 AM - 11:00 AM", "11:00 AM - 11:30 AM",
            "11:30 AM - 12:00 PM", "12:00 PM - 12:30 PM", "12:30 PM - 01:00 PM",
            "01:30 PM - 02:00 PM", "02:00 PM - 02:30 PM", "02:30 PM - 03:00 PM",
            "03:00 PM - 03:30 PM", "03:30 PM - 04:00 PM", "04:00 PM - 04:30 PM",
            "04:30 PM - 05:00 PM", "05:00 PM - 05:30 PM", "05:30 PM - 06:00 PM",
        ];

        // جلب الأوقات المحجوزة للموعد الحالي للطبيب المحدد
        $bookedTimes = [];
        if ($request->has('appointment_date') && $request->has('doctor_id')) {
            $bookedTimes = Appointment::where('appointment_date', $request->appointment_date)
                            ->where('doctor_id', $request->doctor_id)
                            ->pluck('appointment_time')
                            ->toArray();
        }

        // تمرير البيانات إلى صفحة الإنشاء مع الأوقات المحجوزة
        return view('appointments.createAppointment', compact('pets', 'services', 'doctors', 'availableTimes', 'bookedTimes'));
    }






    public function show($petId)
{
    // جلب جميع المواعيد المرتبطة بالحيوان
    $appointments = Appointment::with('pet', 'service')
        ->where('pet_id', $petId)
        ->get();

    // التأكد من وجود مواعيد للحيوان
    if ($appointments->isEmpty()) {
        return redirect()->back()->with('error', 'No appointments found for this pet.');
    }

    // تمرير البيانات إلى العرض (view)
    return view('Appointments.showAppointments', compact('appointments'));
}

public function getBookedTimes(Request $request)
{
    $date = $request->query('date');
    $doctorId = $request->query('doctor_id');

    $bookedTimes = Appointment::where('appointment_date', $date)
                    ->where('doctor_id', $doctorId)
                    ->pluck('appointment_time')
                    ->toArray();

    return response()->json(['bookedTimes' => $bookedTimes]);
}



}
