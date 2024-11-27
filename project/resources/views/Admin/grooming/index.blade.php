@extends('Admin.layouts.index')

@section('title', 'Grooming Appointments')

@section('content')
<div class="container">
    <h1 class="mb-4">Grooming Appointments</h1>
    <a href="{{ route('admin.grooming.create') }}" class="btn btn-orange mb-4"><i class="fa-solid fa-plus"></i> Grooming Appointment</a>

    <table class="table">
        <thead>
            <tr>
                <th>Owner</th>
                <th>Pet</th>
                <th>Service</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($groomings as $grooming)
                <tr>
                    <td>{{ $grooming->user->name }}</td>
                    <td>{{ $grooming->pet->name }}</td>
                    <td>{{ $grooming->service->name }}</td>
                    <td>{{ $grooming->appointment_date }}</td>
                    <td>{{ $grooming->appointment_time }}</td>
                    <td>
                        @if($grooming->status == 'pending')
                            <span class="badge badge-warning">Pending</span>
                        @elseif($grooming->status == 'approved')
                            <span class="badge badge-success">Approved</span>
                        @else
                            <span class="badge badge-danger">Rejected</span>
                        @endif
                    </td>
                    <td>
                        {{-- استبدال الأزرار بأيقونات --}}
                        {{-- <a href="{{ route('admin.grooming.show', $grooming->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;">
                            <i class="fa-solid fa-eye"></i>
                        </a> --}}
                        <a href="{{ route('admin.grooming.edit', $grooming->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('admin.grooming.destroy', $grooming->id) }}" method="POST" style="display:inline-block;">
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
