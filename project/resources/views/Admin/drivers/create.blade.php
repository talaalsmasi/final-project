@extends('Admin.layouts.index')

@section('title', 'Add New Driver')

@section('content')
<div class="container">
    <h2>Add New Driver</h2>

    <div class="card mt-4" style="background-color: #f6f5f5; padding: 20px;">
        <form action="{{ route('admin.drivers.store') }}" method="POST">
            @csrf

            <!-- Select User -->
            <div class="mb-3">
                <label for="user_id" class="form-label">User</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <option value="" disabled selected>Select User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Availability -->
            <div class="mb-3">
                <label for="available" class="form-label">Available</label>
                <select name="available" id="available" class="form-control" required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-orange">Add Driver</button>
        </form>
    </div>
</div>
@endsection
