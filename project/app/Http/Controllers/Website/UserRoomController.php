<?php
namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Room;

class UserRoomController extends Controller
{
    public function index()
    {
        // Fetch all rooms from the database
        $rooms = Room::all();

        // Return the view and pass the rooms data
        return view('bookings.rooms', compact('rooms'));
    }
    public function show($id)
{
    // Find the room by ID
    $room = Room::findOrFail($id);

    // Pass the room data to the view
    return view('bookings.showDetails', compact('room'));
}

}
