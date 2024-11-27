@extends('Admin.layouts.index')

@section('title', 'Roles')

@section('content')
    <div class="container">
        <h1 class="mb-4">Roles</h1>
        <a href="{{ route('admin.roles.create') }}" class="btn btn-orange"><i class="fa-solid fa-plus"></i> Role</a><br><br>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>
                            {{-- استبدال الأزرار بأيقونات --}}
                            <a href="{{ route('admin.roles.edit', $role->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background:none; border:none; color:#E17E2A; font-size:20px;" onclick="return confirm('Are you sure you want to delete this role?')">
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
