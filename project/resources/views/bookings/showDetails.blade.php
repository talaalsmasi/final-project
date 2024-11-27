@extends('layouts.index')
@section('from', 'Rooms')
@section('title', 'room details')
@section('content')

            <section class="child_service_wrap blog-full"style="background-image: url(/images/bg-paw.png);">
                <div class="container">
                    <div class="child_service_row">
                        <div class="child_service_column">
                            <figure class="image-layer-affect">
                                <img style="height: 550px;width:565px" src="{{ asset($room->image) }}" alt="">
                            </figure>
                            <div class="child_service_text">
                                <div><br><br>
                                    <div><h5>{{ $room->room_name }}'s Details </h5></div>
                                    <p class="card-text"><b>Type:</b> {{ $room->room_type }}</p>
                                    <p class="card-text"><b>Price:</b> {{ $room->price_per_night }}JD per night </p>
                                    <p class="{{ $room->status == 'available' ? 'text-success' : 'text-danger' }}">
                                        {{ ucfirst($room->status) }}
                                    </p><br><br>

                                    <!-- تعديل الزر ليصبح غير قابل للنقر إذا كانت الغرفة غير متاحة -->
                                    <a
                                        href="{{ $room->status == 'available' ? route('book-room', $room->id) : '#' }}"
                                        class="main_button btn2 bdr-clr hover-affect {{ $room->status == 'unavailable' ? 'disabled-link' : '' }}"
                                        {{ $room->status == 'unavailable' ? 'disabled' : '' }}
                                    >
                                        {{ $room->status == 'available' ? 'Book Now' : 'Unavailable' }}
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- إضافة CSS لتعطيل الزر بصريًا -->
            <style>
                .disabled-link {
                    pointer-events: none; /* تعطيل النقر */
                    opacity: 0.5; /* جعل الزر غير واضح */
                    cursor: not-allowed; /* تغيير شكل المؤشر */
                }
            </style>
@endsection
