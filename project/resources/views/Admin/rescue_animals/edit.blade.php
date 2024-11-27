@extends('Admin.layouts.index')

@section('title', 'Edit Rescue Animal')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Rescue Animal</h1>

    <div class="card" style="background-color: #f6f5f5; padding: 20px;">
        <form action="{{ route('admin.rescue_animals.update', $rescueAnimal->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Pet Dropdown -->
            <div class="mb-3">
                <label for="pet_id" class="form-label">Pet</label>
                <select name="pet_id" id="pet_id" class="form-control" required>
                    @foreach($pets as $pet)
                        <option value="{{ $pet->id }}" {{ $pet->id == $rescueAnimal->pet_id ? 'selected' : '' }}>
                            {{ $pet->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Total Required Amount Field -->
            <div class="mb-3">
                <label for="total_required_amount" class="form-label">Total Required Amount</label>
                <input type="number" name="total_required_amount" id="total_required_amount" class="form-control" required step="0.01" value="{{ $rescueAnimal->total_required_amount }}">
            </div>

            <!-- Current Donated Amount Field -->
            <div class="mb-3">
                <label for="current_donated_amount" class="form-label">Current Donated Amount</label>
                <input type="number" name="current_donated_amount" id="current_donated_amount" class="form-control" step="0.01" value="{{ $rescueAnimal->current_donated_amount }}">
            </div>

            <!-- Description Field -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control">{{ $rescueAnimal->description }}</textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-orange">Update Rescue Animal</button>
        </form>
    </div>
</div>
@endsection
