<!-- resources/views/Admin/doctors/edit.blade.php -->
@extends('Admin.layouts.index')

@section('title', 'Edit Doctor')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
    <h2>Edit Doctor</h2>

    <div class="card mt-4" style="background-color: #f6f5f5; padding: 20px;">
        <form action="{{ route('admin.doctors.update', $doctor->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Select User -->
            <div class="mb-3">
                <label for="user_id" class="form-label">Select User</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <option value="" disabled>Select a user</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $user->id == $doctor->user_id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- About -->
            <div class="mb-3">
                <label for="about" class="form-label">About</label>
                <input type="text" name="about" id="about" class="form-control" value="{{ $doctor->about }}" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-orange">Update</button>
        </form>
    </div>
</div>
@endsection
