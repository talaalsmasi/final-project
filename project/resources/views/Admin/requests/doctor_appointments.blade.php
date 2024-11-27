@extends('Admin.layouts.index')

@section('title', 'Posts')

@section('content')
<div class="container">
    <h1 class="mb-4">Doctor Appointments</h1>

    <table class="table">
        <thead>
            <tr>
                <th>User</th>
                <th>Pet</th>
                <th>Doctor</th>
                <th>Service</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
            <tr>
                <td>{{ $appointment->user->name ?? 'N/A' }}</td>
                <td>{{ $appointment->pet->name ?? 'N/A' }}</td>
                <td>{{ $appointment->doctor->user->name ?? 'N/A' }}</td>
                <td>{{ $appointment->service->name ?? 'N/A' }}</td>
                <td>{{ $appointment->appointment_date }}</td>
                <td>{{ $appointment->appointment_time }}</td>
                <td>
                    @if($appointment->status == 'pending')
                        <span class="badge badge-warning">Pending</span>
                    @elseif($appointment->status == 'approved')
                        <span class="badge badge-success">Approved</span>
                    @elseif($appointment->status == 'rejected')
                        <span class="badge badge-danger">Rejected</span>
                    @endif
                </td>
                <td>
                    <!-- أزرار الإجراءات -->
                    <form action="{{ route('admin.doctor.appointments.approve', $appointment->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" style="background: none; border: none; color: #28a745; font-size: 20px;">
                            <i class="fas fa-check-circle"></i>
                        </button>
                    </form>

                    <form action="{{ route('admin.doctor.appointments.reject', $appointment->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" style="background: none; border: none; color: #dc3545; font-size: 20px;">
                            <i class="fas fa-times-circle"></i>
                        </button>
                    </form>

                    <form action="{{ route('admin.doctor.appointments.pending', $appointment->id) }}" method="POST" style="display:inline;">
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
