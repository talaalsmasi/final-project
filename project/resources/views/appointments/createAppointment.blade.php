@extends('layouts.index')
@section('from', 'Home')
@section('title', 'create appointment')
@section('content')


<section class="pet_appointment_wrap" >
    <div class="container"  >
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <br>
        <h4 class="appointment-main-title">Make an Appointment</h4>
        <form action="{{ route('appointment.payment') }}" method="POST">
            @csrf
            <div class="pet_appointment_row" >
                <div class="appiontment_list">
                    <div class="pet_appointment_colum">
                        <h6><i class="fas fa-dog" style="color: #ff8931;"></i>
                             Your pet</h6>
                        <div>
                            <select class="small" name="pet_id" id="pet">
                                @foreach($pets as $pet)
                                    <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="pet_appointment_colum">
                        <h6><i class="fas fa-toolbox" style="color: #ff8931;"></i>
                             Select a service</h6>
                        <div>
                            <select class="small" name="service_id" id="service">
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }} ({{ $service->price }}JD)</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="pet_appointment_colum full-width">
                        <h6><i class="fas fa-calendar" style="color: #ff8931;"></i>
                             I am available on</h6>
                        <div>
                            <input class="form-control" id="appointment_date" placeholder="2023-06-20" type="date" name="appointment_date" onchange="fetchAvailableTimes()" style="width: 99%">
                        </div>
                    </div>

                    <div class="pet_appointment_colum">
                        <h6><i class="fas fa-clock" style="color: #ff8931;"></i>
                             Time</h6>
                        <div>
                            <select class="small" name="appointment_time" id="appointment_time">
                                <!-- Options will be dynamically loaded here -->
                            </select>
                        </div>
                    </div>

                    <div class="pet_appointment_colum">
                        <h6><i class="fas fa-user-md" style="color: #ff8931;"></i>
                             Doctor</h6>
                        <div>
                            <select class="small" name="doctor_id" id="doctor" onchange="fetchAvailableTimes()">
                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                    </div>

                    <div class="pet_appointment_colum">
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


<script>
    function fetchAvailableTimes() {
        const date = document.getElementById('appointment_date').value;
        const doctorId = document.getElementById('doctor').value;

        if (date && doctorId) {
            fetch(`/get-booked-times?date=${date}&doctor_id=${doctorId}`)
                .then(response => response.json())
                .then(data => {
                    const timeSelect = document.getElementById('appointment_time');
                    timeSelect.innerHTML = ''; // Clear current options

                    // Define available time slots
                    const availableTimes = [
                        "10:00 AM - 10:30 AM", "10:30 AM - 11:00 AM", "11:00 AM - 11:30 AM",
                        "11:30 AM - 12:00 PM", "12:00 PM - 12:30 PM", "12:30 PM - 01:00 PM",
                        "01:30 PM - 02:00 PM", "02:00 PM - 02:30 PM", "02:30 PM - 03:00 PM",
                        "03:00 PM - 03:30 PM", "03:30 PM - 04:00 PM", "04:00 PM - 04:30 PM",
                        "04:30 PM - 05:00 PM", "05:00 PM - 05:30 PM", "05:30 PM - 06:00 PM",
                        "06:00 PM - 06:30 PM", "06:30 PM - 07:00 PM", "07:00 PM - 07:30 PM",
                        "07:30 PM - 08:00 PM", "08:00 PM - 08:30 PM", "08:30 PM - 09:00 PM"

                    ];

                    // Populate the time options based on availability
                    availableTimes.forEach(time => {
                        const isBooked = data.bookedTimes.includes(time);
                        const option = document.createElement('option');
                        option.value = time;
                        option.textContent = `${time} ${isBooked ? '(Booked)' : ''}`;
                        if (isBooked) {
                            option.classList.add('booked-time');
                            option.disabled = true;
                        }
                        timeSelect.appendChild(option);
                    });
                });
        }
    }
</script>

<style>
    .booked-time {
        color: red !important;
        font-weight: bold;
    }
</style>

          @endsection
