@extends('Admin.layouts.index')

@section('title', 'Booking Details')

@section('content')
    <div class="container">
        <h1 class="mb-4">Booking Details</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><strong>Booking ID:</strong> {{ $booking->id }}</h5>
                <p class="card-text"><strong>Owner:</strong> {{ $booking->user->name }}</p>
                <p class="card-text"><strong>Pet:</strong> {{ $booking->pet->name }}</p>

                <!-- Room Information -->
                <p class="card-text"><strong>Room Name:</strong> {{ $booking->room->room_name ?? 'N/A' }}</p>
                <p class="card-text"><strong>Price per Night:</strong> ${{ number_format($booking->room->price_per_night, 2) ?? 'N/A' }}</p>
                <p class="card-text">
                    <strong>Room Status:</strong>
                    @if($booking->room->status == 'available')
                        <span class="badge badge-success">Available</span>
                    @else
                        <span class="badge badge-danger">Unavailable</span>
                    @endif
                </p>

                <!-- Display Room Image -->
                @if($booking->room->image)
                    <p class="card-text"><strong>Room Image:</strong></p>
                    <img src="{{ asset($booking->room->image) }}" alt="Room Image" class="img-fluid" style="width: 200px; height: auto; border-radius: 10px;">
                @endif

                <p class="card-text"><strong>Check-in Date:</strong> {{ \Carbon\Carbon::parse($booking->check_in_date)->format('Y-m-d') }}</p>
                <p class="card-text"><strong>Check-out Date:</strong> {{ \Carbon\Carbon::parse($booking->check_out_date)->format('Y-m-d') }}</p>

                <!-- Booking Status -->
                <p class="card-text">
                    <strong>Status:</strong>
                    @if($booking->status == 'pending')
                        <span class="badge badge-warning">Pending</span>
                    @elseif($booking->status == 'approved')
                        <span class="badge badge-success">Approved</span>
                    @elseif($booking->status == 'rejected')
                        <span class="badge badge-danger">Rejected</span>
                    @endif
                </p>

                <a href="{{ route('admin.bookings.index') }}" class="btn btn-orange">Back</a>
            </div>
        </div>
    </div>
@endsection
