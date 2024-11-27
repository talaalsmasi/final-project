<?php
namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Pet;
use App\Models\Service;
use App\Models\Doctor;
use App\Models\Brooming;
use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;

class AppointmentPaymentController extends Controller
{
    // عرض صفحة الدفع بناءً على التفاصيل التي أدخلها المستخدم
    public function showPaymentPage(Request $request)
{
    // جلب تفاصيل الحجز من الطلب والتحقق من صحتها
    $validatedData = $request->validate([
        'pet_id' => 'required|exists:pets,id',
        'service_id' => 'required|exists:services,id',
        'doctor_id' => 'required|exists:doctors,id',
        'appointment_date' => 'required|date',
        'appointment_time' => 'required|string',
    ]);

    // التحقق مما إذا كان التاريخ في الماضي
    if (strtotime($validatedData['appointment_date']) < strtotime(date('Y-m-d'))) {
        return redirect()->back()->with('error', 'The selected appointment date is in the past. Please choose a valid date.');
    }

    // التحقق من أن الطبيب ليس لديه مواعيد أخرى في نفس التاريخ والوقت
    $existingAppointment = Appointment::where('doctor_id', $validatedData['doctor_id'])
        ->where('appointment_date', $validatedData['appointment_date'])
        ->where('appointment_time', $validatedData['appointment_time'])
        ->first();

    if ($existingAppointment) {
        return redirect()->back()->with('error', 'This doctor already has an appointment at the selected time.');
    }

    // التحقق من أن الحيوان الأليف ليس لديه حجز في جدول grooming في نفس الوقت والتاريخ
    $existingBrooming = Brooming::where('pet_id', $validatedData['pet_id'])
        ->where('appointment_date', $validatedData['appointment_date'])
        ->where('appointment_time', $validatedData['appointment_time'])
        ->first();

    if ($existingBrooming) {
        return redirect()->back()->with('error', 'This pet already has a grooming appointment at the selected time.');
    }

    // جلب الحيوانات، الخدمات، والأطباء بناءً على البيانات المدخلة
    $pet = Pet::find($validatedData['pet_id']);
    $service = Service::find($validatedData['service_id']);
    $doctor = Doctor::find($validatedData['doctor_id']);

    // تخزين بيانات الجلسة
    session([
        'user_id' => auth()->id(),
        'pet_id' => $request->pet_id,
        'service_id' => $request->service_id,
        'doctor_id' => $request->doctor_id,
        'appointment_date' => $request->appointment_date,
        'appointment_time' => $request->appointment_time,
        'status' => 'pending',
    ]);

    // تمرير التفاصيل إلى صفحة الدفع
    return view('appointments.appointmentPayment', [
        'pet' => $pet,
        'service' => $service,
        'doctor' => $doctor,
        'appointmentData' => $validatedData,
        'price' => $service->price // إضافة سعر الخدمة هنا
    ]);
}



    // معالجة الدفع وحفظ الحجز بعد الدفع الناجح
    public function processPayment(Request $request)
    {
        // التحقق من صحة بيانات الدفع
        $validatedPayment = $request->validate([
            'card_number' => 'required|regex:/^\d{16}$/',
            'expiry_date' => 'required|date_format:m/y|after:today',
            'cvv' => 'required|digits:3',
            'cardholder_name' => 'required|string|max:255',
        ]);



        // التحقق من صحة بيانات الحجز
        // $validatedAppointment = $request->validate([
        //     'pet_id' => 'required|exists:pets,id',
        //     'service_id' => 'required|exists:services,id',
        //     'doctor_id' => 'required|exists:doctors,id',
        //     'appointment_date' => 'required|date|after_or_equal:today',
        //     'appointment_time' => 'required|string',
        // ]);


        // محاولة الدفع (محاكاة الدفع هنا)
        try {
            DB::beginTransaction();

            // إذا تمت عملية الدفع بنجاح، احفظ الحجز في قاعدة البيانات
            Appointment::create([
                'user_id' => auth()->id(),
                'pet_id' => session('pet_id'),
                'service_id' =>session('service_id'),
                'doctor_id' => session('doctor_id'),
                'appointment_date' =>  session('appointment_date'),
                'appointment_time' => session('appointment_time'),
                'status' => 'pending', // تغيير حالة الحجز إلى 'pending'
            ]);

            DB::commit();


// بعد الحجز بنجاح
// Notification::create([
//     'user_id' => $user->id, // معرف المستخدم الذي سيتلقى الإشعار
//     'message' => 'Your appointment has been confirmed for ' . $appointment->appointment_date,
//     'is_read' => false,
// ]);


            // إعادة توجيه المستخدم إلى صفحة النجاح
            return redirect()->route('profile')->with('success', 'Payment successful and booking confirmed!');

        } catch (\Exception $e) {
            DB::rollBack();
            // إذا فشلت العملية
            return redirect()->route('appointment.payment')->with('error', 'Payment failed. Please try again.');
        }
    }
}


