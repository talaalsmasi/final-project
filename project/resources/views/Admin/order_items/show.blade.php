@extends('Admin.layouts.index')

@section('title', 'Order Item Details for Order #' . $order->id)

@section('content')
<div class="container">
    <h1 class="mb-4">Order Item Details for Order #{{ $order->id }}</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><strong>Product:</strong> {{ $orderItem->product->name }}</h5>
            <p class="card-text"><strong>Quantity:</strong> {{ $orderItem->quantity }}</p>
        </div>
    </div>

    <a href="{{ route('admin.orders.order_items.index', $order->id) }}" class="btn btn-orange">Back to Order Items</a>
</div>
@endsection
