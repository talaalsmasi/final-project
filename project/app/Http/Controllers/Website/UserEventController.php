<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification as NotificationFacade;
use App\Notifications\EventRegistrationNotification;
use App\Notifications\EventReminderNotification;

class UserEventController extends Controller
{
    public function showEvents()
    {
        $events = Event::all();
        return view('events.showevents', compact('events'));
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('events.eventdetails', compact('event'));
    }

    public function register($eventId)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to register for the event.');
        }

        $userId = auth()->id();
        $event = Event::findOrFail($eventId);

        // التحقق من أن الحدث لم ينتهي
        if (now()->greaterThanOrEqualTo(Carbon::parse($event->event_date . ' ' . $event->event_time))) {
            return back()->with('error', 'The event has already finished.');
        }

        // التحقق من أن الحدث لم يصل إلى السعة القصوى
        if ($event->registered_count >= $event->capacity) {
            return back()->with('error', 'The event is already at full capacity.');
        }

        // التحقق من أن المستخدم غير مسجل مسبقاً في الحدث
        $alreadyRegistered = DB::table('event_registrations')
                                ->where('event_id', $eventId)
                                ->where('user_id', $userId)
                                ->exists();

        if ($alreadyRegistered) {
            return back()->with('error', 'You are already registered for this event.');
        }

        // تسجيل المستخدم في الحدث
        DB::table('event_registrations')->insert([
            'user_id' => $userId,
            'event_id' => $eventId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // تحديث عدد المسجلين في الحدث
        $event->increment('registered_count');

        // إرسال إشعار للمستخدم

        return redirect('profile')->with('success', 'You have successfully registered for the event.');
    }

    public function myRegisteredEvents()
    {
        $userId = auth()->id();
        $events = Event::whereHas('registrations', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();

        return view('events.my_registered_events', compact('events'));
    }

    public function unregister($eventId)
    {
        $userId = auth()->id();

        // حذف التسجيل إذا كان موجودًا
        DB::table('event_registrations')
            ->where('event_id', $eventId)
            ->where('user_id', $userId)
            ->delete();

        // تقليل عدد المسجلين
        Event::where('id', $eventId)->decrement('registered_count');

        return back()->with('message', 'You have successfully unregistered from the event.');
    }
}
