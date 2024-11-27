<!-- resources/views/Admin/doctors/show.blade.php -->
@extends('Admin.layouts.index')

@section('title', 'Doctor Details')

@section('content')
    <div class="container">
        <h1 class="mb-4">Doctor Details</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $doctor->user->name }}</h5>
                <p class="card-text">About: {{ $doctor->about }}</p>
                <a href="{{ route('admin.doctors.edit', $doctor->id) }}" class="btn btn-orange">Edit</a>
                <a href="{{ route('admin.doctors.index') }}" class="btn btn-orange">Back</a>
            </div>
        </div>
    </div>
@endsection
