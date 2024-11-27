@extends('Admin.layouts.index')

@section('title', 'Order Details')

@section('content')
<div class="container">
    <h1 class="mb-4">Order Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><strong>Buyer:</strong> {{ $order->user->name }}</h5>
            <p class="card-text"><strong>Total Price:</strong> ${{ number_format($order->total_price, 2) }}</p>
            <p class="card-text"><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
            <p class="card-text"><strong>Address:</strong> {{ $order->address }}</p>
            <p class="card-text">
                <strong>Status:</strong>
                @if($order->status == 'pending')
                    <span class="badge badge-warning">Pending</span>
                @elseif($order->status == 'completed')
                    <span class="badge badge-success">Completed</span>
                @else
                    <span class="badge badge-danger">Cancelled</span>
                @endif
            </p>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-orange">Back</a>
        </div>
    </div>
</div>
@endsection
