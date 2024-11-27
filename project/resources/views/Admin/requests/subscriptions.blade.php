@extends('Admin.layouts.index')

@section('title', 'Posts')

@section('content')

<div class="container">
    <h1 class="mb-4">Subscription Requests</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Subscription ID</th>
                <th>Pet ID</th>
                <th>Month</th>
                <th>Week Number</th>
                <th>Session Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subscriptions as $subscription)
            <tr>
                <td>{{ $subscription->subscription->name }}</td>
                <td>{{ $subscription->pet_id }}</td>
                <td>{{ $subscription->month }}</td>
                <td>{{ $subscription->week_number }}</td>
                <td>{{ $subscription->session_time }}</td>
                <td>
                    @if($subscription->status == 'pending')
                        <span class="badge badge-warning">Pending</span>
                    @elseif($subscription->status == 'approved')
                        <span class="badge badge-success">Approved</span>
                    @elseif($subscription->status == 'rejected')
                        <span class="badge badge-danger">Rejected</span>
                    @endif
                </td>
                <td>
                    <!-- زر الموافقة -->
                    <form action="{{ route('admin.subscriptions.approve', $subscription->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" style="background: none; border: none; color: #28a745; font-size: 20px;">
                            <i class="fas fa-check-circle"></i>
                        </button>
                    </form>

                    <!-- زر الرفض -->
                    <form action="{{ route('admin.subscriptions.reject', $subscription->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" style="background: none; border: none; color: #dc3545; font-size: 20px;">
                            <i class="fas fa-times-circle"></i>
                        </button>
                    </form>

                    <!-- زر إعادة التعيين إلى Pending -->
                    <form action="{{ route('admin.subscriptions.pending', $subscription->id) }}" method="POST" style="display: inline;">
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
