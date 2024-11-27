@extends('doctor.layouts.index')

@section('title', 'Edit Doctor Information')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Doctor Information</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card p-4" style="background-color: #f6f5f5;">
        <form action="{{ route('doctor.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Doctor Name Field -->
            <div class="form-group mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $doctor->name) }}" required>
            </div>

            <!-- Doctor Email Field -->
            <div class="form-group mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $doctor->email) }}" required>
            </div>

            <!-- Doctor Phone Field -->
            <div class="form-group mb-3">
                <label for="phone" class="form-label">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $doctor->phone) }}" required>
            </div>

            <!-- About Doctor Field -->
            <div class="form-group mb-3">
                <label for="about" class="form-label">About:</label>
                <textarea class="form-control" id="about" name="about" rows="4">{{ old('about', $doctor->doctor->about ?? '') }}</textarea>
            </div>

            <!-- Profile Image Field -->
            <div class="form-group mb-3">
                <label for="image" class="form-label">Profile Image:</label>
                <input type="file" class="form-control-file" id="image" name="image">
                @if($doctor->image)
                    <img src="{{ asset($doctor->image) }}" alt="Profile Image" width="100" height="100" class="mt-2">
                @endif
            </div>

            <!-- Update Button -->
            <button type="submit" class="btn btn-orange">Update Information</button>
        </form>
    </div>
</div>
@endsection
