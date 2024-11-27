<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        // Fetch all subscriptions to display
        $subscriptions = Subscription::all();
        return view('admin.subscriptions.index', compact('subscriptions'));
    }

    public function create()
    {
        // Display the create subscription form
        return view('admin.subscriptions.create');
    }

    public function store(Request $request)
    {
        // Validate the data
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation
        ]);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('img/subscriptions'), $imageName);
            $data['image'] = 'img/subscriptions/' . $imageName;

            // Debugging: Check the path before saving
        }


        // Create the subscription
        Subscription::create($data);

        return redirect()->route('admin.subscriptions.index')->with('success', 'Subscription created successfully.');
    }

    public function show($id)
    {
        // Fetch a specific subscription
        $subscription = Subscription::findOrFail($id);
        return view('admin.subscriptions.show', compact('subscription'));
    }

    public function edit($id)
    {
        // Display the edit form for a specific subscription
        $subscription = Subscription::findOrFail($id);
        return view('admin.subscriptions.edit', compact('subscription'));
    }

    public function update(Request $request, $id)
    {
        $subscription = Subscription::findOrFail($id);

        // Validate the data
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation
        ]);

        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($subscription->image && file_exists(public_path($subscription->image))) {
                unlink(public_path($subscription->image));
            }

            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('img/subscriptions'), $imageName);
            $data['image'] = 'img/subscriptions/' . $imageName;
        }

        // Update the subscription
        $subscription->update($data);

        return redirect()->route('admin.subscriptions.index')->with('success', 'Subscription updated successfully.');
    }

    public function destroy($id)
    {
        $subscription = Subscription::findOrFail($id);

        // Delete the image if it exists
        if ($subscription->image && file_exists(public_path($subscription->image))) {
            unlink(public_path($subscription->image));
        }

        // Delete the subscription
        $subscription->delete();

        return redirect()->route('admin.subscriptions.index')->with('success', 'Subscription deleted successfully.');
    }
}
