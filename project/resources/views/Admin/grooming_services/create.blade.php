@extends('Admin.layouts.index')

@section('title', 'Add Brooming Service')

@section('content')
<div class="container">
    <h2 class="mb-4">Add Brooming Service</h2>

    <div class="card" style="background-color: #f6f5f5; padding: 20px;">
        <form action="{{ route('admin.grooming_services.store') }}" method="POST">
            @csrf

            <!-- Service Name Field -->
            <div class="mb-3">
                <label for="name" class="form-label">Service Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <!-- Price Field -->
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" name="price" id="price" class="form-control" required>
            </div>

            <!-- Description Field -->
            <div class="mb-3">
                <label for="description" class="form-label">Description (Optional)</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-orange">Save</button>
        </form>
    </div>
</div>
@endsection
