@extends('Admin.layouts.index')

@section('title', 'rooms')

@section('content')

<div class="container">
    <h1>Create Room</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.rooms.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="room_name">Room Name</label>
            <input type="text" name="room_name" id="room_name" class="form-control" value="{{ old('room_name') }}">
        </div>

        <div class="form-group">
            <label for="room_type">Room Type</label>
            <input type="text" name="room_type" id="room_type" class="form-control" value="{{ old('room_type') }}">
        </div>

        <div class="form-group">
            <label for="price_per_night">Price per Night</label>
            <input type="number" step="0.01" name="price_per_night" id="price_per_night" class="form-control" value="{{ old('price_per_night') }}">
        </div>

        {{-- <div class="pet_appointment_colum">
            <h6><i class="fas fa-image" style="color: #ff8931;"></i> Room Image:</h6>
            <input type="file" name="image" class="form-control">
        </div> --}}

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="available">Available</option>
                <option value="unavailable">Unavailable</option>
            </select>
        </div>
        <div class="form-group">
            <label for="image">Room Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-orange">Create Room</button>
    </form>
</div>
@endsection
