<!-- resources/views/Admin/users/index.blade.php -->
@extends('Admin.layouts.index')

@section('title', 'Users')

@section('content')
    <div class="container">
        <h1 class="mb-4">Users</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-orange"><i class="fa-solid fa-plus"></i> User</a><br><br>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>
                            @if($user->image)
                                <img style="height: 50px;width:50px;border-radius:50%" src="{{ asset($user->image) }}" alt="Post Image" width="100">
                            @else
                                No image
                            @endif
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->role->name ?? 'N/A' }}</td>
                        <td>
                            {{-- استبدال الأزرار بأيقونات --}}
                            {{-- <a href="{{ route('admin.users.show', $user->id) }}" style="color: #E17E2A;text-decoration:none;font-size:20px">
                                <i class="fa-solid fa-eye"></i>
                            </a> --}}
                            <a href="{{ route('admin.users.edit', $user->id) }}" style="color: #E17E2A;text-decoration:none;font-size:20px">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background:none; border:none;color:#E17E2A;font-size:20px;margin-top:-10px">
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
