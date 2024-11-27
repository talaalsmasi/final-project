@extends('Admin.layouts.index')

@section('title', 'rooms')

@section('content')
<div class="container">
    <h1>Room Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $room->room_name }}</h5>
            <p class="card-text">Type: {{ $room->room_type }}</p>
            <p class="card-text">Price per Night: ${{ $room->price_per_night }}</p>
            <p class="card-text">Status: {{ ucfirst($room->status) }}</p>
        </div>
    </div>

    <a href="{{ route('admin.rooms.index') }}" class="btn btn-orange">Back to Rooms</a>
</div>
@endsection
