<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brooming;
use App\Models\User;
use App\Models\Pet;
use App\Models\BroomingService;
use Illuminate\Http\Request;

class GroomingController extends Controller
{
    // Display all grooming appointments
    public function index()
    {
        $groomings = Brooming::with(['user', 'pet', 'service'])->get();
        return view('Admin.grooming.index', compact('groomings'));
    }

    // Show form for creating a new grooming appointment
    public function create()
    {
        $users = User::all(); // Fetch all users
        $pets = Pet::all();   // Fetch all pets
        $services = BroomingService::all(); // Fetch all brooming services
        return view('Admin.grooming.create', compact('users', 'pets', 'services'));
    }

    // Store a new grooming appointment
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'pet_id' => 'required|exists:pets,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|string',
            'service_id' => 'required|exists:brooming_services,id',
            'status' => 'required|string',
        ]);

        Brooming::create($data);

        return redirect()->route('admin.grooming.index')->with('success', 'Grooming appointment created successfully.');
    }

    // Show details of a specific grooming appointment
    public function show(Brooming $grooming)
    {
        return view('Admin.grooming.show', compact('grooming'));
    }

    // Show form for editing a grooming appointment
    public function edit(Brooming $grooming)
    {
        $users = User::all();
        $pets = Pet::all();
        $services = BroomingService::all();
        return view('Admin.grooming.edit', compact('grooming', 'users', 'pets', 'services'));
    }

    // Update a grooming appointment
    public function update(Request $request, Brooming $grooming)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'pet_id' => 'required|exists:pets,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|string',
            'service_id' => 'required|exists:brooming_services,id',
            'status' => 'required|string',
        ]);

        $grooming->update($data);

        return redirect()->route('admin.grooming.index')->with('success', 'Grooming appointment updated successfully.');
    }

    // Delete a grooming appointment
    public function destroy(Brooming $grooming)
    {
        $grooming->delete();
        return redirect()->route('admin.grooming.index')->with('success', 'Grooming appointment deleted successfully.');
    }
}
