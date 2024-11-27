@extends('Admin.layouts.index')

@section('title', 'Feedback')

@section('content')
<div class="container">
    <div class="container">
        <h1 class="mb-4">All Ratings</h1>
        {{-- <a href="{{ route('admin.feedback.create') }}" class="btn btn-orange"><i class="fa-solid fa-plus"></i> Rating</a><br><br> --}}

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Rating</th>
                    
                    <th>Feedback</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ratings as $rating)
                <tr>
                    <td>{{ $rating->user->name }}</td>
                    <td>{{ $rating->rating }}</td>
                    <td>{{ Str::limit($rating->feedback, 50) }}</td>
                    <td>
                        {{-- استبدال الأزرار بأيقونات --}}
                        {{-- <a href="{{ route('admin.feedback.show', $rating->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.feedback.edit', $rating->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a> --}}
                        <form action="{{ route('admin.feedback.destroy', $rating->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:none; border:none; color:#E17E2A; font-size:20px;" onclick="return confirm('Are you sure you want to delete this feedback?')">
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
