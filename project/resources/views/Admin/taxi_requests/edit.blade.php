@extends('Admin.layouts.index')

@section('title', 'Edit Taxi Request')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Taxi Request</h2>

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
        <form action="{{ route('admin.taxi_requests.update', $taxiRequest->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- User Selection Field -->
            <div class="form-group mb-3">
                <label for="user_id" class="form-label">User</label>
                <select name="user_id" class="form-control" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $user->id == $taxiRequest->user_id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Driver Selection Field -->
            <div class="form-group mb-3">
                <label for="driver_id" class="form-label">Driver</label>
                <select name="driver_id" class="form-control" required>
                    @foreach($drivers as $driver)
                        <option value="{{ $driver->id }}" {{ $driver->id == $taxiRequest->driver_id ? 'selected' : '' }}>
                            {{ $driver->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Status Field -->
            <div class="form-group mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" class="form-control" required>
                    <option value="pending" {{ $taxiRequest->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ $taxiRequest->status == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="completed" {{ $taxiRequest->status == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <!-- Trip Type Field -->
            <div class="form-group mb-3">
                <label for="trip_type" class="form-label">Trip Type</label>
                <select name="trip_type" class="form-control" required>
                    <option value="one_way" {{ $taxiRequest->trip_type == 'one_way' ? 'selected' : '' }}>One Way</option>
                    <option value="round_trip" {{ $taxiRequest->trip_type == 'round_trip' ? 'selected' : '' }}>Round Trip</option>
                </select>
            </div>

            <!-- Price Field -->
            <div class="form-group mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" name="price" class="form-control" value="{{ $taxiRequest->price }}" required>
            </div>

            <button type="submit" class="btn btn-orange">Update Taxi Request</button>
        </form>
    </div>
</div>
@endsection
