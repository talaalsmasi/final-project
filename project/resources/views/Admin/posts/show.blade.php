@extends('Admin.layouts.index')

@section('title', 'Posts')

@section('content')
<div class="container">
    <h1>Post Details</h1>

    <div class="card">
        <div class="card-header">
            <h3>{{ $post->title }}</h3>
        </div>

        <div class="card-body">
            <!-- عرض المحتوى -->
            <p><strong>Content:</strong> {{ $post->content }}</p>

            <!-- عرض الصورة إن وجدت -->
            @if($post->image)
                <div class="post-image">
                    <img src="{{ asset($post->image) }}" alt="Post Image" style="max-width: 300px;">
                </div>
            @else
                <p>No image available.</p>
            @endif

            <!-- عرض عدد الإعجابات -->
            <p><strong>Likes:</strong> {{ $post->likes }}</p>
        </div>

        <div class="card-footer">
            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>

            <!-- زر الحذف -->
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>

            <!-- العودة إلى قائمة المنشورات -->
            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Back to Posts</a>
        </div>
    </div>
</div>
@endsection
