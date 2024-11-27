@extends('doctor.layouts.index')

@section('title', 'Edit Post')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Post</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card p-4" style="background-color: #f6f5f5;">
        <form action="{{ route('doctor.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Title Field -->
            <div class="form-group mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}" required>
            </div>

            <!-- Content Field -->
            <div class="form-group mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea name="content" id="content" class="form-control" rows="5" required>{{ $post->content }}</textarea>
            </div>

            <!-- Image Field -->
            <div class="form-group mb-3">
                <label for="image" class="form-label">Image</label>
                @if($post->image)
                    <img src="{{ asset($post->image) }}" class="img-thumbnail mb-2" style="max-width: 200px;">
                @endif
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <!-- Buttons -->
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-orange">Update Post</button>
                <a href="{{ route('doctor.posts.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
