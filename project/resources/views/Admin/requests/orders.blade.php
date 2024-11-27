@extends('Admin.layouts.index')

@section('title', 'Posts')

@section('content')
<div class="container">
    <h1 class="mb-4">Orders</h1>

    <table class="table">
        <thead>
            <tr>
                <th>User</th>
                <th>Total Price</th>
                <th>Payment Method</th>
                <th>Address</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->user->name ?? 'N/A' }}</td>
                <td>${{ $order->total_price }}</td>
                <td>{{ $order->payment_method }}</td>
                <td>{{ $order->address }}</td>
                <td>
                    @if($order->status == 'pending')
                        <span class="badge badge-warning">Pending</span>
                    @elseif($order->status == 'completed')
                        <span class="badge badge-success">Completed</span>
                    @elseif($order->status == 'cancelled')
                        <span class="badge badge-danger">Cancelled</span>
                    @endif
                </td>
                <td>
                    <!-- أزرار تغيير الحالة -->
                    <form action="{{ route('admin.orders.complete', $order->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" style="background: none; border: none; color: #28a745; font-size: 20px;">
                            <i class="fas fa-check-circle"></i>
                        </button>
                    </form>

                    <form action="{{ route('admin.orders.cancel', $order->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" style="background: none; border: none; color: #dc3545; font-size: 20px;">
                            <i class="fas fa-times-circle"></i>
                        </button>
                    </form>

                    <form action="{{ route('admin.orders.pending', $order->id) }}" method="POST" style="display:inline;">
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
