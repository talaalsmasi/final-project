<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Pet;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserBookingController extends Controller
{



    // عرض نموذج حجز الغرفة
    public function create(Room $room)
    {
        // التحقق مما إذا كان المستخدم مسجل الدخول
        if (!auth()->check()) {
            // تحويل المستخدم إلى صفحة تسجيل الدخول مع رسالة
            return redirect()->route('login')->with('error', 'You have to login first');
        }

        // جلب الحيوانات الخاصة بالمستخدم الحالي
        $pets = Pet::where('user_id', auth()->id())->get();

        // جلب تواريخ الدخول والخروج المحجوزة للغرفة المحددة
        $bookings = Booking::where('room_id', $room->id)
            ->get(['check_in_date', 'check_out_date']); // جلب تواريخ الدخول والخروج

        // تمرير البيانات إلى العرض (Blade)
        return view('bookings.createBooking', compact('pets', 'room', 'bookings'));
    }




    // تخزين الحجز الجديد وتحويل المستخدم إلى صفحة الدفع
    public function store(Request $request)
    {
        // تحقق من صحة البيانات المدخلة
        $data = $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
        ]);



        // التحقق من أن الغرفة ليست محجوزة في نفس الفترة الزمنية
        $isRoomAlreadyBooked = Booking::where('room_id', $request->room_id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('check_in_date', [$request->check_in_date, $request->check_out_date])
                      ->orWhereBetween('check_out_date', [$request->check_in_date, $request->check_out_date])
                      ->orWhere(function ($query) use ($request) {
                          $query->where('check_in_date', '<=', $request->check_in_date)
                                ->where('check_out_date', '>=', $request->check_out_date);
                      });
            })
            ->exists();

            if ($request->check_out_date <= $request->check_in_date) {
                return back()->withErrors(['check_out_date' => 'Check-out date must be after check-in date.']);
            }



        if ($isRoomAlreadyBooked) {
            return back()->withErrors(['check_in_date' => 'This room is already booked during these dates.']);
        }

           // Check if the pet is already booked in the selected date range
           if ($this->isPetAlreadyBooked($request->pet_id, $request->check_in_date, $request->check_out_date)) {
            return back()->withErrors(['check_in_date' => 'This pet is already booked for the selected dates.']);
        }

        // Check if the user already has another booking for a pet in the selected date range
        if ($this->isUserAlreadyBooked($request->user_id, $request->check_in_date, $request->check_out_date)) {
            return back()->withErrors(['check_in_date' => 'The user already has another booking during these dates.']);
        }



        // التحقق من أن الحيوان ليس لديه حجز آخر في نفس الفترة الزمنية
        $isPetAlreadyBooked = Booking::where('pet_id', $request->pet_id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('check_in_date', [$request->check_in_date, $request->check_out_date])
                      ->orWhereBetween('check_out_date', [$request->check_in_date, $request->check_out_date])
                      ->orWhere(function ($query) use ($request) {
                          $query->where('check_in_date', '<=', $request->check_in_date)
                                ->where('check_out_date', '>=', $request->check_out_date);
                      });
            })
            ->exists();

        if ($isPetAlreadyBooked) {
            return back()->withErrors(['check_in_date' => 'This pet already has a booking during these dates.']);
        }

        // تحويل المستخدم إلى صفحة الدفع مع بيانات الحجز
        return redirect()->route('bookings.payment', $data);
    }
    public function show($petId)
    {
        // جلب جميع الحجوزات المرتبطة بالحيوان مع تفاصيل الغرفة
        $bookings = Booking::with(['pet', 'room']) // تأكد من تضمين علاقة 'room'
            ->where('pet_id', $petId)
            ->get();

        // التأكد من وجود حجوزات للحيوان
        if ($bookings->isEmpty()) {
            return redirect()->back()->with('error', 'No bookings found for this pet.');
        }

        // تمرير البيانات إلى العرض (view)
        return view('bookings.showBookings', compact('bookings'));
    }
}
