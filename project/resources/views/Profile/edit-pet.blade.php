@extends('layouts.index')
@section('from', 'Profile')
@section('title', 'edit a pet')
@section('content')

            <!--pet 404 warp start -->
            <section class="pet_appointment_wrap"style="margin-left: 10%">
                <div class="container">
                    <h4 class="appointment-main-title">Edit Pet: {{ $pet->name }}</h4>

                    @if ($errors->any())
                        <div style="color: red;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update-pet', $pet->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="pet_appointment_row">
                            <div class="appiontment_list">
                                <div class="pet_appointment_colum">
                                    <h6><i class="fas fa-tag" style="color: #ff8931;"></i> Pet Name:</h6>
                                    <input type="text" name="name" class="form-control" value="{{ $pet->name }}" required>
                                </div>

                                <div class="pet_appointment_colum">
                                    <h6><i class="fas fa-tree" style="color: #ff8931;"></i> Breed:</h6>
                                    <input type="text" name="breed" class="form-control" value="{{ $pet->breed }}">
                                </div>

                                <div class="pet_appointment_colum">
                                    <h6><i class="fas fa-birthday-cake" style="color: #ff8931;"></i> Birthday:</h6>
                                    <input type="date" name="birthday" class="form-control" value="{{ $pet->birthday }}">
                                </div>

                                <div class="pet_appointment_colum">
                                    <h6><i class="fas fa-paw" style="color: #ff8931;"></i> Animal Type:</h6>
                                    <select name="animal_type_id" class="form-control" required>
                                        @foreach($animalTypes as $type)
                                            <option value="{{ $type->id }}" {{ $pet->animal_type_id == $type->id ? 'selected' : '' }}>
                                                {{ $type->type_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="pet_appointment_colum">
                                    <h6><i class="fas fa-image" style="color: #ff8931;"></i> Pet Image:</h6>
                                    <input type="file" name="image" class="form-control">
                                    @if($pet->image)
                                        <img src="{{ asset('storage/' . $pet->image) }}" alt="{{ $pet->name }}" style="width: 50px; height: 50px;">
                                    @endif
                                </div>
                                <div class="pet_appointment_colum" style="visibility: hidden">
                                    <h6><i class="fas fa-paw" style="color: #ff8931;"></i> Animal Type:</h6>
                                    <select name="animal_type_id" class="form-control" required>
                                        @foreach($animalTypes as $type)
                                            <option value="{{ $type->id }}" {{ $pet->animal_type_id == $type->id ? 'selected' : '' }}>
                                                {{ $type->type_name }}
                                            </option>
                                        @endforeach
                                    </select><br>
                                </div>

                                <div class="pet_appointment_colum">
                                    <button class="main_button btn2 bdr-clr hover-affect" type="submit">Update Pet</button>
                                    <a href="{{ route('profile') }}" class="main_button btn2 bdr-clr hover-affect">Back to Profile</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>

            <!-- pet team warp end -->

@endsection
