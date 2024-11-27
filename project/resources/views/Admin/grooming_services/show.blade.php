@extends('Admin.layouts.index')

@section('title', 'grooming Service Details')

@section('content')
<div class="container">
    <h1 class="mb-4">Grooming Service Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><strong>Name:</strong> {{ $groomingService->name }}</h5>
            <p class="card-text"><strong>Price:</strong> ${{ number_format($groomingService->price, 2) }}</p>
            <p class="card-text"><strong>Description:</strong> {{ $groomingService->description ?? 'No description available' }}</p>
            <a href="{{ route('admin.grooming_services.index') }}" class="btn btn-orange">Back</a>
        </div>
    </div>
</div>
@endsection
