@extends('layouts.index')
@section('title', 'appointments details')
@section('from', 'profile')
@section('content')
<br>
<section class="pet_appointment_wrap">
    <div class="container">
        <h2>Appointment Details</h2>

        @if($appointments->isEmpty())
            <p>No appointments found for this pet.</p>
        @else
            <div class="row">
                @foreach ($appointments as $appointment)
                    <div class="col-md-6">
                        <div class="card mb-3" style="background-color: rgb(249, 246, 246); background-image: url('{{ asset('images/service-bg-paw.png') }}'); box-shadow: 0px 6px 12px -1px #ddd; border: none; border-radius: 8px; position: relative;">

                            <!-- زر التقييم في الجزء العلوي الأيمن -->
                            @if (\Carbon\Carbon::parse($appointment->appointment_date . ' ' . explode(' - ', $appointment->appointment_time)[0] ?? '')->isPast() && $appointment->status === 'approved')
                                <a href="{{ route('ratings.show', $appointment->id) }}" class="btn btn-primary" style="position: absolute; top: 10px; right: 10px;">Rate Your Visit</a>
                            @endif

                            <div class="card-body" style="padding: 20px;">
                                <div class="appointment-details">
                                    <h5><strong><i class="fas fa-paw" style="color: rgb(255, 139, 51);"></i> Pet Details</strong></h5>
                                    <p><strong>Pet Name:</strong> {{ optional($appointment->pet)->name }}</p>
                                    <p><strong>Breed:</strong> {{ optional($appointment->pet)->breed ?? 'Unknown' }}</p>

                                    @if (isset($appointment->pet->birthday))
                                        @php
                                            $birthday = \Carbon\Carbon::parse($appointment->pet->birthday);
                                            $now = \Carbon\Carbon::now();
                                            $ageYears = $birthday->diffInYears($now);
                                            $ageMonths = $birthday->diffInMonths($now) % 12;
                                        @endphp

                                        <p><strong>Age:</strong>
                                            @if ($ageYears > 0)
                                                {{ $ageYears }} years
                                            @endif
                                            @if ($ageMonths > 0)
                                                {{ $ageMonths }} months
                                            @endif
                                        </p>
                                    @else
                                        <p><strong>Age:</strong> Unknown</p>
                                    @endif
                                    <br>

                                    <h5><strong><i class="fas fa-briefcase" style="color: #ff8931;"></i> Appointment Service Details</strong></h5>
                                    <p><strong>Service Name:</strong> {{ optional($appointment->service)->name }}</p>
                                    <p><strong>Service Description:</strong> {{ optional($appointment->service)->description }}</p>
                                    <p><strong>Service Price:</strong> {{ optional($appointment->service)->price }}JD</p>
                                    <br>

                                    <h5><strong><i class="fas fa-calendar-alt" style="color: #ff8931;"></i> Appointment Details</strong></h5>
                                    <p><strong>Appointment Date:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d') }}</p>
                                    <p><strong>Status:</strong><span class=" {{ $appointment->status === 'approved' ? 'text-success' : ($appointment->status === 'pending' ? 'text-warning' : 'text-danger') }}"> {{ ucfirst($appointment->status) }} </span></p>

                                    @if (isset($appointment->appointment_time))
                                        @php
                                            $timeRange = explode(' - ', $appointment->appointment_time);
                                            $startTime = $timeRange[0] ?? 'Unknown';
                                            $endTime = $timeRange[1] ?? 'Unknown';

                                            $appointmentStart = \Carbon\Carbon::parse($appointment->appointment_date . ' ' . $startTime);
                                            $now = \Carbon\Carbon::now();
                                            $timeRemaining = $appointmentStart->diff($now);
                                        @endphp

                                        <p><strong>Appointment Time:</strong> {{ $startTime }} - {{ $endTime }}</p>
                                        <br>

                                        <h5><strong><i class="fas fa-clock" style="color: #ff8931;"></i> Time Remaining</strong></h5>
                                        @if ($appointmentStart->isPast())
                                            <p class="text-danger">The appointment has ended.</p>
                                        @else
                                            <p>{{ $timeRemaining->days }} days, {{ $timeRemaining->h }} hours, and {{ $timeRemaining->i }} minutes</p>
                                        @endif
                                    @else
                                        <p><strong>Appointment Time:</strong> Unknown</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
