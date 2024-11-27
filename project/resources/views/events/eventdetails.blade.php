@extends('layouts.index')
@section('from', 'Events')
@section('title', 'Event details')
@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<section class="child_service_wrap blog-full blog_post_detail"style="background-image: url(/images/bg-paw.png);">
    <div class="container">
        <div class="child_service_row">
            <div class="pet_blog_full_detail">
                <!-- Event details section -->
                <div class="child_service_column">
                    <figure class="image-layer-affect">
                        <img style="height: 400px; width:100%;" src="{{ asset($event->image) }}" alt="">
                    </figure>
                    <div class="child_service_text">
                        {{-- <img class="shap_fig_position" src="{{ asset('images/shap-fig01.png') }}" alt=""> --}}
                        <h5 style="margin-right:50%">{{ $event->title }}</h5><br>
                        <p style="margin-right: 30%">{{ $event->description }}</p>

                        <!-- Event information with icons -->
                        <div class="blog_post_info">
                            <ul class="child_service_info">
                                <!-- Date -->
                                <li><a href="#"><i class="fa fa-calendar"></i>
                                    {{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('d F, Y') : 'No date available' }}
                                </a></li>

                                <!-- Time -->
                                <li><a href="#"><i class="fa fa-clock"></i>
                                    {{ $event->event_time ? \Carbon\Carbon::parse($event->event_time)->format('h:i A') : 'No time available' }}
                                </a></li>

                                <!-- Capacity -->
                                <li><a href="#"><i class="fa fa-users"></i> Capacity: {{ $event->capacity }}</a></li>

                                <!-- Registered Count -->
                                <li><a href="#"><i class="fa fa-user-check"></i> Registered: {{ $event->registered_count }}</a></li>
                            </ul>

                            <!-- Registration button -->
                            <form action="{{ route('events.register', $event->id) }}" method="POST">
                                @csrf
                                @php
                                    $eventDateTime = \Carbon\Carbon::parse($event->event_date . ' ' . $event->event_time);
                                    $isPastEvent = now()->greaterThanOrEqualTo($eventDateTime);
                                @endphp

                                <button type="submit"
                                        class="main_button btn2 bdr-clr hover-affect"
                                        @if($event->registered_count >= $event->capacity || $isPastEvent) disabled @endif>
                                    @if($isPastEvent)
                                        Event Finished
                                    @elseif($event->registered_count >= $event->capacity)
                                        Full
                                    @else
                                        I want to come
                                    @endif
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
