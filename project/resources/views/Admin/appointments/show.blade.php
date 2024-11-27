@extends('Admin.layouts.index')

@section('title', 'Appointment Details')

@section('content')
    <div class="container">
        <h1 class="mb-4">Appointment Details</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Appointment ID: {{ $appointment->id }}</h5>
                <p class="card-text"><strong>Owner:</strong> {{ $appointment->user->name }}</p>
                <p class="card-text"><strong>Pet:</strong> {{ $appointment->pet->name }}</p>
                <p class="card-text"><strong>Doctor:</strong> {{ $appointment->doctor->name }}</p>
                <p class="card-text"><strong>Service:</strong> {{ $appointment->service->name }}</p>
                <p class="card-text"><strong>Date:</strong> {{ $appointment->appointment_date }}</p>
                <a href="{{ route('admin.appointments.index') }}" class="btn btn-orange">Back</a>
            </div>
        </div>
    </div>
@endsection
