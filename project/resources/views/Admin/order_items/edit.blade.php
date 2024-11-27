@extends('Admin.layouts.index')

@section('title', 'Edit Order Item for Order #' . $order->id)

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Order Item for Order #{{ $order->id }}</h2>

    <div class="card" style="background-color: #f6f5f5; padding: 20px;">
        <form action="{{ route('admin.orders.order_items.update', [$order->id, $orderItem->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Product Dropdown -->
            <div class="mb-3">
                <label for="product_id" class="form-label">Product</label>
                <select name="product_id" id="product_id" class="form-control" required>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ $product->id == $orderItem->product_id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Quantity Field -->
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $orderItem->quantity }}" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-orange">Update Order Item</button>
        </form>
    </div>
</div>
@endsection
