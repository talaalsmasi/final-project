<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\RescueAnimal;
use App\Models\User;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    // List all donations
    public function index()
    {
        $donations = Donation::with(['rescueAnimal', 'user'])->get();
        return view('Admin.donations.index', compact('donations'));
    }

    // Show form to create a new donation
    public function create()
    {
        $rescueAnimals = RescueAnimal::all();
        $users = User::all();
        return view('Admin.donations.create', compact('rescueAnimals', 'users'));
    }

    // Store the new donation
    public function store(Request $request)
    {
        $data = $request->validate([
            'rescue_animal_id' => 'required|exists:rescue_animals,id',
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric',
        ]);

        Donation::create($data);

        return redirect()->route('admin.donations.index')->with('success', 'Donation created successfully.');
    }

    // Show form to edit a donation
    public function edit(Donation $donation)
    {
        $rescueAnimals = RescueAnimal::all();
        $users = User::all();
        return view('Admin.donations.edit', compact('donation', 'rescueAnimals', 'users'));
    }

    // Update a donation
    public function update(Request $request, Donation $donation)
    {
        $data = $request->validate([
            'rescue_animal_id' => 'required|exists:rescue_animals,id',
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric',
        ]);

        $donation->update($data);

        return redirect()->route('admin.donations.index')->with('success', 'Donation updated successfully.');
    }

    // Delete a donation
    public function destroy(Donation $donation)
    {
        $donation->delete();
        return redirect()->route('admin.donations.index')->with('success', 'Donation deleted successfully.');
    }
}
