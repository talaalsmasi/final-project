@extends('Admin.layouts.index')

@section('title', 'rooms')

@section('content')
<div class="container">
    <h1>Rooms</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.rooms.create') }}" class="btn btn-orange"><i class="fa-solid fa-plus"></i> Room</a><br><br>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Type</th>
                <th>Price per Night</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rooms as $room)
                <tr>
                    <td>{{ $room->room_name }}</td>
                    <td>
                        @if($room->image)
                            <img style="height: 50px;width:50px;border-radius:50%" src="{{ asset($room->image) }}" alt="Post Image" width="100">
                        @else
                            No image
                        @endif
                    </td>
                    <td>{{ $room->room_type }}</td>
                    <td>${{ $room->price_per_night }}</td>
                    <td>{{ ucfirst($room->status) }}</td>
                    <td>
                        {{-- استبدال الأزرار بأيقونات --}}
                        {{-- <a href="{{ route('admin.rooms.show', $room->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;">
                            <i class="fa-solid fa-eye"></i>
                        </a> --}}
                        <a href="{{ route('admin.rooms.edit', $room->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:none; border:none; color:#E17E2A; font-size:20px;" onclick="return confirm('Are you sure you want to delete this room?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
