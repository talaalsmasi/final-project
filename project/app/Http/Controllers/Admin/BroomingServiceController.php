<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BroomingService;
use Illuminate\Http\Request;

class BroomingServiceController extends Controller
{
    // Display all brooming services
    public function index()
    {
        $groomingServices = BroomingService::all();
        return view('Admin.grooming_services.index', compact('groomingServices'));
    }

    // Show form for creating a new brooming service
    public function create()
    {
        return view('Admin.grooming_services.create');
    }

    // Store a new brooming service
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        BroomingService::create($data);

        return redirect()->route('admin.grooming_services.index')->with('success', 'Brooming service created successfully.');
    }

    // Show a specific brooming service
    public function show(BroomingService $groomingService)
    {
        return view('Admin.grooming_services.show', compact('groomingService'));
    }

    // Show form for editing a brooming service
    public function edit(BroomingService $groomingService)
    {
        return view('Admin.grooming_services.edit', compact('groomingService'));
    }

    // Update an existing brooming service
    public function update(Request $request, BroomingService $groomingService)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $groomingService->update($data);

        return redirect()->route('admin.grooming_services.index')->with('success', 'Grooming service updated successfully.');
    }

    // Delete a brooming service
    public function destroy(BroomingService $groomingService)
    {
        $groomingService->delete();

        return redirect()->route('admin.grooming_services.index')->with('success', 'Grooming service deleted successfully.');
    }
}
