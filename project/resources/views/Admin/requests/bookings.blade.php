@extends('Admin.layouts.index')

@section('title', 'Posts')

@section('content')
<div class="container">
    <h1 class="mb-4">Room Bookings</h1>

    <table class="table">
        <thead>
            <tr>
                <th>User</th>
                <th>Pet</th>
                <th>Room</th>
                <th>Check-in Date</th>
                <th>Check-out Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->user->name ?? 'N/A' }}</td>
                <td>{{ $booking->pet->name ?? 'N/A' }}</td>
                <td>{{ $booking->room->room_name ?? 'N/A' }}</td>
                <td>{{ $booking->check_in_date }}</td>
                <td>{{ $booking->check_out_date }}</td>
                <td>
                    @if($booking->status == 'pending')
                        <span class="badge badge-warning">Pending</span>
                    @elseif($booking->status == 'approved')
                        <span class="badge badge-success">Approved</span>
                    @elseif($booking->status == 'rejected')
                        <span class="badge badge-danger">Rejected</span>
                    @endif
                </td>
                <td>
                    <!-- أزرار تغيير الحالة -->
                    <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" style="background: none; border: none; color: #28a745; font-size: 20px;">
                            <i class="fas fa-check-circle"></i>
                        </button>
                    </form>

                    <form action="{{ route('admin.bookings.reject', $booking->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" style="background: none; border: none; color: #dc3545; font-size: 20px;">
                            <i class="fas fa-times-circle"></i>
                        </button>
                    </form>

                    <form action="{{ route('admin.bookings.pending', $booking->id) }}" method="POST" style="display:inline;">
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
