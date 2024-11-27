@extends('layouts.index')
@section('title', 'show appointment')
@section('content')

            <!--pet 404 warp start -->
            <div class="container">
                <h2>Appointment Detailssss</h2>

                <p><strong>Pet Name:</strong> {{ $appointment->pet->name }}</p>
                <p><strong>Service:</strong> {{ $appointment->service->name }}</p>
                <p><strong>Doctor:</strong> {{ $appointment->doctor->name }}</p>
                <p><strong>Appointment Date:</strong> {{ $appointment->appointment_date }}</p>
                <p><strong>Appointment Time:</strong> {{ $appointment->appointment_time }}</p>

                <!-- هنا سيكون العداد التنازلي -->
                <p><strong>Time Remaining:</strong> <span id="countdown"></span></p>

                <a href="{{ route('profile') }}" class="main_button btn2 bdr-clr hover-affect">Back to Profile</a>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // تحويل وقت الموعد إلى توقيت يمكن التعامل معه في JavaScript
                    var appointmentTime = new Date("{{ $appointmentDateTime }}").getTime();

                    // تحديث العداد التنازلي كل ثانية
                    var countdownInterval = setInterval(function() {
                        // الوقت الحالي
                        var now = new Date().getTime();

                        // حساب الفرق بين الوقت الحالي ووقت الموعد
                        var distance = appointmentTime - now;

                        // حساب الأيام والساعات والدقائق والثواني المتبقية
                        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                        // عرض النتيجة في العنصر مع id="countdown"
                        document.getElementById("countdown").innerHTML = days + "d " + hours + "h "
                            + minutes + "m " + seconds + "s ";

                        // إذا انتهى الوقت
                        if (distance < 0) {
                            clearInterval(countdownInterval);
                            document.getElementById("countdown").innerHTML = "EXPIRED";
                        }
                    }, 1000);
                });
            </script>



            <!-- pet team warp end -->

    @endsection
