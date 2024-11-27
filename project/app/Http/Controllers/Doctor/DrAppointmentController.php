<?php
namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class DrAppointmentController extends Controller
{
    public function showAppointments()
    {
        // جلب المستخدم الحالي
        $user = Auth::user();

        // التحقق إذا كان المستخدم لديه طبيب مرتبط
        if ($user->doctor) {
            // جلب doctor_id الخاص بالطبيب
            $doctorId = $user->doctor->id;

            // جلب المواعيد التي تحتوي على doctor_id للطبيب
            $appointments = Appointment::where('doctor_id', $doctorId)->get();

            return view('doctor.appointments.index', compact('appointments'));
        } else {
            // إذا لم يكن المستخدم طبيباً، عرض رسالة مناسبة
            return redirect()->route('home')->with('error', 'You are not authorized to view appointments.');
        }

    }

    public function approve($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);
        $appointment->status = 'approved';
        $appointment->save();

        return redirect()->route('doctor.appointments.index')->with('success', 'Appointment approved successfully.');
    }

    // دالة لتحديث الحالة إلى rejected
    public function reject($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);
        $appointment->status = 'rejected';
        $appointment->save();

        return redirect()->route('doctor.appointments.index')->with('success', 'Appointment rejected successfully.');
    }
    public function pending($appointmentId)
{
    $appointment = Appointment::findOrFail($appointmentId);
    $appointment->status = 'pending';
    $appointment->save();

    return redirect()->route('doctor.appointments.index')->with('success', 'Appointment status set to pending.');
}

}


