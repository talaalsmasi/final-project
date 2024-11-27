@extends('layouts.index')
@section('from', 'Home')
@section('title', 'Order a Taxi')
@section('content')
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



<section class="pet_appointment_wrap" >
    <div class="container" style="margin-left: 10%;width:60%" >
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <br>
        <h4 class="appointment-main-title">Order a Taxi</h4>
        <form action="{{ route('taxi.checkAvailability') }}" method="POST">
            @csrf
            <div class="pet_appointment_row" >
                <div class="appiontment_list">
                    <div class="pet_appointment_colum">
                        <h6><i class="fas fa-dog" style="color: #ff8931;"></i> Your pet</h6>
                        <div>
                            <select class="small" name="pet_id" id="pet">
                                @foreach($pets as $pet)
                                    <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="pet_appointment_colum full-width">
                        <h6><i class="fas fa-map-marker-alt" style="color: #ff8931;"></i>
                             Location URL</h6>
                        <div>
                            <input class="form-control"  placeholder="http//..."type="url" name="location" id="location" onchange="fetchAvailableTimes()" style="width: 99%">
                        </div>
                    </div>

                    <div class="pet_appointment_colum">
                        <h6><i class="fas fa-route" style="color: #ff8931;"></i>
                             Trip type</h6>
                        <div>
                            <select class="small" name="trip_type" id="trip_type">
                                <option value="one_way">one way</option>
                                <option value="round_trip">Two ways</option>
                            </select>
                        </div>
                    </div>
                    <div class="pet_appointment_colum"><br>
                        <button class="main_button btn2 bdr-clr hover-affect" type="submit">Process to Payment</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<div style="position: fixed; bottom: 10px; right: -20px;">
    <img src="{{ asset('Admin/dog7.jpg.png') }}" alt="Dog Image" style="width: 200px; height: auto;">
</div>
@endsection
