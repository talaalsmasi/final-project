@extends('layouts.index')
@section('from', 'Profile')
@section('title', 'show bookings')
@section('content')  <br>
            <section class="pet_appointment_wrap">
                <div class="container">
                    <h2>Booking Details</h2>

                    @if($bookings->isEmpty())
                        <p>No bookings found for this pet.</p>
                    @else
                        <div class="row">
                            @foreach ($bookings as $booking)
                                <div class="col-md-6">
                                    <div class="card mb-3" style="background-color: #f6f5f5; background-image: url('{{ asset('images/service-bg-paw.png') }}'); box-shadow: 0px 6px 12px -1px #ddd; border: none; border-radius: 8px;">
                                        <div class="card-body" style="padding: 20px; display: flex; justify-content: space-between; align-items: flex-start;">
                                            <div class="booking-details">
                                                <h5><strong><i class="fas fa-paw" style="color: #ff8931;"></i> Pet Details</strong></h5>
                                                <p><strong>Pet Name:</strong> {{ optional($booking->pet)->name }}</p>
                                                <p><strong>Breed:</strong> {{ optional($booking->pet)->breed ?? 'Unknown' }}</p>
                                                <p><strong>Animal Type:</strong> {{ optional($booking->pet->animalType)->type_name ?? 'Unknown' }}</p>

                                                @if (isset($booking->pet->birthday))
                                                    @php
                                                        $birthday = \Carbon\Carbon::parse($booking->pet->birthday);
                                                        $now = \Carbon\Carbon::now();
                                                        $ageYears = $birthday->diffInYears($now);
                                                        $ageMonths = $birthday->diffInMonths($now) % 12;
                                                    @endphp

                                                    <p>
                                                        <strong>Age:</strong>
                                                        @if ($ageYears > 0)
                                                            {{ $ageYears }} years
                                                        @endif
                                                        @if ($ageMonths > 0)
                                                            {{ $ageMonths }} months
                                                        @endif
                                                    </p>
                                                @else
                                                    <p><strong>Age:</strong> Unknown</p>
                                                @endif <br>

                                                <h5><strong><i class="fas fa-home" style="color: #ff8931;"></i> Room Details</strong></h5>
                                                <p><strong>Room Name:</strong> {{ optional($booking->room)->room_name }}</p>
                                                <p><strong>Room Type:</strong> {{ optional($booking->room)->room_type }}</p>
                                                <p><strong>Price Per Night:</strong> {{ optional($booking->room)->price_per_night }}JD</p> <br>

                                                <h5><strong><i class="fas fa-calendar-alt" style="color: #ff8931;"></i> Booking Details</strong></h5>
                                                <p><strong>Check-in Date:</strong> {{ \Carbon\Carbon::parse($booking->check_in_date)->format('Y-m-d') }}</p>
                                                <p><strong>Check-out Date:</strong> {{ \Carbon\Carbon::parse($booking->check_out_date)->format('Y-m-d') }}</p><br>

                                                <h5><strong><i class="fas fa-clock" style="color: #ff8931;"></i> Time Remaining</strong></h5>
                                                @php
                                                    $checkInDateTime = \Carbon\Carbon::parse($booking->check_in_date);
                                                    $timeRemaining = $now->diff($checkInDateTime);
                                                @endphp

                                                @if ($timeRemaining->invert)
                                                    <p>Check-in has already occurred.</p>
                                                @else
                                                    <p>{{ $timeRemaining->days }} days, {{ $timeRemaining->h }} hours, and {{ $timeRemaining->i }} minutes</p>
                                                @endif

                                                <p><strong>Status:</strong>
                                                    <span class="{{ $booking->status === 'approved' ? 'text-success' : ($booking->status === 'pending' ? 'text-warning' : 'text-danger') }}">
                                                        {{ ucfirst($booking->status) }}
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="booking-actions" style="margin-left: auto;">
                                                @if ($booking->status === 'approved' && $checkInDateTime->isPast())
                                                    <form action="{{ route('ratings.show', $booking->id) }}" method="GET" style="display:inline;">
                                                        @csrf
                                                        <button class="btn btn-primary">Rate Your Visit</button>
                                                    </form>
                                                @endif
                                                {{-- <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this booking?')">Delete</button>
                                                </form> --}}
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
