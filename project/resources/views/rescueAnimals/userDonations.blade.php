@extends('layouts.index')
@section('from', 'Profile')
@section('title', 'your donations')
@section('content')

            <section class="pet_team_wrap"style="background-image: url(/images/bg-paw.png);">
                <div class="container">
                    <h4 class="appointment-main-title">  Your Donations</h4><br>

                    @if($userDonations->isEmpty())
                        <p>You haven't made any donations yet.</p>
                    @else
                        <div class="pet_team_row">
                            @foreach($userDonations as $donation)
                                <div class="pet_team_column">
                                    <figure class="image-layer-affect">
                                        <img style="height:600px;width:400px " src="{{ asset( $donation->rescueAnimal->pet->image) }}" alt="image"> <!-- Update this path if you have a specific image for each donation -->

                                        <div class="pet_team_text" style="color: black">
                                            <h5>{{ $donation->rescueAnimal->pet->name }}</h5>
                                            <span>Donation Amount: {{ $donation->amount }}JD</span>
                                            <span>Date of Donation: {{ $donation->created_at->format('Y-m-d') }}</span><br>
                                            <div>
                                                <a href="{{ route('rescueAnimals.show', $donation->rescue_animal_id) }}" class="main_button btn2 bdr-clr hover-affect" style="margin-left: 18%">View Animal</a>
                                            </div>
                                        </div>
                                    </figure>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <a href="{{ route('profile') }}" class="main_button btn2 bdr-clr hover-affect">Back to Profile</a><br><br>
                </div>
            </section>

@endsection
