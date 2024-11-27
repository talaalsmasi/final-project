@extends('Admin.layouts.index')

@section('title', 'Edit Pet')

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
    <h1 class="mb-4">Edit Pet</h1>
    <div class="card" style="background-color: #f6f5f5; padding: 20px;">
        <form action="{{ route('admin.pets.update', $pet->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Name Field -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $pet->name }}" required>
            </div>

            <!-- Animal Type Dropdown -->
            <div class="mb-3">
                <label for="animal_type" class="form-label">Animal Type</label>
                <select name="animal_type_id" id="animal_type" class="form-control">
                    <option value="">Select Animal Type</option>
                    @foreach($animalTypes as $animalType)
                        <option value="{{ $animalType->id }}" {{ $animalType->id == $pet->animal_type_id ? 'selected' : '' }}>{{ $animalType->type_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Breed Field -->
            <div class="mb-3">
                <label for="breed" class="form-label">Breed</label>
                <input type="text" name="breed" class="form-control" id="breed" value="{{ $pet->breed }}">
            </div>

            <!-- Birthday Field -->
            <div class="mb-3">
                <label for="birthday" class="form-label">Birthday</label>
                <input type="date" name="birthday" class="form-control" id="birthday" value="{{ $pet->birthday }}">
            </div>

            <!-- Image Upload -->
            <div class="mb-3">
                <label for="image" class="form-label"><i class="fas fa-image" style="color: #ff8931;"></i> Pet Image</label>
                <input type="file" name="image" class="form-control" id="image">
                @if($pet->image)
                    <img src="{{ asset('storage/' . $pet->image) }}" alt="{{ $pet->name }}" class="img-thumbnail mt-2" width="150">
                @endif
            </div>

            <!-- Owner Dropdown -->
            <div class="mb-3">
                <label for="user_id" class="form-label">Owner</label>
                <select name="user_id" class="form-control" id="user_id" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $user->id == $pet->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-orange">Update Pet</button>
        </form>
    </div>
</div>
@endsection
