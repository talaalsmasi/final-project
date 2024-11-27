@extends('doctor.layouts.index')
@section('title', 'posts')
@section('content')
<div class="container">
    <h1 class="mb-4">My Posts</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <a href="{{ route('doctor.posts.create') }}" class="btn btn-orange"><i class="fa-solid fa-plus"></i> Post</a><br><br>

    <div class="row">
        @foreach($posts as $post)
            <div class="col-md-4">
                <div class="card mb-3" style="height: 70vh">
                    @if($post->image)
                        <img style="height: 40vh;width:40vh" src="{{ asset( $post->image) }}" class="card-img-top" alt="Post Image">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>

                        <!-- View Icon (Eye) -->
                       <div style="margin-left: 20%">
                        <a href="{{ route('doctor.posts.show', $post->id) }}" class="btn" style="color: #ff8b27;">
                            <i class="fas fa-eye"></i>
                        </a>

                        <!-- Edit Icon (Pencil) -->
                        <a href="{{ route('doctor.posts.edit', $post->id) }}" class="btn" style="color: #ff8b27;">
                            <i class="fas fa-edit"></i>
                        </a>

                        <!-- Delete Icon (Trash) -->
                        <form action="{{ route('doctor.posts.destroy', $post->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn" style="color: #ff8b27;" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                       </div>
                    </div>


                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
