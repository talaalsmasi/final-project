@extends('Admin.layouts.index')

@section('title', 'Edit Subscription')

@section('content')

<div class="container mt-4">
    <h2 class="mb-4">Edit Subscription</h2>

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
        <form action="{{ route('admin.subscriptions.update', $subscription->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Subscription Name Field -->
            <div class="form-group mb-3">
                <label for="name" class="form-label">Subscription Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $subscription->name }}" required>
            </div>

            <!-- Description Field -->
            <div class="form-group mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" required>{{ $subscription->description }}</textarea>
            </div>

            <!-- Price Field -->
            <div class="form-group mb-3">
                <label for="price" class="form-label">Price per Session</label>
                <input type="number" name="price" id="price" class="form-control" step="0.01" min="0" value="{{ $subscription->price }}" required>
            </div>

            <!-- Image Upload Field -->
            <div class="form-group mb-3">
                <label for="image" class="form-label">Subscription Image</label>
                <input type="file" name="image" id="image" class="form-control">
                @if($subscription->image)
                    <div class="mt-2">
                        <img src="{{ asset($subscription->image) }}" alt="Subscription Image" class="img-thumbnail" style="width: 150px;">
                    </div>
                @endif
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-orange">Update Subscription</button>
        </form>
    </div>
</div>

@endsection
