@extends('Admin.layouts.index')

@section('title', 'Feedback')

@section('content')
<div class="container">
    <div class="container">
        <h1>Rating Details</h1>

        <div class="card">
            <div class="card-header">
                <h3>
                    Rating by
                    @if ($rating->user)
                        {{ $rating->user->name }}
                    @else
                        Unknown User
                    @endif
                </h3>
            </div>

            <div class="card-body">
                <p><strong>Rating:</strong> {{ $rating->rating }} / 5</p>

                @if($rating->feedback)
                    <p><strong>Feedback:</strong> {{ $rating->feedback }}</p>
                @else
                    <p><strong>Feedback:</strong> No feedback provided.</p>
                @endif

                @if($rating->booking_id)
                    <p><strong>Booking ID:</strong> {{ $rating->booking_id }}</p>
                @endif

                @if($rating->appointment_id)
                    <p><strong>Appointment ID:</strong> {{ $rating->appointment_id }}</p>
                @endif

                @if($rating->brooming_id)
                    <p><strong>Brooming ID:</strong> {{ $rating->brooming_id }}</p>
                @endif
            </div>

            <div class="card-footer">
                <a href="{{ route('admin.feedback.index') }}" class="btn btn-secondary">Back to Ratings</a>
            </div>
        </div>
    </div>
    @endsection
