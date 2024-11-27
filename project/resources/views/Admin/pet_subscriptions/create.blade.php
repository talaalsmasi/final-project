@extends('Admin.layouts.index')

@section('title', 'Create Pet Subscription')

@section('content')
<div class="container">
    <h2 class="mb-4">Create Pet Subscription</h2>

    <div class="card" style="background-color: #f6f5f5; padding: 20px;">
        <form action="{{ route('admin.pet_subscriptions.store') }}" method="POST">
            @csrf

            <!-- Pet Dropdown -->
            <div class="mb-3">
                <label for="pet_id" class="form-label">Pet</label>
                <select name="pet_id" id="pet_id" class="form-control">
                    @foreach ($pets as $pet)
                        <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Subscription Dropdown -->
            <div class="mb-3">
                <label for="subscription_id" class="form-label">Subscription</label>
                <select name="subscription_id" id="subscription_id" class="form-control">
                    @foreach ($subscriptions as $subscription)
                        <option value="{{ $subscription->id }}">{{ $subscription->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Month Field -->
            <div class="mb-3">
                <label for="month" class="form-label">Month</label>
                <input type="number" name="month" id="month" class="form-control" required>
            </div>

            <!-- Week Number Field -->
            <div class="mb-3">
                <label for="week_number" class="form-label">Week Number</label>
                <input type="number" name="week_number" id="week_number" class="form-control" required>
            </div>

            <!-- Session Time Field -->
            <div class="mb-3">
                <label for="session_time" class="form-label">Session Time</label>
                <input type="text" name="session_time" id="session_time" class="form-control" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-orange">Create Subscription</button>
        </form>
    </div>
</div>
@endsection
