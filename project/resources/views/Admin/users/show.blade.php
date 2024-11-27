<!-- resources/views/Admin/users/show.blade.php -->
@extends('Admin.layouts.index')

@section('title', 'User Details')

@section('content')
    <div class="container">
        <h1 class="mb-4">User Details</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $user->name }}</h5>
                <p class="card-text">Email: {{ $user->email }}</p>
                <p class="card-text">Role: {{ $user->role->name ?? 'N/A' }}</p>
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-orange">Edit</a>
                <a href="{{ route('admin.users.index') }}" class="btn btn-orange">Back</a>
            </div>
        </div>
    </div>
@endsection
