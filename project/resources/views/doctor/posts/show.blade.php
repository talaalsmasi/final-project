@extends('doctor.layouts.index')

@section('title', 'View Post')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">View Post</h2>

    <div class="card p-4" style="background-color: #f6f5f5;">
        <h3 class="card-title">{{ $post->title }}</h3>

        @if($post->image)
            <img src="{{ asset( $post->image) }}" alt="Post Image" class="img-fluid mb-3 rounded">
        @endif

        <p class="card-text">{{ $post->content }}</p>

        <a href="{{ route('doctor.posts.index') }}" class="btn btn-orange mt-3">Back to Posts</a>
        <a href="{{ route('doctor.posts.edit', $post->id) }}" class="btn btn-orange mt-3">edit the Posts</a>

    </div>
</div>
@endsection
