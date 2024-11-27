@extends('Admin.layouts.index')

@section('title', 'Bookings')

@section('content')
    <div class="container">
        <h1 class="mb-4">Bookings</h1>

        <a href="{{ route('admin.bookings.create') }}" class="btn btn-orange mb-4"><i class="fa-solid fa-plus"></i> Booking</a>

        <div class="table-responsive">
            <table class="table">
                {{-- class="thead-dark" --}}
                <thead>
                    <tr>
                        <th>Owner</th>
                        <th>Pet</th>
                        <th>Room</th>
                        <th>Check-in Date</th>
                        <th>Check-out Date</th>
                        <th>Status</th> <!-- Added Status Column -->
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr>
                            <td>{{ $booking->user ? $booking->user->name : 'N/A' }}</td> <!-- Check if user exists -->
                            <td>{{ $booking->pet ? $booking->pet->name : 'N/A' }}</td>  <!-- Check if pet exists -->
                            <td>{{ $booking->room->room_name }}</td>  <!-- Check if pet exists -->
                            <td>{{ \Carbon\Carbon::parse($booking->check_in_date)->format('Y-m-d') }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->check_out_date)->format('Y-m-d') }}</td>
                            <td>
                                @if($booking->status == 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @elseif($booking->status == 'approved')
                                    <span class="badge badge-success">Approved</span>
                                @elseif($booking->status == 'rejected')
                                    <span class="badge badge-danger">Rejected</span>
                                @endif
                            </td> <!-- Displaying Status as Badges -->
                            <td class="text-center">
                                {{-- استبدال الأزرار بأيقونات --}}
                                {{-- <a href="{{ route('admin.bookings.show', $booking->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;">
                                    <i class="fa-solid fa-eye"></i>
                                </a> --}}
                                <a href="{{ route('admin.bookings.edit', $booking->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background:none; border:none; color:#E17E2A; font-size:20px;" onclick="return confirm('Are you sure you want to delete this booking?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>


                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No bookings found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
