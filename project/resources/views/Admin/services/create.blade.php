@extends('Admin.layouts.index')

@section('title', 'Add New Service')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
    <h1 class="mb-4">Add New Service</h1>

    <div class="card" style="background-color: #f6f5f5; padding: 20px;">
        <form action="{{ route('admin.services.store') }}" method="POST">
            @csrf

            <!-- Service Name Field -->
            <div class="form-group mb-3">
                <label for="name" class="form-label">Service Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter service name" required>
            </div>

            <!-- Price Field -->
            <div class="form-group mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" name="price" id="price" class="form-control" placeholder="Enter service price" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-orange">Save</button>
        </form>
    </div>
</div>
@endsection
