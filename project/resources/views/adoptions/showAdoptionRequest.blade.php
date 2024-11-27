@extends('layouts.index')
@section('from', 'profile')
@section('title', 'your adoption request')
@section('content')
            <section class="pet_team_wrap"style="background-image: url(/images/bg-paw.png);">
                <div class="container">
                    <h4 class="appointment-main-title">Your Adoption Request</h4><br>
                    <div class="pet_team_row">

                        @foreach($adoptionRequests as $request)
                            <div class="pet_team_column">
                                <figure class="image-layer-affect">
                                    <img src="{{ asset($request->pet->image) }}" alt="image">

                                    <div style="color: black" class="pet_team_text">
                                        <h5>{{ $request->pet->name }}</h5>
                                        <span>Breed: {{ $request->pet->breed ?? 'Unknown' }}</span>
                                        <span>gender: {{ $request->pet->gender ?? 'Unknown' }}</span>

                                        <span>Status:
                                            @if($request->status == 'pending')
                                                 Pending
                                            @elseif($request->status == 'approved')
                                                Approved
                                            @elseif($request->status == 'rejected')
                                                Rejected
                                            @else
                                                <span class="badge bg-secondary">Unknown
                                            @endif
                                        </span>


                                        <form action="{{ route('adoptions.cancel', $request->id) }}" method="POST">
                                            @csrf
                                            <br> <button type="submit" style="margin-left: 12%" class="main_button hover-affect">Cancel the request</button>
                                        </form>
                                    </div>
                                </figure>
                            </div>
                        @endforeach

                    </div>
                    <a href="{{ route('profile') }}" class="main_button btn2 bdr-clr hover-affect" >Back to Profile</a><br><br>
                </div>

            </section>
         @endsection
