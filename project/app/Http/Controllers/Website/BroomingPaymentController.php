<?php
namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Brooming;
use App\Models\Appointment;
use App\Models\BroomingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BroomingPaymentController extends Controller
{
    // عرض صفحة الدفع بناءً على التفاصيل التي أدخلها المستخدم


        // عرض صفحة الدفع بناءً على التفاصيل التي أدخلها المستخدم
        public function showPaymentPage(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'pet_id' => 'required|exists:pets,id',
        'service_id' => 'required|exists:brooming_services,id',
        'appointment_date' => 'required|date|after_or_equal:today',
        'appointment_time' => 'required|string',
    ]);

    // Check if the selected date is in the past
    if (strtotime($validatedData['appointment_date']) < strtotime(date('Y-m-d'))) {
        return redirect()->back()->with('error', 'The selected appointment date is in the past.');
    }

    // Check if any pet has an appointment at the same date and time
    $existingAppointment = Brooming::where('appointment_date', $validatedData['appointment_date'])
        ->where('appointment_time', $validatedData['appointment_time'])
        ->exists();

    if ($existingAppointment) {
        return redirect()->back()->with('error', 'An appointment already exists at the selected time for another pet.');
    }

    // Check if the selected pet already has an appointment on the same date and time
    $petAppointmentExists = Appointment::where('pet_id', $validatedData['pet_id'])
        ->where('appointment_date', $validatedData['appointment_date'])
        ->where('appointment_time', $validatedData['appointment_time'])
        ->exists();

    if ($petAppointmentExists) {
        return redirect()->back()->with('error', 'The selected pet already has an appointment at the selected time.');
    }

    // Retrieve the service details based on service_id
    $service = BroomingService::find($validatedData['service_id']);

    // If the service is not found, redirect back with an error message
    if (!$service) {
        return redirect()->back()->with('error', 'Service not found. Please try again.');
    }

    // Pass the details to the payment page
    return view('grooming.broomingPayment', [
        'validatedData' => $validatedData,
        'servicePrice' => $service->price, // Include service price here
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
        ]);

        // محاولة الدفع (محاكاة الدفع هنا)
        try {
            DB::beginTransaction();

            // إذا تمت عملية الدفع بنجاح، احفظ الحجز في قاعدة البيانات
            Brooming::create([
                'user_id' => auth()->id(),
                'pet_id' => $request->pet_id,
                'service_id' => $request->service_id,
                'appointment_date' => $request->appointment_date,
                'appointment_time' => $request->appointment_time,
                'status' => 'pending', // تغيير حالة الحجز إلى 'confirmed'
            ]);

            DB::commit();

            // إعادة توجيه المستخدم إلى صفحة النجاح
            return redirect()->route('profile')->with('success', 'Payment successful and booking confirmed!');

        } catch (\Exception $e) {
            DB::rollBack();
            // إذا فشلت العملية
            return redirect()->route('brooming.payment')->with('error', 'Payment failed. Please try again.');
        }
    }
}
