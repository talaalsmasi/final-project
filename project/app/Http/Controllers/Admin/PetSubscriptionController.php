<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnimalSubscription;
use App\Models\Pet;
use App\Models\Subscription;
use Illuminate\Http\Request;

class PetSubscriptionController extends Controller
{
    public function index()
    {
        // Fetch all pet subscriptions with related pet and subscription data
        $petSubscriptions = AnimalSubscription::with(['pet', 'subscription'])->get();
        return view('admin.pet_subscriptions.index', compact('petSubscriptions'));
    }

    public function create()
    {
        // Fetch pets and subscriptions to populate the form options
        $pets = Pet::all();
        $subscriptions = Subscription::all();
        return view('admin.pet_subscriptions.create', compact('pets', 'subscriptions'));
    }

    public function store(Request $request)
    {
        // Validate incoming data
        $data = $request->validate([
            'subscription_id' => 'required|exists:subscriptions,id',
            'pet_id' => 'required|exists:pets,id',
            'month' => 'required|integer|between:1,12',
            'week_number' => 'required|integer|between:1,4',
            'session_time' => 'required|string',
        ]);

        // Create the subscription entry
        AnimalSubscription::create($data);

        return redirect()->route('admin.pet_subscriptions.index')->with('success', 'Pet subscription created successfully.');
    }

    public function show($id)
    {
        // Fetch specific pet subscription
        $petSubscription = AnimalSubscription::with(['pet', 'subscription'])->findOrFail($id);
        return view('admin.pet_subscriptions.show', compact('petSubscription'));
    }

    public function edit($id)
    {
        // Fetch specific pet subscription and data needed to edit
        $petSubscription = AnimalSubscription::findOrFail($id);
        $pets = Pet::all();
        $subscriptions = Subscription::all();
        return view('admin.pet_subscriptions.edit', compact('petSubscription', 'pets', 'subscriptions'));
    }

    public function update(Request $request, $id)
    {
        // Fetch the specific pet subscription
        $petSubscription = AnimalSubscription::findOrFail($id);

        // Validate incoming data
        $data = $request->validate([
            'subscription_id' => 'required|exists:subscriptions,id',
            'pet_id' => 'required|exists:pets,id',
            'month' => 'required|integer|between:1,12',
            'week_number' => 'required|integer|between:1,4',
            'session_time' => 'required|string',
        ]);

        // Update the subscription entry
        $petSubscription->update($data);

        return redirect()->route('admin.pet_subscriptions.index')->with('success', 'Pet subscription updated successfully.');
    }

    public function destroy($id)
    {
        // Delete specific pet subscription
        $petSubscription = AnimalSubscription::findOrFail($id);
        $petSubscription->delete();

        return redirect()->route('admin.pet_subscriptions.index')->with('success', 'Pet subscription deleted successfully.');
    }
}
