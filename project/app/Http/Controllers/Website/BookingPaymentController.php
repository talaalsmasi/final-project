<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Pet;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\BookingNotification;

class BookingPaymentController extends Controller
{
    // Show the payment page
    public function showPaymentPage(Request $request)
    {
        $room = Room::findOrFail($request->room_id);
        $pet = Pet::findOrFail($request->pet_id); // استرداد معلومات الحيوان بناءً على pet_id
        $pricePerNight = $room->price_per_night;

        // حساب عدد أيام الحجز
        $checkInDate = \Carbon\Carbon::parse($request->check_in_date);
        $checkOutDate = \Carbon\Carbon::parse($request->check_out_date);
        $numberOfNights = $checkInDate->diffInDays($checkOutDate);

        // حساب السعر الإجمالي
        $totalPrice = $pricePerNight * $numberOfNights;
        // حساب نصف السعر
        $halfPrice = $totalPrice / 2;

        return view('bookings.bookingPayment', [
            'roomName' => $room->room_name,
            'petName' => $pet->name, // إضافة اسم الحيوان هنا
            'pricePerNight' => $pricePerNight,
            'totalPrice' => $totalPrice,
            'halfPrice' => $halfPrice,
            'numberOfNights' => $numberOfNights,
            'checkInDate' => $request->check_in_date,
            'checkOutDate' => $request->check_out_date,
            'data' => $request->all(),
            'booking_id' => $request->booking_id,
            'room' => $room,
        ]);
    }






    // Process the payment
    public function processPayment(Request $request)
    {
        // Validate payment details
        $validated = $request->validate([
            'card_number' => 'required|digits:16',
            'cardholder_name' => 'required|string|max:255',
            'expiry_date' => 'required|regex:/^\d{2}\/\d{2}$/',
            'cvv' => 'required|digits:3',
        ], [
            'card_number.required' => 'Card number is required and must be 16 digits.',
            'expiry_date.regex' => 'Expiry date must be in MM/YY format.',
            'cvv.digits' => 'CVV must be 3 digits.'
        ]);


        // Simulate payment process (you can integrate with a payment gateway here)
        // In this example, we are assuming the payment is successful

        // Now create a booking entry in the database
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'pet_id' => $request->pet_id,
            'room_id' => $request->room_id,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'status' => 'pending', // Booking is confirmed after payment
        ]);




        // Redirect to profile with a success message
        return redirect()->route('profile')->with('success', 'Payment completed and room booking confirmed!');
    }
}
