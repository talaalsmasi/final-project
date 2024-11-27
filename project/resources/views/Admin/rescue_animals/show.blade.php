@extends('Admin.layouts.index')

@section('title', 'Rescue Animal Details')

@section('content')
<div class="container">
    <h1 class="mb-4">Rescue Animal Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><strong>Rescue Animal ID:</strong> {{ $rescueAnimal->id }}</h5>
            <p class="card-text"><strong>Pet:</strong> {{ $rescueAnimal->pet->name }}</p>
            <p class="card-text"><strong>Total Required Amount:</strong> ${{ number_format($rescueAnimal->total_required_amount, 2) }}</p>
            <p class="card-text"><strong>Current Donated Amount:</strong> ${{ number_format($rescueAnimal->current_donated_amount, 2) }}</p>
            <p class="card-text"><strong>Description:</strong> {{ $rescueAnimal->description }}</p>
            <a href="{{ route('admin.rescue_animals.index') }}" class="btn btn-orange">Back to List</a>
            <a href="{{ route('admin.rescue_animals.edit', $rescueAnimal->id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection
