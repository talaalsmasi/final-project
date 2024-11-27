@extends('layouts.index')
@section('from', 'Home')
@section('title', 'rescue Pets')
@section('content')
            <section class="pet_team_wrap"style="background-image: url(/images/bg-paw.png);">
                <div class="mian_heading text-center"><h2>Rescuse pets</h2></div>

                <div class="container">
                    <div class="pet_team_row">

                        @foreach($rescueAnimals as $rescueAnimal)
                            <div class="pet_team_column" >
                                <figure class="image-layer-affect">
                                    <img style="height: 600px;width:400px" src="{{ asset($rescueAnimal->pet->image) }}" alt="image">

                                    <div class="pet_team_text" style="color: black">
                                        <h5>{{ $rescueAnimal->pet->name }}</h5>
                                        <span>Current Donation: {{ $rescueAnimal->current_donated_amount }} / {{ $rescueAnimal->total_required_amount }} JD</span>


                                       <br>
                                        <div>
                                            <a href="{{ route('rescueAnimals.show', $rescueAnimal->id) }}" class="main_button btn2 bdr-clr hover-affect" style="margin-left: 17%">View Details</a>
                                        </div>


                                    </div>
                                </figure>
                            </div>
                        @endforeach

                    </div>
                </div>
            </section>

@endsection
