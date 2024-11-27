@extends('Admin.layouts.index')

@section('title', 'Posts')

@section('content')

<div class="container">
    <h1 class="mb-4">Grooming Appointments</h1>

    <table class="table">
        <thead>
            <tr>
                <th>User</th>
                <th>Pet</th>
                <th>Grooming Date</th>
                <th>Grooming Time</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($groomings as $grooming)
            <tr>
                <td>{{ $grooming->user->name ?? 'N/A' }}</td>
                <td>{{ $grooming->pet->name ?? 'N/A' }}</td>
                <td>{{ $grooming->appointment_date }}</td>
                <td>{{ $grooming->appointment_time }}</td>
                <td>
                    @if($grooming->status == 'pending')
                        <span class="badge badge-warning">Pending</span>
                    @elseif($grooming->status == 'approved')
                        <span class="badge badge-success">Approved</span>
                    @elseif($grooming->status == 'rejected')
                        <span class="badge badge-danger">Rejected</span>
                    @endif
                </td>
                <td>
                    <!-- أزرار تغيير الحالة -->
                    <form action="{{ route('admin.groomings.approve', $grooming->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" style="background: none; border: none; color: #28a745; font-size: 20px;">
                            <i class="fas fa-check-circle"></i>
                        </button>
                    </form>

                    <form action="{{ route('admin.groomings.reject', $grooming->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" style="background: none; border: none; color: #dc3545; font-size: 20px;">
                            <i class="fas fa-times-circle"></i>
                        </button>
                    </form>

                    <form action="{{ route('admin.groomings.pending', $grooming->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" style="background: none; border: none; color: #ffc107; font-size: 20px;">
                            <i class="fas fa-clock"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
