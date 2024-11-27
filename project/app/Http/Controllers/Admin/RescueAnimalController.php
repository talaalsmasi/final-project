<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RescueAnimal;
use App\Models\Pet;
use Illuminate\Http\Request;

class RescueAnimalController extends Controller
{
    // List all rescue animals
    public function index()
    {
        $rescueAnimals = RescueAnimal::with('pet')->get();
        return view('Admin.rescue_animals.index', compact('rescueAnimals'));
    }

    // Show form to create a new rescue animal
    public function create()
    {
        $pets = Pet::all();
        return view('Admin.rescue_animals.create', compact('pets'));
    }

    // Store the new rescue animal
    public function store(Request $request)
    {
        $data = $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'total_required_amount' => 'required|numeric',
            'current_donated_amount' => 'nullable|numeric',
            'description' => 'nullable|string',
        ]);

        RescueAnimal::create($data);

        return redirect()->route('admin.rescue_animals.index')->with('success', 'Rescue animal created successfully.');
    }

    // Show form to edit a rescue animal
    public function edit(RescueAnimal $rescueAnimal)
    {
        $pets = Pet::all();
        return view('Admin.rescue_animals.edit', compact('rescueAnimal', 'pets'));
    }

    // Update a rescue animal
    public function update(Request $request, RescueAnimal $rescueAnimal)
    {
        $data = $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'total_required_amount' => 'required|numeric',
            'current_donated_amount' => 'nullable|numeric',
            'description' => 'nullable|string',
        ]);

        $rescueAnimal->update($data);

        return redirect()->route('admin.rescue_animals.index')->with('success', 'Rescue animal updated successfully.');
    }

    // Delete a rescue animal
    public function destroy(RescueAnimal $rescueAnimal)
    {
        $rescueAnimal->delete();
        return redirect()->route('admin.rescue_animals.index')->with('success', 'Rescue animal deleted successfully.');
    }
}
