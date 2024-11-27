@extends('Admin.layouts.index')

@section('title', 'Order Items for Order #' . $order->id)

@section('content')
<div class="container">
    <h1 class="mb-4">Order Items for Order #{{ $order->id }}</h1>
    <a href="{{ route('admin.orders.order_items.create', $order->id) }}" class="btn btn-orange mb-4"><i class="fa-solid fa-plus"></i> Order Item</a>

    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($orderItems->count() > 0)
                @foreach($orderItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>
                            {{-- استبدال الأزرار بأيقونات --}}
                            <a href="{{ route('admin.orders.order_items.edit', [$order->id, $item->id]) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.orders.order_items.destroy', [$order->id, $item->id]) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background:none; border:none; color:#E17E2A; font-size:20px;" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3">No order items found for this order.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
