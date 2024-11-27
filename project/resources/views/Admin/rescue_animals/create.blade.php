@extends('Admin.layouts.index')

@section('title', 'Add Rescue Animal')

@section('content')
<div class="container">
    <h1 class="mb-4">Add Rescue Animal</h1>

    <div class="card" style="background-color: #f6f5f5; padding: 20px;">
        <form action="{{ route('admin.rescue_animals.store') }}" method="POST">
            @csrf

            <!-- Pet Dropdown -->
            <div class="mb-3">
                <label for="pet_id" class="form-label">Pet</label>
                <select name="pet_id" id="pet_id" class="form-control" required>
                    @foreach($pets as $pet)
                        <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Total Required Amount Field -->
            <div class="mb-3">
                <label for="total_required_amount" class="form-label">Total Required Amount</label>
                <input type="number" name="total_required_amount" id="total_required_amount" class="form-control" required step="0.01">
            </div>

            <!-- Current Donated Amount Field -->
            <div class="mb-3">
                <label for="current_donated_amount" class="form-label">Current Donated Amount</label>
                <input type="number" name="current_donated_amount" id="current_donated_amount" class="form-control" step="0.01">
            </div>

            <!-- Description Field -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-orange">Add Rescue Animal</button>
        </form>
    </div>
</div>
@endsection
