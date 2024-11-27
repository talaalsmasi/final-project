@extends('Admin.layouts.index')

@section('title', 'Events')

@section('content')

<div class="container">
    <h2 class="mb-4">Edit Event</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card" style="background-color: #f6f5f5; padding: 20px;">
        <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Event Title -->
            <div class="mb-3">
                <label for="title" class="form-label">Event Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $event->title }}" required>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" required>{{ $event->description }}</textarea>
            </div>

            <!-- Capacity -->
            <div class="mb-3">
                <label for="capacity" class="form-label">Capacity</label>
                <input type="number" name="capacity" id="capacity" class="form-control" value="{{ $event->capacity }}" required>
            </div>

            <!-- Event Date -->
            <div class="mb-3">
                <label for="event_date" class="form-label">Event Date</label>
                <input type="date" name="event_date" id="event_date" class="form-control" value="{{ $event->event_date }}" required>
            </div>

            <!-- Event Time -->
            <div class="mb-3">
                <label for="event_time" class="form-label">Event Time</label>
                <input type="time" name="event_time" id="event_time" class="form-control" value="{{ $event->event_time }}" required>
            </div>

            <!-- Event Image -->
            <div class="mb-3">
                <label for="image" class="form-label">Event Image</label>
                @if($event->image)
                    <div class="mb-2">
                        <img src="{{ asset($event->image) }}" alt="Event Image" style="width: 150px; height: auto;">
                    </div>
                @endif
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-orange">Update Event</button>
        </form>
    </div>
</div>

@endsection
