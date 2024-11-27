@extends('Admin.layouts.index')

@section('title', 'Events')

@section('content')

<div class="container">
    <h1 class="mb-4">All Events</h1>
<a href="{{ route('admin.events.create') }}" class="btn btn-orange mb-4"><i class="fa-solid fa-plus"></i> Event</a>


    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Capacity</th>
                <th>Registered</th>
                <th>Date</th>
                <th>Time</th>
                <th>image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
                <tr>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->description }}</td>
                    <td>{{ $event->capacity }}</td>
                    <td>{{ $event->registered_count }}</td>
                    <td>{{ $event->event_date }}</td>
                    <td>{{ $event->event_time }}</td>
                    <td>
                        @if($event->image)
                            <img style="height: 50px;width:50px;border-radius:50%" src="{{ asset($event->image) }}" alt="Post Image" width="100">
                        @else
                            No image
                        @endif
                        <td>
                            <a href="{{ route('admin.events.edit', $event->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;">
                                <i class="fa-solid fa-pen-to-square"></i> <!-- أيقونة التعديل -->
                            </a>
                            <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background:none; border:none; color:#E17E2A; font-size:20px;" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash-alt"></i> <!-- أيقونة الحذف -->
                                </button>
                            </form>
                        </td>

                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
