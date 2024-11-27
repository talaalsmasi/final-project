@extends('layouts.index')
@section('from', 'Home')
@section('title', 'cart')
@section('content')
<style>
    td{
        color: black
    }
    th{
        color: black;
    }
    .summary-item{
        border-style: solid;
        border-color: black
    }
</style>
            <section class="cart_section" style="padding: 50px; background-color: #f7f7f7;">
                <div class="cart-container" style="background-color: #fff; padding: 20px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); background-color: #f7f7f7; background-image: url('/images/bg-paw.png');">
                    <h4 class="appointment-main-title" style="font-size: 24px; font-weight: bold; text-align: center; margin-bottom: 20px;">Shopping Cart</h4>

                    @if(session('cart') && count(session('cart')) > 0)
                    <table class="table" style="width: 100%; border-collapse: collapse; border: 1px solid rgb(108, 108, 108);">
                        <thead style=" border: 1px solid rgb(108, 108, 108);">
                            <tr>
                                <th style="text-align: center;  border: 1px solid rgb(176, 176, 176); padding: 10px;">Image</th>
                                <th style="text-align: center;  border: 1px solid rgb(176, 176, 176); padding: 10px;">Product Name</th>
                                <th style="text-align: center;  border: 1px solid rgb(176, 176, 176); padding: 10px;">Unit Price</th>
                                <th style="text-align: center;  border: 1px solid rgb(176, 176, 176); padding: 10px;">Quantity</th>
                                <th style="text-align: center;  border: 1px solid rgb(176, 176, 176); padding: 10px;">Total</th>
                                <th style="text-align: center;  border: 1px solid rgb(176, 176, 176); padding: 10px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(session('cart') as $id => $details)
                            <tr>
                                <td style="text-align: center; padding: 10px; border: 1px solid rgb(128, 128, 128);">
                                    <img src="{{ asset($details['image']) }}" alt="{{ $details['name'] }}" width="60px" height="60px" style="border-radius: 50%;">
                                </td>
                                <td style="text-align: center; padding: 10px; border: 1px solid rgb(114, 114, 114);">
                                    {{ $details['name'] }}
                                </td>
                                <td style="text-align: center; padding: 10px; border: 1px solid rgb(108, 108, 108);">
                                    @if (session()->has('coupon'))
                                        <!-- Old price with a red strikethrough -->
                                        <span style="text-decoration: line-through; color: red;">{{ number_format($details['price'], 2) }} JD</span><br>
                                        <!-- New price with discount -->
                                        <span>{{ number_format($details['price'] - (session('coupon')['discount'] / count(session('cart'))), 2) }} JD</span>
                                    @else
                                        <!-- If no coupon is applied, show the regular price -->
                                        {{ number_format($details['price'], 2) }} JD
                                    @endif
                                </td>
                                <td style="text-align: center; padding: 10px;  border: 1px solid rgb(108, 108, 108);">
                                    <div class="quantity-control" style="display: flex; justify-content: center; align-items: center;">
                                        <form action="{{ route('cart.decrease', $id) }}" method="GET" style="display: inline;">
                                            <button type="submit" class="minus-btn" style="background-color: #fff; border: none; cursor: pointer;">
                                                <i class="fa-solid fa-circle-minus" style="color: #ff8931;"></i>
                                            </button>
                                        </form>
                                        <input type="text" value="{{ $details['quantity'] }}" style="width: 40px; text-align: center; border: 1px solid #ddd; margin: 0 5px;" readonly>
                                        <form action="{{ route('cart.increase', $id) }}" method="GET" style="display: inline;">
                                            <button type="submit" class="plus-btn" style="background-color: #fff; border: none; cursor: pointer;">
                                                <i class="fa-solid fa-circle-plus" style="color: #ff8931;"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td style="text-align: center; padding: 10px; border: 1px solid rgb(108, 108, 108);">
                                    {{ number_format($details['price'] * $details['quantity'], 2) }} JD
                                </td>
                                <td style="text-align: center; padding: 10px;  border: 1px solid rgb(108, 108, 108);">
                                    <form action="{{ route('cart.remove', $id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="remove-btn" style="background-color: #fff; border: none; cursor: pointer; font-size: 18px;">
                                            <i class="fa-solid fa-trash" style="color: #ff8931;"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Summary Section -->
                    <div class="cart-summary" style="margin-top: 20px; display: flex; justify-content: space-between;">
                        <!-- Display the delivery cost -->
                        <div class="summary-item total" style="display: flex; justify-content: space-between; width: 24%; padding: 10px; border: 1px solid #ddd; font-weight: bold;">
                            <p>Delivery:</p>
                            <p>3 JD</p>
                        </div>

                        <!-- Display the total price before the discount -->
                        <div class="summary-item total" style="display: flex; justify-content: space-between; width: 24%; padding: 10px; border: 1px solid #ddd; font-weight: bold;">
                            <p>Total Price:</p>
                            <p >{{ number_format($totalPrice, 2) }} JD</p>
                        </div>

                        <!-- If a coupon is applied, show the discount and new total -->
                        @if(session()->has('coupon'))
                            <div class="summary-item discount" style="color: red; display: flex; justify-content: space-between; width: 24%; padding: 10px; border: 1px solid #ddd; font-weight: bold;">
                                <p>Discount:</p>
                                <p>-{{ number_format(session('coupon')['discount'], 2) }} JD</p>
                            </div>

                            <!-- Display the grand total with delivery cost after applying the coupon -->
                            <div class="summary-item total" style="display: flex; justify-content: space-between; width: 24%; padding: 10px; border: 1px solid #ddd; font-weight: bold;">
                                <p>Grand Total:</p>
                                <p>{{ number_format($totalPrice - session('coupon')['discount'] + 3, 2) }} JD</p>
                            </div>
                        @else
                            <!-- Display the grand total without a discount -->
                            <div class="summary-item total" style="display: flex; justify-content: space-between; width: 24%; padding: 10px; border: 1px solid #ddd; font-weight: bold;">
                                <p>Grand Total:</p>
                                <p>{{ number_format($totalPrice + 3, 2) }} JD</p>
                            </div>
                        @endif
                    </div>

                    <!-- Promo code and checkout buttons -->
                    {{-- <div class="promo-code" style="margin-top: 20px; display: flex; justify-content: flex-start; align-items: center;">
                        <form action="{{ route('cart.applyCoupon') }}" method="POST" style="display: flex; width: 100%;">
                            @csrf
                            <input type="text" id="coupon_code" name="coupon_code" placeholder="Enter coupon code" style="padding: 10px; border: 3px solid black; width: 70%;">
                            <button type="submit" style="padding: 10px 20px; background-color: #000; color: #fff; border: none; margin-left: 10px; cursor: pointer;">Apply Coupon</button>
                        </form>
                    </div><br> --}}

                    <div class="cart-buttons" style="margin-top: 20px; display: flex; justify-content: space-between;">
                        <a href="{{ route('products.showProducts') }}" class="main_button btn2 bdr-clr hover-affect" style="padding: 10px 20px; cursor: pointer;">Back to Shopping</a>
                        <form action="{{ route('cart.showCheckout') }}" method="get">
                            <button type="submit" class="main_button btn2 bdr-clr hover-affect" style="padding: 10px 20px; color: #fff; border: none; cursor: pointer;">Proceed to Checkout</button>
                        </form>
                    </div>

                    @else
                    <p style="text-align: center; font-size: 18px; margin-top: 20px;">Your cart is empty.</p>
                    @endif
                </div>
            </section>
@endsection
