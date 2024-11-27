@extends('Admin.layouts.index')

@section('title', 'Adoption Request Details')

@section('content')
<div class="container">
    <h1 class="mb-4">Adoption Request Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $adoption->pet->name }}</h5>
            <p class="card-text"><strong>User:</strong> {{ $adoption->user->name }}</p>
            <p class="card-text"><strong>Reason:</strong> {{ $adoption->reason }}</p>
            <p class="card-text"><strong>Status:</strong> {{ ucfirst($adoption->status) }}</p>
        </div>
    </div>

    <a href="{{ route('admin.adoptions.index') }}" class="btn btn-orange mt-3">Back to Adoption Requests</a>
</div>
@endsection
