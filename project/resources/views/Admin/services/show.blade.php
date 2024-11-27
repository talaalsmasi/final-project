@extends('Admin.layouts.index')

@section('title', 'Service Details')

@section('content')
    <div class="container">
        <h1 class="mb-4">Service Details</h1>
        <div class="mb-3">
            <strong>Name:</strong> {{ $service->name }}
        </div>
        <div class="mb-3">
            <strong>Price:</strong> ${{ $service->price }}
        </div>
        <a href="{{ route('admin.services.index') }}" class="btn btn-orange">Back to Services</a>
@endsection
