@extends('layouts.index')
@section('from', 'Create Appointment')
@section('title', 'booking payment')
@section('content')

            <div class="pet_appointment_wrap" >
                <div class="container">
                    <h4 class="appointment-main-title">Confirm Your Booking</h4>
                    <!-- First Form: For confirming the appointment -->
                    <form action="{{ route('appointment.payment.process') }}" method="POST">
                        @csrf <!-- Always remember to include CSRF for form submission -->
                        <div class="pet_appointment_row">
                            <div class="appiontment_list">
                                <div class="pet_appointment_colum">
                                    <h6><i class="fas fa-hotel" style="color: #ff8931;"></i> Room Name:</h6>
                                    <div class="small">
                                        <p>{{ $roomName }}</p>
                                    </div>
                                </div>
                                <div class="pet_appointment_colum">
                                    <h6><i class="fas fa-dog" style="color: #ff8931;"></i> Pet Name:</h6>
                                    <div class="small">
                                        <p>{{ $petName }}</p>
                                    </div>
                                </div>



                                <div class="pet_appointment_colum">
                                    <h6><i class="fas fa-moon" style="color: #ff8931;"></i>
                                         Number of Nights:</h6>
                                    <div class="">
                                        <p>{{ $numberOfNights }}</p>
                                    </div>
                                </div>
                                <div class="pet_appointment_colum">
                                    <h6><i class="fas fa-calendar" style="color: #ff8931;"></i> Check-in Date</h6>
                                    <div class="">
                                        <p>{{ $checkInDate }}</p>
                                    </div>
                                </div>


                                <div class="pet_appointment_colum">
                                    <h6><i class="fas fa-coins" style="color: #ff8931;"></i> Price per Night:</h6>
                                    <div class="">
                                        <p>{{ number_format($pricePerNight, 2) }}JD</p>
                                    </div>
                                </div>
                                <div class="pet_appointment_colum">
                                    <h6><i class="fas fa-calendar" style="color: #ff8931;"></i> Check-out Date</h6>
                                    <div class="">
                                        <p>{{ $checkOutDate }}</p>
                                    </div>
                                </div>



                                <div class="pet_appointment_colum">
                                    <h6><i class="fas fa-dollar-sign" style="color: #ff8931;"></i>
                                         Total Price:</h6>
                                    <div class="">
                                        <p>{{ number_format($totalPrice, 2) }}JD</p>
                                    </div>
                                </div>


                                <p><i class="fas fa-bell" style="color: #ff8931;"></i> <b>Note:</b>  You will pay half price of <strong>{{ number_format($totalPrice / 2, 2) }}JD</strong>, and you can complete it when the booking is done.</p>

                                <!-- Hidden Complete Payment button in the first form -->
                                <div class="pet_appointment_colum">
                                    <button class="main_button btn2 bdr-clr hover-affect" type="submit" style="visibility: hidden">Complete Payment</button>
                                </div>
                            </div>
                        </div>
                    </form> <!-- Close the first form here -->
                </div>
            </div><br><br><br>

            <!-- Second Section: Payment Information -->
            <div class="pet_appointment_wrap" >
                <div class="container">
                    <h4 class="appointment-main-title">Payment Information</h4>
                    <!-- Second Form: For payment processing -->
                    <form action="{{ route('payments.process') }}" method="POST">
                        @csrf <!-- CSRF token for security -->
                        <input type="hidden" name="room_id" value="{{ $data['room_id'] }}">
                        <input type="hidden" name="pet_id" value="{{ $data['pet_id'] }}">
                        <input type="hidden" name="check_in_date" value="{{ $checkInDate }}">
                        <input type="hidden" name="check_out_date" value="{{ $checkOutDate }}">
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

                                <div class="pet_appointment_colum">
                                    <h6><i class="fas fa-user" style="color: #ff8931;"></i> Cardholder Name</h6>
                                    <div class="">
                                        <input type="text" name="cardholder_name" id="cardholder_name" placeholder="Enter your name" required>
                                    </div>
                                </div>

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
                                    <button class="main_button btn2 bdr-clr hover-affect" type="submit">Complete Payment</button>
                                </div>
                            </div>
                        </div>
                    </form> <!-- Close the second form here -->
                </div>
            </div><br><br><br><br>
            <div style="position: fixed; bottom: 10px; right: -20px;">
                <img src="{{ asset('Admin/dog7.jpg.png') }}" alt="Dog Image" style="width: 200px; height: auto;">
            </div>
        @endsection
