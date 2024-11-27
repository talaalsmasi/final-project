@extends('Admin.layouts.index')

@section('title', 'Posts')

@section('content')
<div class="container">
    <h1 class="mb-4">Posts</h1>
    {{-- <a href="{{ route('admin.posts.create') }}" class="btn btn-orange"><i class="fa-solid fa-plus"></i> Post</a><br><br> --}}

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Poster</th>
                <th>Content</th>
                <th>Image</th>
                {{-- <th>Likes</th> --}}
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td>{{ $post->title}}</td>
                <td>{{$post->user->name}}</td>
                <td>{{ $post->content }}</td>
                <td>
                    @if($post->image)
                        <img style="height: 50px;width:50px;border-radius:50%" src="{{ asset($post->image) }}" alt="Post Image" width="100">
                    @else
                        No image
                    @endif
                </td>
                {{-- <td>{{ $post->likes }}</td> --}}
                <td>
                    {{-- استبدال الأزرار بأيقونات --}}
                    <a href="{{ route('admin.posts.edit', $post->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background:none; border:none; color:#E17E2A; font-size:20px;" onclick="return confirm('Are you sure you want to delete this post?')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
