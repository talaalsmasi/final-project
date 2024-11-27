@extends('Admin.layouts.index')

@section('title', 'Grooming Appointment Details')

@section('content')
<div class="container">
    <h1 class="mb-4">Grooming Appointment Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><strong>Owner:</strong> {{ $grooming->user->name }}</h5>
            <p class="card-text"><strong>Pet:</strong> {{ $grooming->pet->name }}</p>
            <p class="card-text"><strong>Service:</strong> {{ $grooming->service->name }}</p>
            <p class="card-text"><strong>Date:</strong> {{ $grooming->appointment_date }}</p>
            <p class="card-text"><strong>Time:</strong> {{ $grooming->appointment_time }}</p>
            <p class="card-text"><strong>Status:</strong> {{ ucfirst($grooming->status) }}</p>
            <a href="{{ route('admin.grooming.index') }}" class="btn btn-orange">Back</a>
        </div>
    </div>
</div>
@endsection
