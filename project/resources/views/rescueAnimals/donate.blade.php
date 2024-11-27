@extends('layouts.index')
@section('from', $rescueAnimal->pet->name .' Details')
@section('title', 'Donate')
@section('content') <br>
            <div class="pet_appointment_wrap" >
                <div class="container">
                    <h4 class="appointment-main-title">Donate to {{ $rescueAnimal->pet->name }}</h4>
                    <p>Current Donation: {{ $rescueAnimal->current_donated_amount }} / {{ $rescueAnimal->total_required_amount }}JD</p>

                    <!-- Donation Form for payment processing -->
                    <form action="{{ route('rescueAnimals.processDonation', $rescueAnimal->id) }}" method="POST">
                        @csrf <!-- CSRF token for security -->
                        <div class="pet_appointment_row">
                            <div class="appiontment_list">
                                <div class="pet_appointment_colum">
                                    <h6><i class="fas fa-hand-holding-heart" style="color: #ff8931;"></i> Donation Amount</h6>
                                    <input type="number" name="donation_amount" id="donation_amount"
                                           min="1"
                                           max="{{ $rescueAnimal->total_required_amount - $rescueAnimal->current_donated_amount }}"
                                           required style="border-radius: 1vh">
                                </div>

                                <div class="pet_appointment_colum">
                                    <h6><i class="fas fa-credit-card" style="color: #ff8931;"></i> Visa
                                        Card Number</h6>
                                    <input type="text" id="card_number" name="card_number"
                                           placeholder="Enter your card number" required>
                                    <!-- Display error message for card_number -->
                                    @error('card_number')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="pet_appointment_colum">
                                    <h6><i class="fas fa-user" style="color: #ff8931;"></i> Name
                                        Cardholder Name</h6>
                                    <input type="text" name="cardholder_name" id="cardholder_name"
                                           placeholder="Enter your name" required>
                                </div>

                                <div class="pet_appointment_colum">
                                    <h6><i class="fas fa-calendar-alt" style="color: #ff8931;"></i> Expiry Date
                                         Expiry Date</h6>
                                    <input type="text" name="expiry_date" id="expiry_date"
                                           required pattern="\d{2}/\d{2}"
                                           title="Expiry date must be in the format MM/YY"
                                           placeholder="MM/YY">
                                </div>

                                <div class="pet_appointment_colum">
                                    <h6><i class="fas fa-shield-alt" style="color: #ff8931;"></i>
                                        CVV</h6>
                                    <input type="text" name="cvv" id="cvv" required minlength="3"
                                           maxlength="3" pattern="\d{3}"
                                           title="CVV must be 3 digits" placeholder="CVV">
                                </div>
                                <div class="pet_appointment_colum" style="visibility: hidden">
                                    <h6>CVV</h6>
                                    {{-- <input type="text" name="cvv" id="cvv" required minlength="3"
                                           maxlength="3" pattern="\d{3}"
                                           title="CVV must be 3 digits" placeholder="CVV"> --}}
                                </div>

                                <div class="pet_appointment_colum"><br>
                                    <button class="main_button btn2 bdr-clr hover-affect" type="submit">Complete Payment</button>
                                </div>
                            </div>
                        </div>
                    </form> <!-- Close the donation form here -->
                </div>
            </div><br><br><br><br>
            <div style="position: fixed; bottom: 10px; right: -20px;">
                <img src="{{ asset('Admin/dog7.jpg.png') }}" alt="Dog Image" style="width: 200px; height: auto;">
            </div>
     @endsection
