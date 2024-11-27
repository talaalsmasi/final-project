<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::all();
        return view('admin.drivers.index', compact('drivers'));
    }

    public function create()
    {
        $users = User::all(); // Assuming you want to select a user for each driver
        return view('admin.drivers.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'available' => 'required|boolean',
        ]);

        Driver::create($request->all());

        return redirect()->route('admin.drivers.index')->with('success', 'Driver created successfully');
    }

    public function show(Driver $driver)
    {
        return view('admin.drivers.show', compact('driver'));
    }

    public function edit(Driver $driver)
{
    $users = User::all();
    return view('admin.drivers.edit', compact('driver', 'users'));
}


public function update(Request $request, Driver $driver)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'available' => 'required|boolean',
    ]);

    $driver->update($request->all());

    return redirect()->route('admin.drivers.index')->with('success', 'Driver updated successfully.');
}


    public function destroy(Driver $driver)
    {
        $driver->delete();

        return redirect()->route('admin.drivers.index')->with('success', 'Driver deleted successfully');
    }
}
