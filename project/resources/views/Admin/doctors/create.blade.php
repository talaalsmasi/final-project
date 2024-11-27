<!-- resources/views/Admin/doctors/create.blade.php -->
@extends('Admin.layouts.index')

@section('title', 'Add New Doctor')

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
    <h2>Add New Doctor</h2>

    <div class="card mt-4" style="background-color: #f6f5f5; padding: 20px;">
        <form action="{{ route('admin.doctors.store') }}" method="POST">
            @csrf

            <!-- Select User -->
            <div class="mb-3">
                <label for="user_id" class="form-label">Select User</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <option value="" disabled selected>Select a user</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- About -->
            <div class="mb-3">
                <label for="about" class="form-label">About</label>
                <input type="text" name="about" class="form-control" id="about" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-orange">Save</button>
        </form>
    </div>
</div>
@endsection
