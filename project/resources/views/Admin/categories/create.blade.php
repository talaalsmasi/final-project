@extends('Admin.layouts.index')

@section('title', 'Create Category')

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
    <h2>Create New Category</h2>

    <div class="card" style="background-color: #f6f5f5; padding: 20px;">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <!-- Category Name -->
            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <!-- Category Description -->
            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-orange">Save</button>
        </form>
    </div>
</div>

@endsection
