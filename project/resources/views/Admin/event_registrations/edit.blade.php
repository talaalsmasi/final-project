@extends('Admin.layouts.index')

@section('title', 'Edit Event Registration')

@section('content')
<div class="container">
    <h2>Edit Event Registration</h2>

    <div class="card mt-4" style="background-color: #f6f5f5; padding: 20px;">
        <form action="{{ route('admin.event-registrations.update', $eventRegistration->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Select User -->
            <div class="mb-3">
                <label for="user_id" class="form-label">User</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <option value="" disabled>Select User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $eventRegistration->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Select Event -->
            <div class="mb-3">
                <label for="event_id" class="form-label">Event</label>
                <select name="event_id" id="event_id" class="form-control" required>
                    <option value="" disabled>Select Event</option>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}" {{ $eventRegistration->event_id == $event->id ? 'selected' : '' }}>
                            {{ $event->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-orange">Update Registration</button>
        </form>
    </div>
</div>
@endsection
