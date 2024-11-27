@extends('Admin.layouts.index')

@section('title', 'Add Order')

@section('content')
<div class="container">
    <h2 class="mb-4">Add New Order</h2>

    <div class="card" style="background-color: #f6f5f5; padding: 20px;">
        <form action="{{ route('admin.orders.store') }}" method="POST">
            @csrf

            <!-- Buyer Dropdown -->
            <div class="mb-3">
                <label for="user_id" class="form-label">Buyer</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Total Price Field -->
            <div class="mb-3">
                <label for="total_price" class="form-label">Total Price</label>
                <input type="number" step="0.01" name="total_price" id="total_price" class="form-control" required>
            </div>

            <!-- Status Dropdown -->
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>

            <!-- Payment Method Dropdown -->
            <div class="mb-3">
                <label for="payment_method" class="form-label">Payment Method</label>
                <select name="payment_method" id="payment_method" class="form-control" required>
                    <option value="Visa">Visa</option>
                    <option value="Cash">Cash</option>
                </select>
            </div>

            <!-- Address Field -->
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" id="address" class="form-control" required>
            </div>

            <!-- Save Button -->
            <button type="submit" class="btn btn-orange">Save Order</button>
        </form>
    </div>
</div>
@endsection
