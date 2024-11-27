@extends('Admin.layouts.index')

@section('title', 'Taxi Requests')

@section('content')

<div class="container">
    <h1 class="mb-4">Taxi Requests</h1>
    <table class="table">
        <thead>
            <tr>
                <th>User </th>
                <th>Driver </th>
                <th>Trip Type</th>
                <th>Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($taxiRequests as $request)
            <tr>
                <td>{{ $request->user->name }}</td>
                <td>{{ $request->user->name }}</td>
                <td>{{ ucfirst($request->trip_type) }}</td>
                <td>{{ number_format($request->price, 2) }} JD</td>
                <td>
                    @if($request->status == 'pending')
                        <span class="badge badge-warning">Pending</span>
                    @elseif($request->status == 'approved')
                        <span class="badge badge-success">Approved</span>
                    @elseif($request->status == 'completed')
                        <span class="badge badge-primary">Completed</span>
                    @endif
                </td>
                <td>
                    <!-- زر الموافقة -->
                    <form action="{{ route('admin.taxi_requests.approve', $request->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" style="background: none; border: none; color: #28a745; font-size: 20px;">
                            <i class="fas fa-check-circle"></i> <!-- أيقونة الموافقة -->
                        </button>
                    </form>

                    <!-- زر تحديد كـ Completed -->
                    <form action="{{ route('admin.taxi_requests.complete', $request->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" style="background: none; border: none; color: #007bff; font-size: 20px;">
                            <i class="fas fa-check-double"></i> <!-- أيقونة Completed -->
                        </button>
                    </form>

                    <!-- زر إعادة التعيين إلى Pending -->
                    <form action="{{ route('admin.taxi_requests.pending', $request->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" style="background: none; border: none; color: #ffc107; font-size: 20px;">
                            <i class="fas fa-clock"></i> <!-- أيقونة Pending -->
                        </button>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
