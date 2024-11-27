@extends('layouts.index')
@section('from', 'Home')
@section('title', 'Events')
@section('content')

<section class="child_service_wrap blog-post"style="background-image: url(/images/bg-paw.png);">
    <div class="container">
        <div class="mian_heading text-center"><h2>Upcoming Events</h2></div>
        <div class="child_service_row">
            @foreach($events as $event)
                <div class="child_service_column">
                    <figure class="image-layer-affect" style="position: relative;">
                        <!-- تحقق مما إذا كان الحدث مكتمل العدد أو منتهي -->
                        @php
                            $isFinished = \Carbon\Carbon::now()->greaterThan(\Carbon\Carbon::parse($event->event_date . ' ' . $event->event_time));
                        @endphp

                        <!-- تطبيق الشفافية والنصوص بناءً على حالة الحدث -->
                        <img style="height: 280px; width:350px;
                            @if($event->registered_count >= $event->capacity || $isFinished) opacity: 0.5; @endif"
                             src="{{ asset($event->image) }}" alt="{{ $event->title }}">

                        <!-- إضافة نص "العدد مكتمل" أو "الحدث منتهي" بناءً على حالة الحدث -->
                        @if($event->registered_count >= $event->capacity)
                            <div style="
                                position: absolute;
                                top: 0;
                                left: 0;
                                width: 100%;
                                height: 100%;
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                color: white;
                                font-size: 1.5rem;
                                background-color: rgba(0, 0, 0, 0.5);">
                                Full Capacity
                            </div>
                        @elseif($isFinished)
                            <div style="
                                position: absolute;
                                top: 0;
                                left: 0;
                                width: 100%;
                                height: 100%;
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                color: white;
                                font-size: 1.5rem;
                                background-color: rgba(0, 0, 0, 0.5);">
                                The Event is Finished
                            </div>
                        @endif
                    </figure>

                    <div class="child_service_text">
                        <h5>
                            <a href="{{ route('events.details', $event->id) }}" style="text-decoration: none; color: inherit;">
                                {{ $event->title }}
                            </a>
                        </h5>
                        <ul class="child_service_info">
                            <li>
                                <a href="#"><i class="fa fa-calendar"></i>
                                    {{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('d F, Y') : 'No date available' }}
                                </a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-clock"></i>
                                    {{ $event->event_time ? \Carbon\Carbon::parse($event->event_time)->format('h:i A') : 'No time available' }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
