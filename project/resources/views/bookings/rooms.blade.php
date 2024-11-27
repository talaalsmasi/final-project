@extends('layouts.index')
@section('title', 'Rooms')
@section('from', 'Home')
@section('content')
            <section class="pet_team_wrap" style="background-image: url(/images/bg-paw.png);">
                <div class="mian_heading text-center"><h2>Rooms</h2></div>

                <div class="container">
                    <div class="pet_team_row">
                        @if($rooms->isEmpty())
                            <p>No rooms available.</p>
                        @else

                            @foreach($rooms as $room)
                                <div style="background-color: white;color:black" class="pet_team_column {{ $room->status == 'available' ? 'available-room' : 'unavailable-room' }}">
                                    <figure class="image-layer-affect">
                                        <img style="height: 452px;width:360px" src="{{$room->image}}" alt="image">
                                         <div class="pet_team_text">
                                            <h5>{{ $room->room_name }}</h5>
                                            <span>Type: {{ $room->room_type }}</span>
                                            <span>Price: {{ $room->price_per_night }}JD per night</span>
                                            <span class="{{ $room->status == 'available' ? 'text-success' : 'text-danger' }}">
                                                {{ ucfirst($room->status) }}
                                            </span>
                                        </div>
                                    </figure>
                                    <a href="{{ route('rooms.show', $room->id) }}" class="main_button btn2 bdr-clr hover-affect" style="margin-left: 25%">View Details</a><br><br>
                                     <br>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </section>
          @endsection
