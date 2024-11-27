@extends('driver.layouts.index')

@section('title', 'Edit Driver Information')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Driver Information</h2>

    {{-- عرض أخطاء التحقق --}}
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
        <form action="{{ route('driver.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Driver Name Field -->
            <div class="form-group mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $driver->name) }}" required>
            </div>

            <!-- Driver Email Field -->
            <div class="form-group mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $driver->email) }}" required>
            </div>

            <!-- Driver Phone Field -->
            <div class="form-group mb-3">
                <label for="phone" class="form-label">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $driver->phone) }}" required>
            </div>

            <!-- Profile Image Field -->
            <div class="form-group mb-3">
                <label for="image" class="form-label">Profile Image:</label>
                <input type="file" class="form-control-file" id="image" name="image">
                @if($driver->image)
                    <img src="{{ asset($driver->image) }}" alt="Profile Image" width="100" height="100" class="mt-2">
                @endif
            </div>

            <!-- Update Button -->
            <button type="submit" class="btn btn-orange">Update Information</button>
        </form>
    </div>
</div>
@endsection
