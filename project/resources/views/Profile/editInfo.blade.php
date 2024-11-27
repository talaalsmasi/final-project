@extends('layouts.index')
@section('from', 'Profile')
@section('title', 'edit info')
@section('content')
            <!--sab banner wraper end-->

            <!--pet 404 warp start -->

            <section class="pet_appointment_wrap"style="margin-left: 10%">
                <div class="container">
                    <h2>Edit Profile: {{ $user->name }}</h2><br>

                    @if ($errors->any())
                        <div style="color: red;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="pet_appointment_row">
                            <div class="appiontment_list">
                                <div class="pet_appointment_colum">
                                    <h6><i class="fas fa-user" style="color: #ff8931;"></i> Name:</h6>
                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                                </div>

                                <div class="pet_appointment_colum">
                                    <h6><i class="fas fa-envelope" style="color: #ff8931;"></i> Email:</h6>
                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                                </div>

                                <div class="pet_appointment_colum">
                                    <h6><i class="fas fa-phone" style="color: #ff8931;"></i> Phone:</h6>
                                    <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                                </div>

                                <div class="pet_appointment_colum">
                                    <h6><i class="fas fa-lock" style="color: #ff8931;"></i> Password:</h6>
                                    <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current password">
                                </div>

                                <div class="pet_appointment_colum">
                                    <h6><i class="fas fa-image" style="color: #ff8931;"></i> Profile Image:</h6>

                                    <!-- عرض الصورة الحالية إذا كانت موجودة -->
                                    {{-- @if(isset($user->image) && $user->image != '')
                                        <img style="height: 70px;width:70px;border-radius:50%" src="{{ asset($user->image) }}" alt="User Image" style="width: 150px; height: auto; display: block; margin-bottom: 10px;">
                                    @endif --}}

                                    <!-- حقل تحميل صورة جديدة -->
                                    <input type="file" name="image" class="form-control">
                                    <small style="color: black">Choose a new image to update (optional).</small>
                                </div>

                                <div class="pet_appointment_colum" >
                                    <br>
                                    <button class="main_button btn2 bdr-clr hover-affect" type="submit">Update Profile</button>
                                    <a style="margin-left: 3vh" href="{{ route('profile') }}" class="main_button btn2 bdr-clr hover-affect">Back to Profile</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>


            <!-- pet team warp end -->

            <!--pet company wrap start-->
            @endsection
