@extends('Admin.layouts.index')

@section('title', 'Edit Grooming Service')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Grooming Service</h2>

    <div class="card" style="background-color: #f6f5f5; padding: 20px;">
        <form action="{{ route('admin.grooming_services.update', $groomingService->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Service Name Field -->
            <div class="mb-3">
                <label for="name" class="form-label">Service Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $groomingService->name }}" required>
            </div>

            <!-- Price Field -->
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ $groomingService->price }}" required>
            </div>

            <!-- Description Field -->
            <div class="mb-3">
                <label for="description" class="form-label">Description (Optional)</label>
                <textarea name="description" id="description" class="form-control">{{ $groomingService->description }}</textarea>
            </div>

            <!-- Update Button -->
            <button type="submit" class="btn btn-orange">Update</button>
        </form>
    </div>
</div>
@endsection
