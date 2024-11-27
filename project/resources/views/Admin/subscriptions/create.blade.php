@extends('Admin.layouts.index')

@section('title', 'Create New Subscription')

@section('content')

<div class="container mt-4">
    <h2 class="mb-4">Create New Subscription</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card p-4" style="background-color: #f6f5f5;">
        <form action="{{ route('admin.subscriptions.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Subscription Name Field -->
            <div class="form-group mb-3">
                <label for="name" class="form-label">Subscription Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter subscription name" required>
            </div>

            <!-- Description Field -->
            <div class="form-group mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" placeholder="Enter subscription description" required></textarea>
            </div>

            <!-- Price Field -->
            <div class="form-group mb-3">
                <label for="price" class="form-label">Price per Session</label>
                <input type="number" name="price" id="price" class="form-control" placeholder="Enter price per session" step="0.01" min="0" required>
            </div>

            <!-- Image Upload Field -->
            <div class="form-group mb-3">
                <label for="image" class="form-label">Subscription Image</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-orange">Create Subscription</button>
        </form>
    </div>
</div>

@endsection
