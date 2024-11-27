@extends('layouts.index')
@section('from', 'Subscriptions')
@section('title', 'Create Subscription')
@section('content') <br>


<div class="pet_appointment_wrap" >
    <div class="container" style="width: 80%">
        <h4 class="appointment-main-title">Confirm Your taxi request</h4>
        <!-- First Form: For confirming the appointment -->
        <form action="{{ route('taxi.storeRequest') }}" method="POST">
            <input type="hidden" name="pet_id" value="{{ $request->pet_id }}">
            <input type="hidden" name="trip_type" value="{{ $request->trip_type }}">
            <input type="hidden" name="location" value="{{ $request->location }}">
            <input type="hidden" name="driver_id" value="{{ $driver->id }}">
            <input type="hidden" name="price" value="{{ $price }}">
            @csrf <!-- Always remember to include CSRF for form submission -->
            <div class="pet_appointment_row">
                <div class="appiontment_list">

                    <div class="pet_appointment_colum">
                        <h6></h6>
                        <div class="">
                            <img src="{{ asset($driver->user->image) }}" alt="Driver Image" width="100" height="100" style="border-radius: 50%;">
                        </div>
                        <div></div>
                    </div>
                    <div class="pet_appointment_colum">
                        <h6><i class="fas fa-user-tie" style="color: #ff8931;"></i>
                             Driver:</h6>
                        <div class="">
                            <p>{{ $driver->user->name }}</p>
                        </div>
                    </div>
                    <div class="pet_appointment_colum">
                        <h6><i class="fas fa-dog" style="color: #ff8931;"></i> Pet:</h6>
                        <div class="small">
                            <p>{{ $pet->name }}</p>
                        </div>
                    </div>
                    <div class="pet_appointment_colum">
                        <h6><i class="fa-solid fa-phone" style="color: #ff8931;"></i>
                             Phone Number:</h6>
                        <div class="">
                            <p>{{ $driver->user->phone }}</p>
                        </div>
                    </div>
                    <div class="pet_appointment_colum">
                        <h6><i class="fas fa-route" style="color: #ff8931;"></i> Trip type</h6>
                        <div class="">
                            <p>{{ $request->trip_type }}</p>
                        </div>
                    </div>
                    <div class="pet_appointment_colum">
                        <h6><i class="fas fa-dollar-sign" style="color: #ff8931;"></i> Price:</h6>
                        <div class="">
                            <p>{{ $price}}</p>
                        </div>
                    </div>
                    {{-- {{ number_format($request->price, 2) }} --}}
                    <!-- Hidden Complete Payment button in the first form -->
                    <div class="pet_appointment_colum">
                        <button class="main_button btn2 bdr-clr hover-affect" type="submit" >confirm Order</button>

                    </div>
                </div>
            </div>
        </form> <!-- Close the first form here -->
    </div>
</div><br><br>
<div style="position: fixed; bottom: 10px; right: -20px;">
    <img src="{{ asset('Admin/dog7.jpg.png') }}" alt="Dog Image" style="width: 200px; height: auto;">
</div>
@endsection

