@extends('doctor.layouts.index')
@section('title', 'Dashboard')
@section('content')


<div class="container">
    <h1>My Appointments</h1>
    @if($appointments->isEmpty())
        <p>No appointments found.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Pet</th>
                    <th>Service</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Status</th>
                    <th>Actions</th> <!-- عمود جديد للأزرار -->
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->pet->name }}</td>
                        <td>{{ $appointment->service->name }}</td>
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
                            <!-- زر الموافقة -->
                            <form action="{{ route('doctor.appointments.approve', $appointment->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" style="background: none; border: none; color: #28a745; font-size: 20px;">
                                    <i class="fas fa-check-circle"></i>
                                </button>
                            </form>

                            <!-- زر الرفض -->
                            <form action="{{ route('doctor.appointments.reject', $appointment->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" style="background: none; border: none; color: #dc3545; font-size: 20px;">
                                    <i class="fas fa-times-circle"></i>
                                </button>
                            </form>

                            <!-- زر إعادة التعيين إلى Pending -->
                            <form action="{{ route('doctor.appointments.pending', $appointment->id) }}" method="POST" style="display: inline;">
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
    @endif
</div>






@endsection
