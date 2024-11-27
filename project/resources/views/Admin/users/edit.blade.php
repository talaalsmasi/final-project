@extends('Admin.layouts.index')

@section('title', 'Edit User')

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
        <h1 class="mb-4">Edit User</h1>
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" id="phone" value="{{ $user->phone }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
                <small>Leave blank to keep current password</small>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select name="role_id" id="role" class="form-control">
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">User Image</label>
                @if($user->image)
                    <img src="{{ asset($user->image) }}" alt="User Image" style="height: 100px; width: 100px; border-radius: 50%;">
                @endif
                <input type="file" name="image" class="form-control" id="image">
            </div>
            <button type="submit" class="btn btn-orange">Update</button>
        </form>
    </div>
   
@endsection
