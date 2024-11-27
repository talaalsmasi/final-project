@extends('Admin.layouts.index')

@section('title', 'Donation Details')

@section('content')
<div class="container">
    <h1 class="mb-4">Donation Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><strong>Donation ID:</strong> {{ $donation->id }}</h5>
            <p class="card-text"><strong>Rescue Animal:</strong> {{ $donation->rescueAnimal->pet->name }}</p>
            <p class="card-text"><strong>Donor:</strong> {{ $donation->user->name }}</p>
            <p class="card-text"><strong>Amount:</strong> ${{ number_format($donation->amount, 2) }}</p>
            <p class="card-text"><strong>Donation Date:</strong> {{ $donation->created_at->format('Y-m-d H:i') }}</p>

            <a href="{{ route('admin.donations.index') }}" class="btn btn-orange">Back to List</a>
            <a href="{{ route('admin.donations.edit', $donation->id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection
