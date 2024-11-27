@extends('Admin.layouts.index')

@section('title', 'Feedback')

@section('content')
<div class="container">
    <h1>Edit Rating</h1>

    <form action="{{ route('admin.feedback.update', $rating->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="user_id">User</label>
            <input type="number" name="user_id" class="form-control" value="{{ $rating->user_id }}" required>
        </div>
        <div class="form-group">
            <label for="rating">Rating (1-5)</label>
            <input type="number" name="rating" class="form-control" value="{{ $rating->rating }}" min="1" max="5" required>
        </div>
        <div class="form-group">
            <label for="feedback">Feedback</label>
            <textarea name="feedback" class="form-control">{{ $rating->feedback }}</textarea>
        </div>
        <div class="form-group">
            <label for="booking_id">Booking ID (Optional)</label>
            <input type="number" name="booking_id" class="form-control" value="{{ $rating->booking_id }}">
        </div>
        <div class="form-group">
            <label for="appointment_id">Appointment ID (Optional)</label>
            <input type="number" name="appointment_id" class="form-control" value="{{ $rating->appointment_id }}">
        </div>
        <div class="form-group">
            <label for="brooming_id">Brooming ID (Optional)</label>
            <input type="number" name="brooming_id" class="form-control" value="{{ $rating->brooming_id }}">
        </div>
        <button type="submit" class="btn btn-primary">Update Rating</button>
    </form>
</div>
@endsection
