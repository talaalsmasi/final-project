@extends('layouts.index')
@section('from', 'Events')
@section('title', 'Event details')
@section('content')

<section class="pet_appointment_wrap">
    <div class="container">
        <h2>Upcoming Events</h2>

        @if($events->isEmpty())
            <p>No events available at the moment.</p>
        @else
            <div class="row">
                @foreach ($events as $event)
                    <div class="col-md-6">
                        <div class="card mb-3" style="background-color: #f6f5f5; background-image: url('{{ asset('images/service-bg-paw.png') }}'); box-shadow: 0px 6px 12px -1px #ddd; border: none; border-radius: 8px; position: relative;">

                            <!-- عرض علامة "Event Full" إذا كانت السعة مكتملة -->
                            @if($event->registered_count >= $event->capacity)
                                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); display: flex; justify-content: center; align-items: center; color: #fff; font-size: 1.5rem;">
                                    Event Full
                                </div>
                            @endif

                            <div class="card-body" style="padding: 20px; display: flex; justify-content: space-between; align-items: flex-start; opacity: {{ $event->registered_count >= $event->capacity ? '0.7' : '1' }}">
                                <div class="event-details">
                                    <h5><strong><i class="fas fa-calendar-alt" style="color: #ff8931;"></i> Event Details</strong></h5>
                                    <p><strong>Title:</strong> <a href="{{ route('events.details', $event->id) }}" style="text-decoration: none; color: inherit;">{{ $event->title }}</a></p>
                                    <p><strong>Description:</strong> {{ $event->description }}</p>
                                    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('d F, Y') }}</p>
                                    <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($event->event_time)->format('h:i A') }}</p>
                                    <p><strong>Capacity:</strong> {{ $event->capacity }}</p>
                                    <p><strong>Registered:</strong> {{ $event->registered_count }}</p>

                                    <!-- حساب الوقت المتبقي -->
                                    @php
                                        $eventDateTime = \Carbon\Carbon::parse($event->event_date . ' ' . $event->event_time);
                                        $now = \Carbon\Carbon::now();
                                        $daysRemaining = $now->diffInDays($eventDateTime);
                                        $hoursRemaining = $now->copy()->addDays($daysRemaining)->diffInHours($eventDateTime);
                                        $minutesRemaining = $now->copy()->addDays($daysRemaining)->addHours($hoursRemaining)->diffInMinutes($eventDateTime);
                                    @endphp
                                    <p><strong>Time Remaining:</strong> {{ $daysRemaining }} days, {{ $hoursRemaining }} hours, and {{ $minutesRemaining }} minutes</p>
                                </div>

                                <div class="event-actions" style="margin-left: auto;">
                                    @php
                                        $isRegistered = DB::table('event_registrations')
                                            ->where('event_id', $event->id)
                                            ->where('user_id', auth()->id())
                                            ->exists();
                                    @endphp

                                    @if($isRegistered)
                                        <form action="{{ route('events.unregister', $event->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Cancel Attendance</button>
                                        </form>
                                    @else
                                        @if($event->registered_count < $event->capacity)
                                            <form action="{{ route('events.register', $event->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">Register</button>
                                            </form>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div><br>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>



@endsection
