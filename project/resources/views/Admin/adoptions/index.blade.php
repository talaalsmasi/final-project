@extends('Admin.layouts.index')

@section('title', 'Adoption Requests')

@section('content')
<div class="container">
    <h1 class="mb-4">Adoption Requests</h1>

    <a href="{{ route('admin.adoptions.create') }}" class="btn btn-orange mb-4"><i class="fa-solid fa-plus"></i> Adoption Request</a>

    <table class="table">
        <thead>
            <tr>
                <th>Pet Name</th>
                <th>User</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($adoptions as $adoption)
                <tr>
                    <td>{{ $adoption->pet->name }}</td>
                    <td>{{ $adoption->user->name }}</td>
                    <td>{{ $adoption->reason }}</td>
                    <td>
                        @if($adoption->status == 'pending')
                            <span class="badge badge-warning">Pending</span>
                        @elseif($adoption->status == 'approved')
                            <span class="badge badge-success">Approved</span>
                        @else
                            <span class="badge badge-danger">Rejected</span>
                        @endif
                    </td>
                    <td>
                        {{-- استبدال الأزرار بأيقونات --}}
                        <a href="{{ route('admin.adoptions.edit', $adoption->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                                                {{-- <a href="{{ route('admin.adoptions.show', $adoption->id) }}" class="btn btn-info">View</a> --}}

                        <form action="{{ route('admin.adoptions.destroy', $adoption->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:none; border:none; color:#E17E2A; font-size:20px;" onclick="return confirm('Are you sure?')">
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
