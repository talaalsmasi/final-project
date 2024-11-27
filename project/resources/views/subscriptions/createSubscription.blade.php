@extends('layouts.index')
@section('from', 'Subscriptions')
@section('title', 'Create Subscription')
@section('content')
<style>
    input[type="month"] {
    width: 100%;
    padding: 10px;
    font-size: 14px;
    height: 40px; /* تعديل ارتفاع الحقل */
    border: 1px solid #ffffff;
    border-radius: 10px;
    background-color: #ffffff;
    box-sizing: border-box;
}

input[type="month"]:focus {
    outline: none;
    border-color: #ff8931; /* لون التحديد ليطابق الألوان */
}

</style>

<section class="pet_appointment_wrap">
    <div class="container" style="margin-left: 13% ; width:80%">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <br>
        <h4 class="appointment-main-title">Subscribe to {{ $subscription->name }}</h4>
        <form action="{{ route('subscriptions.showPayment') }}" method="POST">
            @csrf
            <input type="hidden" name="subscription_id" value="{{ $subscription->id }}">

            <div class="pet_appointment_row">
                <div class="appiontment_list">
                    <div class="pet_appointment_colum">
                        <h6><i class="fas fa-dog" style="color: #ff8931;"></i> Your Pet</h6>
                        <div class="">
                            <select class="small" name="pet_id" id="pet">
                                @foreach($pets as $pet)
                                    <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="pet_appointment_colum">
                        <h6><i class="fas fa-calendar" style="color: #ff8931;"></i> Select Month:</h6>
                        <div class="">
                            <input type="month" id="selected_month" name="selected_month" required>
                        </div>
                    </div>

                    <div class="pet_appointment_colum">
                        <h6><i class="fas fa-calendar-week" style="color: #ff8931;"></i> Week
                            Select Week:</h6>
                        <div class="">
                            <select class="small" name="selected_week" id="selected_week" required>
                                <option value="1">First Week</option>
                                <option value="2">Second Week</option>
                                <option value="3">Third Week</option>
                                <option value="4">Fourth Week</option>
                            </select>
                        </div>
                    </div>

                    <div class="pet_appointment_colum">
                        <h6><i class="fas fa-clock" style="color: #ff8931;"></i> Training Time:</h6>
                        <div class="">
                            <select class="small" name="session_time" id="session_time">
                                @foreach ([
                                    '10:00 AM - 11:00 AM', '11:00 AM - 12:00 AM', '12:00 AM - 01:00 AM',
                                    '01:00 AM - 02:00 PM', '02:00 PM - 03:00 PM', '03:00 PM - 04:00 PM',
                                    '04:00 PM - 05:00 PM', '05:00 PM - 06:00 PM', '06:00 PM - 07:00 PM',
                                    '07:00 PM - 08:00 PM', '08:00 PM - 09:00 PM',
                                ] as $time)
                                    <option value="{{ $time }}" class="available-time">{{ $time }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <style>
                        .booked-time {
                            color: red;
                        }
                    </style>

                    <div class="pet_appointment_colum"><br>
                        <button class="main_button btn2 bdr-clr hover-affect" type="submit">Proceed to Payment</button>
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
    document.addEventListener('DOMContentLoaded', function() {
        const bookedSessions = @json($bookedSessions);

        // حدث عند تغيير الشهر أو الأسبوع
        document.getElementById('selected_week').addEventListener('change', updateAvailableTimes);
        document.getElementById('selected_month').addEventListener('change', updateAvailableTimes);

        function updateAvailableTimes() {
            const selectedMonth = new Date(document.getElementById('selected_month').value).getMonth() + 1;
            const selectedWeek = document.getElementById('selected_week').value;

            const sessionTimeSelect = document.getElementById('session_time');
            const options = sessionTimeSelect.options;

            // إعادة ضبط الأوقات
            for (let i = 0; i < options.length; i++) {
                options[i].classList.remove('booked-time');
                options[i].disabled = false;
            }

            // تعطيل الأوقات المحجوزة
            bookedSessions.forEach(session => {
                if (session.month == selectedMonth && session.week_number == selectedWeek) {
                    for (let i = 0; i < options.length; i++) {
                        if (options[i].value === session.session_time) {
                            options[i].classList.add('booked-time');
                            options[i].disabled = true;
                        }
                    }
                }
            });
        }
    });
</script>

@endsection
