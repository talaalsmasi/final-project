@extends('layouts.index')
@section('title', 'Subscription Details')
@section('from', 'profile')
@section('content')
<br>
<section class="pet_subscription_wrap">
    <div class="container">
        <h2>Subscription Details</h2>

        @if($subscriptions->isEmpty())
            <p>No subscriptions found for this pet.</p>
        @else
            <div class="row">
                @foreach ($subscriptions as $subscription)
                    <div class="col-md-6">
                        <div class="card mb-3" style="background-color: rgb(249, 246, 246); background-image: url('{{ asset('images/service-bg-paw.png') }}'); box-shadow: 0px 6px 12px -1px #ddd; border: none; border-radius: 8px;">
                            <div class="card-body" style="padding: 20px; display: flex; justify-content: space-between; align-items: flex-start;">
                                <div class="subscription-details">

                                    <!-- Pet Details -->
                                    <h5><strong><i class="fas fa-paw" style="color: rgb(255, 139, 51);"></i> Pet Details</strong></h5>
                                    <p><strong>Pet Name:</strong> {{ optional($subscription->pet)->name }}</p>
                                    <p><strong>Breed:</strong> {{ optional($subscription->pet)->breed ?? 'Unknown' }}</p>

                                    @if (isset($subscription->pet->birthday))
                                        @php
                                            $birthday = \Carbon\Carbon::parse($subscription->pet->birthday);
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

                                    <!-- Subscription Details -->
                                    <h5><strong><i class="fas fa-box" style="color: #ff8931;"></i> Subscription Details</strong></h5>
                                    <p><strong>Subscription Name:</strong> {{ optional($subscription->subscription)->name }}</p>
                                    <p><strong>Description:</strong> {{ optional($subscription->subscription)->description }}</p>
                                    <p><strong>Price per Session:</strong> ${{ number_format(optional($subscription->subscription)->price, 2) }}</p>
                                    <br>

                                    <!-- Training Schedule -->
                                    <h5><strong><i class="fas fa-calendar-alt" style="color: #ff8931;"></i> Training Schedule</strong></h5>
                                    <p><strong>Month:</strong> {{ date("F", mktime(0, 0, 0, $subscription->month, 10)) }} ({{ $subscription->month }})</p>
                                    <p><strong>Week Number:</strong> {{ $subscription->week_number }}</p>
                                    <p><strong>Training Time:</strong> {{ $subscription->session_time }}</p>

                                    @php
                                    // تعريف التاريخ الحالي
                                    $currentDate = \Carbon\Carbon::now();

                                    // إعداد بداية الأسبوع المختار بناءً على الشهر ورقم الأسبوع
                                    $trainingStart = \Carbon\Carbon::createFromFormat('Y-m', $currentDate->year . '-' . $subscription->month)
                                                                    ->startOfMonth()
                                                                    ->addWeeks($subscription->week_number - 1)
                                                                    ->startOfWeek(\Carbon\Carbon::SUNDAY);

                                    // أيام التدريب للأسبوع: الأحد، الثلاثاء، والخميس
                                    $trainingDays = [];
                                    foreach ([0, 2, 4] as $dayOfWeek) { // 0 = الأحد، 2 = الثلاثاء، 4 = الخميس
                                        $trainingDay = $trainingStart->copy()->addDays($dayOfWeek);

                                        // التحقق من أن التاريخ ضمن نفس الشهر والأسبوع
                                        if ($trainingDay->month == $subscription->month) {
                                            $trainingDays[] = [
                                                'date' => $trainingDay->format('Y-m-d'),
                                                'day' => $trainingDay->format('l') // عرض اسم اليوم (مثل Sunday)
                                            ];
                                        }
                                    }
                                @endphp

                                <!-- Training Dates Display -->
                                <h5><strong><i class="fas fa-calendar-alt" style="color: #ff8931;"></i> Training Dates</strong></h5>
                                @if (count($trainingDays) > 0)
                                    <ul>
                                        @foreach ($trainingDays as $session)
                                            <li style="color: black">{{ $session['day'] }} - {{ $session['date'] }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-danger">No training days available for this week.</p>
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
