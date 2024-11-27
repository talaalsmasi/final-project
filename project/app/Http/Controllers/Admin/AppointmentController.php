<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use App\Models\Pet;
use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    // Display a list of all appointments
    public function index()
    {
        $appointments = Appointment::with(['user', 'pet', 'doctor', 'service'])->get();
        return view('Admin.appointments.index', compact('appointments'));
    }

    // Show form for creating a new appointment
    public function create()
    {
        $users = User::all(); // Fetch all users
        $pets = Pet::all(); // Fetch all pets
        $doctors = Doctor::all(); // Fetch all doctors
        $services = Service::all(); // Fetch all services

        // Get booked appointments with date, time, and doctor details
        $bookedAppointments = Appointment::select(DB::raw("CONCAT(appointment_date, ' ', appointment_time, ' ', doctor_id) as appointment"))
                                         ->pluck('appointment')
                                         ->toArray();

        return view('Admin.appointments.create', compact('users', 'pets', 'doctors', 'services', 'bookedAppointments'));
    }
    public function getPetsByOwner(Request $request)
{
    $ownerId = $request->owner_id;

    // جلب الحيوانات الخاصة بهذا المستخدم
    $pets = Pet::where('user_id', $ownerId)->get();

    return response()->json($pets);
}


    // Store a new appointment
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'pet_id' => 'required|exists:pets,id',
            'doctor_id' => 'required|exists:doctors,id',
            'service_id' => 'required|exists:services,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|string',
        ]);

        // Check if the pet already has an appointment at the same time
        $isPetAlreadyBooked = Appointment::where('pet_id', $request->pet_id)
                                    ->where('appointment_date', $request->appointment_date)
                                    ->where('appointment_time', $request->appointment_time)
                                    ->exists();

        if ($isPetAlreadyBooked) {
            return back()->withErrors(['appointment_time' => 'This pet already has an appointment at this time.']);
        }

        // Check if the doctor is booked at the same time
        $isDoctorBooked = Appointment::where('appointment_date', $request->appointment_date)
                                 ->where('appointment_time', $request->appointment_time)
                                 ->where('doctor_id', $request->doctor_id)
                                 ->exists();

        if ($isDoctorBooked) {
            return back()->withErrors(['appointment_time' => 'This time slot is already booked for the selected doctor.']);
        }

        // If no conflicts, create the appointment
        Appointment::create($data);

        return redirect()->route('admin.appointments.index')->with('success', 'Appointment created successfully.');
    }

    // Display a specific appointment
    public function show(Appointment $appointment)
    {
        $appointment->load(['user', 'pet', 'doctor', 'service']);
        return view('Admin.appointments.show', compact('appointment'));
    }

    // Show form for editing an appointment
    public function edit(Appointment $appointment)
    {
        $users = User::all(); // Fetch all users
        $pets = Pet::all(); // Fetch all pets
        $doctors = Doctor::all(); // Fetch all doctors
        $services = Service::all(); // Fetch all services

        // Get booked appointments with date, time, and doctor details
        $bookedAppointments = Appointment::select(DB::raw("CONCAT(appointment_date, ' ', appointment_time, ' ', doctor_id) as appointment"))
                                         ->pluck('appointment')
                                         ->toArray();

        return view('Admin.appointments.edit', compact('appointment', 'users', 'pets', 'doctors', 'services', 'bookedAppointments'));
    }

    // Update an existing appointment
    public function update(Request $request, Appointment $appointment)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'pet_id' => 'required|exists:pets,id',
            'doctor_id' => 'required|exists:doctors,id',
            'service_id' => 'required|exists:services,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|string',
        ]);

        // Check if the doctor is booked at the same time, excluding the current appointment
        $isBooked = Appointment::where('appointment_date', $request->appointment_date)
                               ->where('appointment_time', $request->appointment_time)
                               ->where('doctor_id', $request->doctor_id)
                               ->where('id', '!=', $appointment->id)
                               ->exists();

        if ($isBooked) {
            return back()->withErrors(['appointment_time' => 'This time slot is already booked for the selected doctor.']);
        }

        // Update the appointment with the new data
        $appointment->update($data);

        return redirect()->route('admin.appointments.index')->with('success', 'Appointment updated successfully.');
    }

    // Delete an appointment
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('admin.appointments.index')->with('success', 'Appointment deleted successfully.');
    }
}
