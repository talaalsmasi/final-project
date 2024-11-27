<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Pet;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // Display all bookings
    public function index()
    {
        $bookings = Booking::with('pet', 'user')->get(); // Eager load the related pet and user models
        return view('Admin.bookings.index', compact('bookings'));
    }

    // Show the form for creating a new booking
    public function create()
    {
        $users = User::all(); // Fetch all users
        $rooms = Room::all(); // Fetch all rooms
        $pets = Pet::all();   // Fetch all pets
        return view('Admin.bookings.create', compact('users', 'pets','rooms'));
    }

    // Store a new booking
    public function store(Request $request)
    {
        // Validate incoming request data
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'pet_id' => 'required|exists:pets,id',
            'room_id' => 'required',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
        ]);

        // Check if the pet is already booked in the selected date range
        if ($this->isPetAlreadyBooked($request->pet_id, $request->check_in_date, $request->check_out_date)) {
            return back()->withErrors(['check_in_date' => 'This pet is already booked for the selected dates.']);
        }

        // Check if the user already has another booking for a pet in the selected date range
        if ($this->isUserAlreadyBooked($request->user_id, $request->check_in_date, $request->check_out_date)) {
            return back()->withErrors(['check_in_date' => 'The user already has another booking during these dates.']);
        }

        // Create a new booking
        Booking::create($data);

        return redirect()->route('admin.bookings.index')->with('success', 'Booking created successfully.');
    }

    // Show the form for editing a booking
    public function edit(Booking $booking)
    {
        $users = User::all(); // Fetch all users
        $pets = Pet::all();   // Fetch all pets
        return view('Admin.bookings.edit', compact('booking', 'users', 'pets'));
    }

    // Update the booking in the database
    public function update(Request $request, Booking $booking)
    {
        // Validate incoming request data
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'pet_id' => 'required|exists:pets,id',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
        ]);

        // Check if the pet is already booked in the selected date range (excluding the current booking)
        if ($this->isPetAlreadyBooked($request->pet_id, $request->check_in_date, $request->check_out_date, $booking->id)) {
            return back()->withErrors(['check_in_date' => 'This pet is already booked for the selected dates.']);
        }

        // Check if the user already has another booking for a pet in the selected date range (excluding the current booking)
        if ($this->isUserAlreadyBooked($request->user_id, $request->check_in_date, $request->check_out_date, $booking->id)) {
            return back()->withErrors(['check_in_date' => 'The user already has another booking during these dates.']);
        }

        // Update the booking
        $booking->update($data);

        return redirect()->route('admin.bookings.index')->with('success', 'Booking updated successfully.');
    }

    // Delete a booking
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'Booking deleted successfully.');
    }

    // Helper method to check if a pet is already booked for the given dates
    private function isPetAlreadyBooked($pet_id, $check_in_date, $check_out_date, $ignoreBookingId = null)
    {
        return Booking::where('pet_id', $pet_id)
            ->when($ignoreBookingId, function ($query, $ignoreBookingId) {
                return $query->where('id', '!=', $ignoreBookingId);
            })
            ->where(function ($query) use ($check_in_date, $check_out_date) {
                $query->whereBetween('check_in_date', [$check_in_date, $check_out_date])
                      ->orWhereBetween('check_out_date', [$check_in_date, $check_out_date])
                      ->orWhere(function ($query) use ($check_in_date, $check_out_date) {
                          $query->where('check_in_date', '<=', $check_in_date)
                                ->where('check_out_date', '>=', $check_out_date);
                      });
            })
            ->exists();
    }

    // Helper method to check if a user has another booking for the given dates
    private function isUserAlreadyBooked($user_id, $check_in_date, $check_out_date, $ignoreBookingId = null)
    {
        return Booking::where('user_id', $user_id)
            ->when($ignoreBookingId, function ($query, $ignoreBookingId) {
                return $query->where('id', '!=', $ignoreBookingId);
            })
            ->where(function ($query) use ($check_in_date, $check_out_date) {
                $query->whereBetween('check_in_date', [$check_in_date, $check_out_date])
                      ->orWhereBetween('check_out_date', [$check_in_date, $check_out_date])
                      ->orWhere(function ($query) use ($check_in_date, $check_out_date) {
                          $query->where('check_in_date', '<=', $check_in_date)
                                ->where('check_out_date', '>=', $check_out_date);
                      });
            })
            ->exists();
    }
    public function show($id)
    {
        $booking = Booking::with(['user', 'pet', 'room'])->findOrFail($id); // Eager loading room data
        return view('Admin.bookings.show', compact('booking'));
    }

}
