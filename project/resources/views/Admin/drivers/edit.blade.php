@extends('Admin.layouts.index')

@section('title', 'Edit Driver')

@section('content')
<div class="container">
    <h2>Edit Driver</h2>

    <div class="card mt-4" style="background-color: #f6f5f5; padding: 20px;">
        <form action="{{ route('admin.drivers.update', $driver->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Select User -->
            <div class="mb-3">
                <label for="user_id" class="form-label">User</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $driver->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Availability -->
            <div class="mb-3">
                <label for="available" class="form-label">Available</label>
                <select name="available" id="available" class="form-control" required>
                    <option value="1" {{ $driver->available ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ !$driver->available ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-orange">Update Driver</button>
        </form>
    </div>
</div>
@endsection
