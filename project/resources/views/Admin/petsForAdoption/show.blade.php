@extends('Admin.layouts.index')

@section('title', 'Pet Details')

@section('content')
<div class="container">
    <h1 class="mb-4">Pet Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $pet->name }}</h5>
            <p class="card-text"><strong>Breed:</strong> {{ $pet->breed }}</p>
            <p class="card-text"><strong>Age:</strong> {{ \Carbon\Carbon::parse($pet->birthday)->age }} years</p>
            <p class="card-text"><strong>Animal Type:</strong> {{ $pet->animalType->type_name }}</p>
            <img src="{{ asset('storage/' . $pet->image) }}" alt="{{ $pet->name }}" width="300">
        </div>
    </div>

    <a href="{{ route('admin.petsForAdoption.index') }}" class="btn btn-orange mt-3">Back to Pets</a>
</div>
@endsection
