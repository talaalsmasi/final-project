@extends('Admin.layouts.index')

@section('title', 'Edit Donation')

@section('content')
<div class="container">
    <h2>Edit Donation</h2>

    <div class="card mt-4" style="background-color: #f6f5f5; padding: 20px;">
        <form action="{{ route('admin.donations.update', $donation->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Rescue Animal Selection -->
            <div class="mb-3">
                <label for="rescue_animal_id" class="form-label">Rescue Animal</label>
                <select name="rescue_animal_id" id="rescue_animal_id" class="form-control" required>
                    <option value="" disabled>Select Rescue Animal</option>
                    @foreach($rescueAnimals as $animal)
                        <option value="{{ $animal->id }}" {{ $animal->id == $donation->rescue_animal_id ? 'selected' : '' }}>
                            {{ $animal->pet->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Donor Selection -->
            <div class="mb-3">
                <label for="user_id" class="form-label">Donor</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <option value="" disabled>Select Donor</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $user->id == $donation->user_id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Donation Amount -->
            <div class="mb-3">
                <label for="amount" class="form-label">Amount</label>
                <input type="number" name="amount" id="amount" class="form-control" required step="0.01" value="{{ $donation->amount }}" placeholder="Enter amount">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-orange">Update Donation</button>
        </form>
    </div>
</div>
@endsection