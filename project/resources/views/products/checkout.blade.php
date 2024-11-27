@extends('layouts.index')
@section('from', 'Cart')
@section('title', 'checkout')
@section('content')

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="pet_appointment_wrap">
            <div class="container">
                <h4 class="appointment-main-title">Confirm Your Order</h4>
                <!-- First Form: For confirming the appointment -->
                <form action="{{ route('cart.checkout') }}" method="POST">
                    @csrf <!-- Always remember to include CSRF for form submission -->
                    <div class="pet_appointment_row">
                        <div class="appiontment_list">
                            <input type="hidden" name="total_price" value="{{ $totalPrice }}"> <!-- Including delivery fee -->
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}"> <!-- User ID from the authentication -->
                            <input type="hidden" name="status" value="pending"> <!-- User ID from the authentication -->

                            <div class="pet_appointment_colum">
                                <h6><i class="fas fa-coins" style="color: #ff8931;"></i> Total Price:</h6>
                                <div class="small">
                                    <p>{{ number_format($totalPrice, 2) }} JD</p>
                                </div>
                            </div>

                            <div class="pet_appointment_colum">
                                <h6><i class="fas fa-city" style="color: #ff8931;"></i>
                                     City</h6>
                                <div class="">
                                    <input type="text" name="city" id="city_input" placeholder="Enter your city" required>
                                </div>
                            </div>

                            <div class="pet_appointment_colum">
                                <h6><i class="fas fa-dollar-sign" style="color: #ff8931;"></i> Grand Total:</h6>
                                <div class="">
                                    <p>{{ number_format($totalPrice + 3, 2) }} JD</p>
                                </div>
                            </div>

                            <div class="pet_appointment_colum">
                                <h6><i class="fas fa-map-marker-alt" style="color: #ff8931;"></i>
                                     Address</h6>
                                <div class="">
                                    <input type="text" name="address" id="address_input" placeholder="Enter your address" required>
                                </div>
                            </div>

                            <div class="pet_appointment_colum">
                                <h6><i class="fas fa-truck" style="color: #ff8931;"></i> Delivery
                                     Delivery Fee:</h6>
                                <div class="">
                                    <p>3 JD</p>
                                </div>
                            </div>

                            <!-- Payment Method Section -->
                            <div class="pet_appointment_column">
                                <h6><i class="fas fa-credit-card" style="color: #ff8931;"></i>
                                     Payment Method:</h6>
                                <label style="font-size: 14px; display: inline-flex; align-items: center;">
                                    <input type="radio" name="payment_method" value="cash" onclick="togglePaymentInfo(false)" required style="transform: scale(1.2); margin-right: 8px;">
                                    Cash
                                </label>
                                <br>
                                <label style="font-size: 14px; display: inline-flex; align-items: center;">
                                    <input type="radio" name="payment_method" value="visa" onclick="togglePaymentInfo(true)" required style="transform: scale(1.2); margin-right: 8px;">
                                    Visa
                                </label>
                            </div>

                            <!-- Complete Payment Button for Cash -->
                            <div class="pet_appointment_colum">
                                <button class="main_button btn2 bdr-clr hover-affect" type="submit"  id="donebtn">Complete Payment</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <br><br>

        <!-- Second Section: Payment Information for Visa -->
        <div class="pet_appointment_wrap" id="paymentInfo" style="display: none">
            <div class="container">
                <h4 class="appointment-main-title">Payment Information</h4>
                <!-- Second Form: For Visa Payment Processing -->
                <form action="{{ route('cart.checkout') }}" method="POST">
                    @csrf <!-- CSRF token for security -->

                    <div class="pet_appointment_row">
                        <div class="appiontment_list">
                            <div class="pet_appointment_colum">
                                <h6><i class="fas fa-credit-card" style="color: #ff8931;"></i> Card Number</h6>
                                <div class="small">
                                    <input type="text" id="card_number" name="card_number" placeholder="Enter your card number">
                                    <!-- Display error message for card_number -->
                                    @error('card_number')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <input type="hidden" name="payment_method" value="visa">
                            <input type="hidden" name="address" id="visa_address" value="">
                            <input type="hidden" name="total_price" value="{{ $totalPrice }}"> <!-- Including delivery fee -->
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}"> <!-- User ID from the authentication -->
                            <input type="hidden" name="status" value="pending"> <!-- User ID from the authentication -->

                            <div class="pet_appointment_colum">
                                <h6><i class="fas fa-calendar-alt" style="color: #ff8931;"></i> Expiry Date</h6>
                                <div class="">
                                    <input type="text" name="expiry_date" id="expiry_date" required pattern="\d{2}/\d{2}" title="Expiry date must be in the format MM/YY" placeholder="MM/YY">
                                </div>
                            </div>

                            <div class="pet_appointment_colum">
                                <h6><i class="fas fa-shield-alt" style="color: #ff8931;"></i> CVV</h6>
                                <div class="">
                                    <input type="text" name="cvv" id="cvv" required minlength="3" maxlength="3" pattern="\d{3}" title="CVV must be 3 digits" placeholder="CVV">
                                </div><br>
                            </div>
                            <div class="pet_appointment_colum">
                                <h6><i class="fas fa-user" style="color: #ff8931;"></i> Name Holder</h6>
                                <div class="">
                                    <input type="text" name="cvv" id="cvv" required minlength="3" maxlength="3" pattern="\d{3}" title="CVV must be 3 digits" >
                                </div><br>
                            </div>

                            <!-- Complete Payment Button for Visa -->
                            <div class="pet_appointment_colum" >
                                <button class="main_button btn2 bdr-clr hover-affect" type="submit">Complete Payment</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <br><br><br><br><br>
        <div style="position: fixed; bottom: 10px; right: -20px;">
            <img src="{{ asset('Admin/dog7.jpg.png') }}" alt="Dog Image" style="width: 200px; height: auto;">
        </div>

        <script>
            // JavaScript to show/hide payment information based on selected payment method
            function togglePaymentInfo(show) {
                const paymentInfo = document.getElementById('paymentInfo');
                const doneButton = document.getElementById('donebtn');
                const addressInput = document.getElementById('address_input').value;
                const visaAddress = document.getElementById('visa_address');

                if (show) {
                    paymentInfo.style.display = 'block';
                    doneButton.style.display = 'none'; // Hide the 'Complete Payment' button for Cash

                    // نقل قيمة العنوان المدخل إلى الفورم الخاص بالفيزا
                    visaAddress.value = addressInput;
                } else {
                    paymentInfo.style.display = 'none';
                    doneButton.style.display = 'block'; // Show the 'Complete Payment' button for Visa
                }
            }
        </script>

@endsection
