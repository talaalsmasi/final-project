@extends('layouts.index')
@section('from', 'Rescue Pets')
@section('title', $rescueAnimal->pet->name .' details')
@section('content')
            <section class="child_service_wrap blog-full"style="background-image: url(/images/bg-paw.png);">
                <div class="container">
                  <div class="child_service_row">
                            <div class="child_service_column">
                                <figure class="image-layer-affect">
                                    <img style="height: 550px;width:565px" src="{{ asset($rescueAnimal->pet->image) }}" alt="">
                                </figure>
                                <div class="child_service_text">

                                    <div>
                                        <div><h5>{{ $rescueAnimal->pet->name }}'s Details </h5></div>
                                        <p class="card-text"><b>Breed:</b> {{ $rescueAnimal->pet->breed ?? 'Unknown' }}</p>
                                        <p class="card-text"><b>Age:</b>
                                            @php
                                                $birthdate = \Carbon\Carbon::parse($rescueAnimal->pet->birthday);
                                                $now = \Carbon\Carbon::now();
                                                $ageInYears = $birthdate->diffInYears($now);
                                                $remainingMonths = $birthdate->addYears($ageInYears)->diffInMonths($now);
                                            @endphp
                                            {{ $ageInYears }} years and {{ $remainingMonths }} months old
                                        </p>
                                        <p class="card-text"><b>Description:</b> {{ $rescueAnimal->description ?? 'No description available.' }}</p>

                                        <p class="card-text"><b>Current Donation:</b> {{ $rescueAnimal->current_donated_amount }} / {{ $rescueAnimal->total_required_amount }}JD</p>
                                        <a href="{{ route('rescueAnimals.donate', $rescueAnimal->id) }}" class="main_button btn2 bdr-clr hover-affect">Donate Now</a><br>
                                    </div>

                                </div>
                            </div>
                  </div>
                </div>
              </section>

@endsection
