<?php
namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\BroomingService;
use App\Models\Brooming;
use Illuminate\Http\Request;

class UserBroomingController extends Controller
{
    // عرض صفحة إنشاء الحجز
    public function create()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You have to login first');
        }

        $pets = Pet::where('user_id', auth()->id())->get();
        $services = BroomingService::all();

        // جلب جميع المواعيد المحجوزة بدون تحديد التاريخ
        $bookedAppointments = Brooming::pluck('appointment_time')->toArray();

        return view('grooming.createBrooming', compact('pets', 'services', 'bookedAppointments'));
    }
    public function getBookedAppointments(Request $request)
{
    $date = $request->query('date');
    $bookedAppointments = Brooming::whereDate('appointment_date', $date)
        ->pluck('appointment_time')
        ->toArray();

    return response()->json(['bookedAppointments' => $bookedAppointments]);
}






    public function show($petId)
    {
        // جلب جميع مواعيد الـ grooming المرتبطة بالحيوان
        $broomings = Brooming::with('pet', 'service')
            ->where('pet_id', $petId)
            ->get();

        // التأكد من وجود مواعيد
        if ($broomings->isEmpty()) {
            return redirect()->back()->with('error', 'No grooming appointments found for this pet.');
        }

        // تمرير البيانات إلى العرض (view)
        return view('grooming.showBrooming', compact('broomings'));
    }
}
