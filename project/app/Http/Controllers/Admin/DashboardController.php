<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactMessage;


class DashboardController extends Controller
{
    public function index()
    {
        // هنا يمكنك جلب البيانات من قاعدة البيانات وعرضها في اللوحة
        return view('Admin.dashboard');
    }

    public function allContact()
    {
        $messages = ContactMessage::all();
        return view('admin.contact_messages.index', compact('messages'));
    }

    // Display individual message details
    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);
        return view('admin.contact_messages.show', compact('message'));
    }
    public function destroy($id)
{
    $message = ContactMessage::findOrFail($id);
    $message->delete();

    return redirect()->route('admin.contact-messages.index')->with('success', 'Message deleted successfully');
}


}


