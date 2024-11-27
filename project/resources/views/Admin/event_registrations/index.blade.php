@extends('Admin.layouts.index')

@section('title', 'Events reg')

@section('content')

<div class="container">
    <h1 class="mb-4">All Event Registrations</h1>
<a href="{{ route('admin.event-registrations.create') }}" class="btn btn-orange mb-4"><i class="fa-solid fa-plus"></i> Registration</a>


@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>User</th>
            <th>Event</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($registrations as $registration)
            <tr>
                <td>{{ $registration->user->name }}</td>
                <td>{{ $registration->event->title }}</td>
                <td>
                    <a href="{{ route('admin.event-registrations.edit', $registration->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;">
                        <i class="fa-solid fa-pen-to-square"></i> <!-- أيقونة التعديل -->
                    </a>
                    <form action="{{ route('admin.event-registrations.destroy', $registration->id) }}" method="POST" style="display:inline-block;">
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
