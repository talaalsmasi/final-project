@extends('Admin.layouts.index')

@section('title', 'subscriptions')

@section('content')

<div class="container">
    <h1 class="mb-4">Subscriptions</h2>
    <a href="{{ route('admin.subscriptions.create')}}" class="btn btn-orange"><i class="fa-solid fa-plus"></i>  Subscription</a><br><br>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>

    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price per Session</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subscriptions as $subscription)
            <tr>
                <td>{{ $subscription->name }}</td>
                <td>{{ $subscription->description }}</td>
                <td>{{ number_format($subscription->price, 2) }} JD</td>
                <td>
                    @if($subscription->image)
                        <img style="height: 50px;width:50px;border-radius:50%" src="{{ asset($subscription->image) }}" alt="Image" style="width: 50px; height: auto;">
                    @else
                        <span>No image</span>
                    @endif
                </td>
                <td>

                    <a href="{{ route('admin.subscriptions.edit', $subscription->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <form action="{{ route('admin.subscriptions.destroy', $subscription->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background:none; border:none; color:#E17E2A; font-size:20px;" onclick="return confirm('Are you sure you want to delete this subscription?')">
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
