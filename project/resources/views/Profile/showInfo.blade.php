@extends('layouts.index')
@section('from', 'Profile')
@section('title', 'Show info')
@section('content')

            <section class="pet_appointment_wrap"style="margin-left: 10%">
                <div class="container">
                    <h2>Your Profile: {{ $user->name }}</h2><br>

                    <div class="pet_appointment_row">
                        <div class="appiontment_list">
                            <div class="pet_appointment_colum">
                                <h6><i class="fas fa-user" style="color: #ff8931;"></i> Name:</h6>
                                <p>{{ $user->name }}</p>
                            </div>

                            <div class="pet_appointment_colum">
                                <h6><i class="fas fa-envelope" style="color: #ff8931;"></i> Email:</h6>
                                <p>{{ $user->email }}</p>
                            </div>

                            <div class="pet_appointment_colum">
                                <h6><i class="fas fa-phone" style="color: #ff8931;"></i> Phone:</h6>
                                <p>{{ $user->phone ?? 'No phone number provided' }}</p>
                            </div>
                            <div class="pet_appointment_colum">
                                <h6><i class="fa-solid fa-image"style="color: #ff8931;"></i> Image:</h6>

                                @if(isset($user->image) && $user->image != '')
                                    <img style="height: 70px;width:70px;border-radius:50%" src="{{ asset($user->image) }}" alt="User Image" style="width: 150px; height: auto;">
                                @else
                                    <p>No image provided</p>
                                @endif
                            </div>


                            <div class="pet_appointment_colum">
                                <a  href="{{ route('profile.editInfo') }}" class="main_button btn2 bdr-clr hover-affect"
                                >Edit Informations</a>
                                <a  href="{{ route('profile') }}" class="main_button btn2 bdr-clr hover-affect"
                                >back to profile</a>
                            </div>

                        </div>
                    </div>
                </div>
            </section>

          @endsection
