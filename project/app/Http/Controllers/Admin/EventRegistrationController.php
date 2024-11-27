<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventRegistration;
use App\Models\User;
use App\Models\Event;

class EventRegistrationController extends Controller
{
    public function index()
    {
        $registrations = EventRegistration::with(['user', 'event'])->get();
        return view('admin.event_registrations.index', compact('registrations'));
    }

    public function create()
    {
        $users = User::all();
        $events = Event::all();
        return view('admin.event_registrations.create', compact('users', 'events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:events,id',
        ]);

        EventRegistration::create($request->all());
        return redirect()->route('admin.event-registrations.index')->with('success', 'Registration created successfully.');
    }

    public function edit(EventRegistration $eventRegistration)
    {
        $users = User::all();
        $events = Event::all();
        return view('admin.event_registrations.edit', compact('eventRegistration', 'users', 'events'));
    }

    public function update(Request $request, EventRegistration $eventRegistration)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:events,id',
        ]);

        $eventRegistration->update($request->all());
        return redirect()->route('admin.event-registrations.index')->with('success', 'Registration updated successfully.');
    }

    public function destroy(EventRegistration $eventRegistration)
    {
        $eventRegistration->delete();
        return redirect()->route('admin.event-registrations.index')->with('success', 'Registration deleted successfully.');
    }
}
