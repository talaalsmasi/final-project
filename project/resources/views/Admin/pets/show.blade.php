@extends('Admin.layouts.index')

@section('title', 'Pet Details')

@section('content')

    <div class="container">
        <h1 class="mb-4">Pet Details</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $pet->name }}</h5>
                <p class="card-text"><strong>Animal Type:</strong> {{ $pet->animalType->name }}</p>
                <p class="card-text"><strong>Breed:</strong> {{ $pet->breed }}</p>
                <p class="card-text"><strong>Birthday:</strong> {{ $pet->birthday }}</p>
                <p class="card-text"><strong>Owner:</strong> {{ $pet->user->name }}</p>
                <p class="card-text"><strong>Appointments:</strong>
                    @if($pet->appointments->count() > 0)
                        <ul>
                            @foreach($pet->appointments as $appointment)
                                <li>{{ $appointment->service->name }} on {{ $appointment->appointment_date }}</li>
                            @endforeach
                        </ul>
                    @else
                        No appointments
                    @endif
                </p>
                <a href="{{ route('admin.pets.edit', $pet->id) }}" class="btn btn-orange">Edit</a>
                <a href="{{ route('admin.pets.index') }}" class="btn btn-orange">Back</a>
            </div>
        </div>
    </div>
  
@endsection
