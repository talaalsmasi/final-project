@extends('layouts.index')
@section('from', 'Profile')
@section('title', 'Show Your Orders')
@section('content')

<section class="pet_appointment_wrap">
    <div class="container">
        <h2>Order Details</h2>

        <div class="row">
            @foreach($orders as $orderDetail)
                <div class="col-md-6">
                    <div class="card mb-3" style="background-color: #f6f5f5; background-image: url('{{ asset('images/service-bg-paw.png') }}'); box-shadow: 0px 6px 12px -1px #ddd; border: none; border-radius: 8px; position: relative;">
                        <!-- زر لعرض العناصر على يمين أعلى البطاقة -->
                        <button id="toggleButton-{{ $orderDetail['order']->id }}" class="btn btn-primary" style="position: absolute; top: 20px; right: 20px;" onclick="toggleItems({{ $orderDetail['order']->id }})">
                            View Items
                        </button>
                        <div class="card-body" style="padding: 20px;">
                            <div class="appointment-details">
                                @if($orderDetail['order']->created_at)
                                    <h5><b>Order Date:</b> {{ $orderDetail['order']->created_at->format('d M Y') }}</h5>
                                @else
                                    <p><i class="fa-solid fa-calendar-days" style="color: rgb(255, 139, 39);"><strong></i> Order Date:</strong> N/A</p>
                                @endif
                                <p><i class="fa-solid fa-credit-card" style="color: #ff8b27;"></i> <strong> Payment Method:</strong> {{ ucfirst($orderDetail['order']->payment_method) }}</p>
                                <p><i class="fa-solid fa-barcode" style="color: #ff8b27;"></i> <strong> Total Price:</strong> {{ number_format($orderDetail['order']->total_price, 2) }} JD</p>
                                <p><i class="fa-solid fa-truck" style="color: #ff8b27;"></i> <strong> Status:</strong> {{ ucfirst($orderDetail['order']->status) }}</p>

                                <!-- قائمة العناصر -->
                                <div id="items-{{ $orderDetail['order']->id }}" style="display: none; margin-top: 15px;">
                                    <h5>Order Items:</h5>
                                    <ul>
                                        @foreach($orderDetail['items'] as $item)
                                            <li style="color: black">{{ $item->product->name }} - Quantity: {{ $item->quantity }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><br>
                </div>
            @endforeach
        </div>
    </div>
</section>

<script>
    function toggleItems(orderId) {
        var itemsDiv = document.getElementById('items-' + orderId);
        var toggleButton = document.getElementById('toggleButton-' + orderId);

        if (itemsDiv.style.display === 'none') {
            itemsDiv.style.display = 'block';
            toggleButton.textContent = 'Hide Items';
        } else {
            itemsDiv.style.display = 'none';
            toggleButton.textContent = 'View Items';
        }
    }
</script>

@endsection
