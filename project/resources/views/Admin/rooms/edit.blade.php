@extends('Admin.layouts.index')

@section('title', 'Edit Room')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Room</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card" style="background-color: #f6f5f5; padding: 20px;">
        <form action="{{ route('admin.rooms.update', $room->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Room Name Field -->
            <div class="form-group mb-3">
                <label for="room_name" class="form-label">Room Name</label>
                <input type="text" name="room_name" id="room_name" class="form-control" value="{{ $room->room_name }}" required>
            </div>

            <!-- Room Type Field -->
            <div class="form-group mb-3">
                <label for="room_type" class="form-label">Room Type</label>
                <input type="text" name="room_type" id="room_type" class="form-control" value="{{ $room->room_type }}" required>
            </div>

            <!-- Price per Night Field -->
            <div class="form-group mb-3">
                <label for="price_per_night" class="form-label">Price per Night</label>
                <input type="number" step="0.01" name="price_per_night" id="price_per_night" class="form-control" value="{{ $room->price_per_night }}" required>
            </div>

            <!-- Room Status Field -->
            <div class="form-group mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="available" {{ $room->status == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="unavailable" {{ $room->status == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-orange">Update Room</button>
        </form>
    </div>
</div>
@endsection
