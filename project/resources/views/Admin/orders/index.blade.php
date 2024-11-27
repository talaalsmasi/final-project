@extends('Admin.layouts.index')

@section('title', 'Orders')

@section('content')
<div class="container">
    <h1 class="mb-4">Orders</h1>
    <a href="{{ route('admin.orders.create') }}" class="btn btn-orange mb-4"><i class="fa-solid fa-plus"></i> Order</a>

    <table class="table">
        <thead>
            <tr>
                <th>Buyer</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Payment Method</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->user->name }}</td>
                    <td>${{ number_format($order->total_price, 2) }}</td>
                    <td>
                        @if($order->status == 'pending')
                            <span class="badge badge-warning">Pending</span>
                        @elseif($order->status == 'completed')
                            <span class="badge badge-success">Completed</span>
                        @else
                            <span class="badge badge-danger">Cancelled</span>
                        @endif
                    </td>
                    <td>{{ $order->payment_method }}</td>
                    <td>{{ $order->address }}</td>
                    <td>
                        {{-- استبدال الأزرار بأيقونات --}}
                        {{-- <a href="{{ route('admin.orders.show', $order->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;">
                            <i class="fa-solid fa-eye"></i>
                        </a> --}}
                        <a href="{{ route('admin.orders.order_items.index', $order->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;">
                            <i class="fa-solid fa-box-open"></i>
                        </a>
                        <a href="{{ route('admin.orders.edit', $order->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display:inline-block;">
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
