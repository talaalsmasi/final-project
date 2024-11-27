@extends('layouts.index')
@section('from', 'Profile')
@section('title', 'show grooming appointments')
@section('content')
<section class="pet_appointment_wrap">
            <div class="container">
                <h2>Grooming Appointment Details</h2>

                @if($broomings->isEmpty())
                    <p>No grooming appointments found for this pet.</p>
                @else
                    <div class="row">
                        @foreach ($broomings as $brooming)
                            <div class="col-md-6">
                                <div class="card mb-3" style="background-color: #f6f5f5; background-image: url('{{ asset('images/service-bg-paw.png') }}'); box-shadow: 0px 6px 12px -1px #ddd; border: none; border-radius: 8px;">
                                    <div class="card-body" style="padding: 20px;">
                                        <h5><strong><i class="fas fa-paw" style="color: #ff8931;"></i> Pet Details</strong></h5>
                                        <p><strong>Pet Name:</strong> {{ optional($brooming->pet)->name }}</p>
                                        <p><strong>Breed:</strong> {{ optional($brooming->pet)->breed ?? 'Unknown' }}</p>

                                        @php
                                            $birthday = \Carbon\Carbon::parse($brooming->pet->birthday);
                                            $now = \Carbon\Carbon::now();
                                            $ageYears = $birthday->diffInYears($now);
                                            $ageMonths = $birthday->diffInMonths($now) % 12;
                                        @endphp

                                        <p>
                                            <strong>Age:</strong>
                                            @if ($ageYears > 0)
                                                {{ $ageYears }} years
                                            @endif
                                            @if ($ageMonths > 0)
                                                {{ $ageMonths }} months
                                            @endif
                                        </p>

                                        <h5><strong><i class="fas fa-briefcase" style="color: #ff8931;"></i> Grooming Service Details</strong></h5>
                                        <p><strong>Service Name:</strong> {{ optional($brooming->service)->name }}</p>
                                        <p><strong>Service Description:</strong> {{ optional($brooming->service)->description }}</p>
                                        <p><strong>Service Price:</strong> {{ optional($brooming->service)->price }}JD</p>

                                        <h5><strong><i class="fas fa-calendar-alt" style="color: #ff8931;"></i> Appointment Details</strong></h5>
                                        <p><strong>Appointment Date:</strong> {{ \Carbon\Carbon::parse($brooming->appointment_date)->format('Y-m-d') }}</p>

                                        @php
                                            $timeRange = explode(' - ', $brooming->appointment_time);
                                            $startTime = $timeRange[0]; // وقت البداية
                                            $endTime = $timeRange[1]; // وقت النهاية

                                            $appointmentStart = \Carbon\Carbon::parse($brooming->appointment_date . ' ' . $startTime);
                                            $now = \Carbon\Carbon::now();
                                            $timeRemaining = $appointmentStart->diff($now);
                                        @endphp

                                        <p><strong>Appointment Time:</strong> {{ $startTime }} - {{ $endTime }}</p>

                                        <h5><strong><i class="fas fa-clock" style="color: #ff8931;"></i> Time Remaining</strong></h5>
                                        <p>{{ $timeRemaining->days }} days, {{ $timeRemaining->h }} hours, and {{ $timeRemaining->i }} minutes</p>

                                        <p><strong>Status:</strong>
                                            <span class="{{ $brooming->status === 'approved' ? 'text-success' : ($brooming->status === 'pending' ? 'text-warning' : 'text-danger') }}">
                                                {{ ucfirst($brooming->status) }}
                                            </span>
                                        </p>

                                        @if ($brooming->status === 'approved' && $appointmentStart->isPast())
                                            <form action="{{ route('appointments.rate', $brooming->id) }}" method="GET">
                                                <button class="btn btn-primary">Rate Your Visit</button>
                                            </form>
                                        @endif
                                    </div>
                                </div><br>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
@endsection
