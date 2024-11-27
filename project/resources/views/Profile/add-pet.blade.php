@extends('layouts.index')
@section('from', 'Profile')
@section('title', 'add a pet')
@section('content')

            <!--pet 404 warp start -->

            <section class="pet_appointment_wrap" style="margin-left: 13%">
                <div class="container">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <br>
                    <h4 class="appointment-main-title">Add a Pet</h4>
                    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                    <form action="{{ route('profile.add-pet') }}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <div class="pet_appointment_row">
                            <div class="appiontment_list">
                                <div class="pet_appointment_colum">
                                    <h6><i class="fas fa-tag" style="color: #ff8931;"></i> Pet Name:</h6>
                                    <div class="">
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="pet_appointment_colum">
                                    <h6><i class="fas fa-tree" style="color: #ff8931;"></i> Breed:</h6>
                                    <div class="">
                                        <input type="text" name="breed" class="form-control">
                                    </div>
                                </div>
                                <div class="pet_appointment_colum">
                                    <h6><i class="fas fa-venus" style="color: #ff8931;"></i>
                                        <i class="fas fa-mars" style="color: #ff8931;"></i> Gender:</h6>
                                    <div class="">
                                        <select name="gender" class="form-control" required>
                                            <option value="" disabled selected>Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="pet_appointment_colum">
                                    <h6><i class="fas fa-birthday-cake" style="color: #ff8931;"></i> Birthday:</h6>
                                    <div class="">
                                        <input type="date" name="birthday" class="form-control">
                                    </div>
                                </div>
                                <div class="pet_appointment_colum">
                                    <h6><i class="fas fa-paw" style="color: #ff8931;"></i> Animal Type:</h6>
                                    <select name="animal_type_id" class="form-control" required>
                                        @foreach($animalTypes as $type)
                                            <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="pet_appointment_colum">
                                    <h6><i class="fas fa-image" style="color: #ff8931;"></i> Pet Image:</h6>
                                    <input type="file" name="image" class="form-control">
                                </div>

                                <div class="pet_appointment_colum">
                                    <button class="main_button btn2 bdr-clr hover-affect" type="submit">Add Pet</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>

            <!-- pet team warp end -->

          @endsection
