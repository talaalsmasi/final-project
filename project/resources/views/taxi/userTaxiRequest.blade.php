@extends('layouts.index')
@section('from', 'Profile')
@section('title', 'Show Your Taxi Requests')
@section('content')

<section class="pet_appointment_wrap">
    <div class="container">
        <h2>Your Taxi Requests</h2>

        <div class="row">
            @foreach($userTaxiRequests as $request)
                <div class="col-md-6">
                    <div class="card mb-3" style="background-color: #f6f5f5; background-image: url('{{ asset('images/service-bg-paw.png') }}'); box-shadow: 0px 6px 12px -1px #ddd; border: none; border-radius: 8px; position: relative;">
                        <div class="card-body" style="padding: 20px;">
                            <div class="appointment-details">
                                @if($request->created_at)
                                    <h5><i class="fa-solid fa-calendar-days" style="color: #ff8b27;"></i> <strong>Request Date:</strong> {{ $request->created_at->format('d M Y') }}</h5>
                                @else
                                    <p><i class="fa-solid fa-calendar-days" style="color: #ff8b27;"></i> <strong>Request Date:</strong> N/A</p>
                                @endif
                                <p><i class="fa-solid fa-user" style="color: #ff8b27;"></i> <strong> Driver Name:</strong> {{ $request->driver->user->name }}</p>
                                <p><i class="fa-solid fa-phone" style="color: #ff8b27;"></i> <strong> Driver Phone:</strong> {{ $request->driver->user->phone }}</p>
                                <p><i class="fa-solid fa-route" style="color: #ff8b27;"></i> <strong> Trip Type:</strong> {{ ucfirst($request->trip_type) }}</p>
                                <p><i class="fa-solid fa-money-bill-wave" style="color: #ff8b27;"></i> <strong> Price:</strong> {{ number_format($request->price, 2) }} JD</p>
                                <p><i class="fa-solid fa-info-circle" style="color: #ff8b27;"></i> <strong> Status:</strong>
                                    <span class="{{ $request->status === 'approved' ? 'text-success' : ($request->status === 'pending' ? 'text-warning' : 'text-danger') }}">
                                        {{ ucfirst($request->status) }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div><br>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
