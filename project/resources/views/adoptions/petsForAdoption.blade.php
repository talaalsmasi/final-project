@extends('layouts.index')
@section('from', 'Home')
@section('title', 'Pets for Adoption')
@section('content')

<style>
    span {
        color: black;
    }
    .custom-shape-divider-bottom-1687358784 .shape-fill {
        fill: rgb(249, 246, 246);
    }
    .custom-shape-divider-top-1687264903 .shape-fill {
        fill: #FFFFFF;
    }
</style>

<section class="pet_service" style="background-image: url(/images/bg-paw.png);">
    <div class="custom-container">
        <div class="mian_heading text-center"><h2>Animals You Can Adopt</h2></div>


        <div class="pet_service_row">
            <div class="pet_service_column">
                <figure>
                    <img src="{{ asset('images/service_bg.png') }}" alt="image">
                    <img class="hover_img" src="{{ asset('images/service_bg_hover.png') }}" alt="image">
                    <a class="icon_img" href="{{ route('adoption.pets', ['type' => 2]) }}">
                        <img src="{{ asset('images/icon-img.png') }}" alt="image">
                    </a>
                </figure>
                <h6>Dog</h6>
            </div>
            <div class="pet_service_column">
                <figure>
                    <img src="{{ asset('images/service_bg.png') }}" alt="image">
                    <img class="hover_img" src="{{ asset('images/service_bg_hover.png') }}" alt="image">
                    <a class="icon_img" href="{{ route('adoption.pets', ['type' => 1]) }}">
                        <img src="{{ asset('images/icon-img01.png') }}" alt="image">
                    </a>
                </figure>
                <h6>Cat</h6>
            </div>
            <div class="pet_service_column">
                <figure>
                    <img src="{{ asset('images/service_bg.png') }}" alt="image">
                    <img class="hover_img" src="{{ asset('images/service_bg_hover.png') }}" alt="image">
                    <a class="icon_img" href="{{ route('adoption.pets', ['type' => 3]) }}">
                        <img src="{{ asset('images/icon-img02.png') }}" alt="image">
                    </a>
                </figure>
                <h6>Parrots</h6>
            </div>
            <div class="pet_service_column">
                <figure>
                    <img src="{{ asset('images/service_bg.png') }}" alt="Pet Image">
                    <img class="hover_img" src="{{ asset('images/service_bg_hover.png') }}" alt="image">
                    <a class="icon_img" href="{{ route('adoption.pets', ['type' => 4]) }}">
                        <img src="{{ asset('images/icon-img03.png') }}" alt="image">
                    </a>
                </figure>
                <h6>Fish</h6>
            </div>
        </div><br><br><br><br>

        <div style="text-align: center">
            <a class="main_button btn2 bdr-clr hover-affect" href="{{ route('adoption.pets') }}">Show All</a>
        </div>
    </div> <br> <br> <br>

    <div class="container">
        <div class="pet_team_row">
            @foreach($pets as $pet)
                <div class="pet_team_column">
                    <figure class="image-layer-affect">
                        <img style="height: 700px;width:564px" src="{{ asset($pet->image) }}" alt="image">

                        <div class="pet_team_text">
                            <h5>{{ $pet->name }}</h5>
                            <span>Breed: {{ $pet->breed ?? 'Unknown' }}</span>
                            <span>Gender: {{ $pet->gender ?? 'Unknown' }}</span>

                            @php
                                $birthday = \Carbon\Carbon::parse($pet->birthday);
                                $now = \Carbon\Carbon::now();
                                $ageYears = $birthday->diffInYears($now);
                                $ageMonths = $birthday->diffInMonths($now) % 12;
                            @endphp

                            <span>Age:
                                @if ($ageYears > 0)
                                    {{ $ageYears }} years
                                @endif
                                @if ($ageMonths > 0)
                                    {{ $ageMonths }} months
                                @endif
                            </span><br>

                            <div>
                                @php
                                    // Check if the user has an adoption request for this pet


                                    $hasRequest = \App\Models\Adoption::where('user_id', auth()->id())
                                        ->where('pet_id', $pet->id)
                                        ->whereIn('status', ['pending', 'rejected'])
                                        ->exists();
                                @endphp

                                @if ($hasRequest)
                                    <button class="main_button btn2 bdr-clr hover-affect" style="margin-left: 17%" disabled>You have a request</button>
                                @else
                                    <a href="{{ route('adopt.form', ['id' => $pet->id]) }}" class="main_button btn2 bdr-clr hover-affect" style="margin-left: 17%">Adopt Now</a>
                                @endif
                            </div>
                        </div>
                    </figure>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
