@extends('Admin.layouts.index')

@section('title', 'Create New Post')

@section('content')
<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1 class="mb-4">Create New Post</h1>

    <div class="card" style="background-color: #f6f5f5; padding: 20px;">
        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Title Field -->
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>

            <!-- Content Field -->
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea name="content" class="form-control" required>{{ old('content') }}</textarea>
            </div>

            <!-- Image Upload -->
            <div class="mb-3">
                <label for="image" class="form-label"><i class="fas fa-image" style="color: #ff8931;"></i> Image (Optional)</label>
                <input type="file" name="image" class="form-control">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-orange">Create Post</button>
        </form>
    </div>
</div>
@endsection
