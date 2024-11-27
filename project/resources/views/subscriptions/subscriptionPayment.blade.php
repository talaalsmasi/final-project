@extends('layouts.index')
@section('from', 'Subscriptions')
@section('title', 'Subscription Payment')
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

<section class="pet_appointment_wrap">
    <div class="container">
        <!-- Confirm Subscription Details -->
        <div class="pet_appointment_wrap">
            <div class="container">
                <h4 class="appointment-main-title" >Confirm Your Subscription</h4>
                <!-- Subscription Details -->
                <div class="pet_appointment_row" >
                    <div class="appiontment_list">
                        <div class="pet_appointment_colum">
                            <h6><i class="fas fa-clipboard-check" style="color: #ff8931;"></i> Subscription
                                 Subscription Name:</h6>
                            <div class="small">
                                <p>{{ $subscription->name }}</p>
                            </div>
                        </div>
                        <div class="pet_appointment_colum">
                            <h6><i class="fas fa-dog" style="color: #ff8931;"></i> Pet Name:</h6>
                            <div class="small">
                                <p>{{ $pet->name }}</p>
                            </div>
                        </div>
                        <div class="pet_appointment_colum">
                            <h6><i class="fas fa-clock" style="color: #ff8931;"></i> Training Time:</h6>
                            <div class="small">
                                <p>{{ $sessionTime }}</p>
                            </div>
                        </div>
                        <div class="pet_appointment_colum">
                            <h6><i class="fas fa-calendar" style="color: #ff8931;"></i> Month:</h6>
                            <div class="small">
                                <p>{{ $selectedMonth }}</p>
                            </div>
                        </div>
                        <div class="pet_appointment_colum">
                            <h6><i class="fas fa-calendar-week" style="color: #ff8931;"></i> Week
                                 Week Number:</h6>
                            <div class="small">
                                <p>Week {{ $selectedWeek }}</p>
                            </div>
                        </div>
                        <div class="pet_appointment_colum">
                            <h6><i class="fas fa-dollar-sign" style="color: #ff8931;"></i> Total Price:</h6>
                            <div class="small">
                                <p>${{ number_format($subscription->price, 2) }}</p>
                            </div>
                        </div>
                        <p><i class="fas fa-bell" style="color: #ff8931;"></i> <b> Note:</b> You will pay half of the total price: <strong>${{ number_format($subscription->price / 2, 2) }}</strong>, with the remaining amount due at completion.</p>
                    </div>
                </div>
            </div>
        </div>

        <br><br><br>

        <!-- Payment Information Form -->
        <div class="pet_appointment_wrap">
            <div class="container">
                <h4 class="appointment-main-title">Payment Information</h4>
                <form action="{{ route('subscriptions.processPayment') }}" method="POST">
                    @csrf
                    <input type="hidden" name="subscription_id" value="{{ $subscription->id }}">
                    <input type="hidden" name="pet_id" value="{{ $pet->id }}">
                    <input type="hidden" name="session_time" value="{{ $sessionTime }}">
                    <input type="hidden" name="selected_month" value="{{ $selectedMonth }}">
                    <input type="hidden" name="selected_week" value="{{ $selectedWeek }}">

                    <div class="pet_appointment_row">
                        <div class="appiontment_list">
                            <div class="pet_appointment_colum">
                                <h6><i class="fas fa-credit-card" style="color: #ff8931;"></i> Card Number</h6>
                                <div class="small">
                                    <input type="text" name="card_number" placeholder="Enter your card number" required>
                                    @error('card_number')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="pet_appointment_colum">
                                <h6><i class="fas fa-user" style="color: #ff8931;"></i> Cardholder Name</h6>
                                <div class="">
                                    <input type="text" name="cardholder_name" placeholder="Enter your name" required>
                                </div>
                            </div>
                            <div class="pet_appointment_colum">
                                <h6><i class="fas fa-calendar-alt" style="color: #ff8931;"></i> Expiry Date</h6>
                                <div class="">
                                    <input type="text" name="expiry_date" placeholder="MM/YY" required pattern="\d{2}/\d{2}" title="Expiry date must be in MM/YY format">
                                </div>
                            </div>
                            <div class="pet_appointment_colum">
                                <h6><i class="fas fa-shield-alt" style="color: #ff8931;"></i> CVV</h6>
                                <div class="">
                                    <input type="text" name="cvv" placeholder="CVV" required minlength="3" maxlength="3" pattern="\d{3}" title="CVV must be 3 digits">
                                </div>
                            </div>
                            <div class="pet_appointment_colum"><br>
                                <button class="main_button btn2 bdr-clr hover-affect" type="submit">Complete Payment</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<div style="position: fixed; bottom: 10px; right: -20px;">
    <img src="{{ asset('Admin/dog7.jpg.png') }}" alt="Dog Image" style="width: 200px; height: auto;">
</div>

@endsection
