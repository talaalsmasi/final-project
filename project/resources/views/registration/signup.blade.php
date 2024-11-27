@extends('layouts.index')
@section('title', 'signup')
@section('from', 'Home')
@section('content')
            <section class="pet_appointment_wrap"><br><br><br>
                <a href="https://front.codes/" class="logo" target="_blank"></a>

                <!-- عرض رسالة النجاح -->
                @if (session('success'))
                    <div style="color: green;">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="section">
                    <div class="container">
                        <div class="row full-height justify-content-center">
                            <div class="col-12 text-center align-self-center py-5">
                                <div class="section pb-5 pt-5 pt-sm-2 text-center">
                                    <h6 class="mb-0 pb-3"><span>Log In </span><span>Sign Up</span></h6>
                                    <input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>
                                    <label for="reg-log"></label>
                                    <div class="card-3d-wrap mx-auto">
                                        <div class="card-3d-wrapper">

                                            <!-- نموذج تسجيل الدخول -->
                                            <div class="card-back">
                                                <div class="center-wrap">
                                                    <div class="section text-center">
                                                        <form method="POST" action="{{ route('login') }}">
                                                            @csrf
                                                            <h4 class="appointment-main-title">Log In</h4><br>

                                                            <div class="form-group mt-2">
                                                                <input type="email" name="email" class="form-style" placeholder="Your Email" id="logemail" autocomplete="off" value="{{ old('email') }}">
                                                                <i class="input-icon fas fa-envelope"></i>
                                                            </div>
                                                            <!-- عرض خطأ خاص بحقل الايميل -->
                                                            @if ($errors->has('email'))
                                                                <div style="color: red;">
                                                                    {{ $errors->first('email') }}
                                                                </div>
                                                            @endif
                                                            <br>

                                                            <div class="form-group mt-2">
                                                                <input type="password" name="password" class="form-style" placeholder="Your Password" id="logpass" autocomplete="off">
                                                                <i class="input-icon fas fa-lock"></i>
                                                            </div>
                                                            <!-- عرض خطأ خاص بحقل الباسوورد -->
                                                            @if ($errors->has('password'))
                                                                <div style="color: red;">
                                                                    {{ $errors->first('password') }}
                                                                </div>
                                                            @endif
                                                            <br>

                                                            <button type="submit" class="btn mt-4">Login</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- نموذج إنشاء الحساب -->
                                            <div class="card-front">
                                                <div class="center-wrap">
                                                    <div class="section text-center">
                                                        <form method="POST" action="{{ route('signup') }} " enctype="multipart/form-data">
                                                            @csrf
                                                            <h4 class="appointment-main-title">Sign Up</h4>

                                                            <div class="form-group mt-2">
                                                                <input type="text" name="name" class="form-style" placeholder="Your Full Name" id="logname" autocomplete="off" value="{{ old('name') }}">
                                                                <i class="input-icon fas fa-user"></i>
                                                            </div>
                                                            <!-- عرض خطأ خاص بحقل الاسم -->
                                                            @if ($errors->has('name'))
                                                                <div style="color: red;">
                                                                    {{ $errors->first('name') }}
                                                                </div>
                                                            @endif
                                                            <br>

                                                            <div class="form-group mt-2">
                                                                <input type="email" name="email" class="form-style" placeholder="Your Email" id="logemail" autocomplete="off" value="{{ old('email') }}">
                                                                <i class="input-icon fas fa-envelope"></i>
                                                            </div>
                                                            <!-- عرض خطأ خاص بحقل الايميل -->
                                                            @if ($errors->has('email'))
                                                                <div style="color: red;">
                                                                    {{ $errors->first('email') }}
                                                                </div>
                                                            @endif
                                                            <br>

                                                            <div class="form-group mt-2">
                                                                <input type="text" name="phone" class="form-style" placeholder="Your phone number" id="lognum" autocomplete="off" value="{{ old('phone') }}">
                                                                <i class="input-icon fas fa-phone"></i>
                                                            </div>
                                                            <!-- عرض خطأ خاص بحقل الهاتف -->
                                                            @if ($errors->has('phone'))
                                                                <div style="color: red;">
                                                                    {{ $errors->first('phone') }}
                                                                </div>
                                                            @endif
                                                            <br>

                                                            <div class="form-group mt-2">
                                                                <input type="password" name="password" class="form-style" placeholder="Your Password" id="logpass" autocomplete="off">
                                                                <i class="input-icon fas fa-lock"></i>
                                                            </div>
                                                            <!-- عرض خطأ خاص بحقل الباسوورد -->
                                                            @if ($errors->has('password'))
                                                                <div style="color: red;">
                                                                    {{ $errors->first('password') }}
                                                                </div>
                                                            @endif
                                                            <br>
                                                            <div class="form-group mt-2">
                                                                <label for="file-upload" class="custom-file-label form-style">
                                                                    <i class="fas fa-image"></i> Upload Image
                                                                </label>
                                                                <input id="file-upload" type="file" name="image" style="display: none;" >
                                                                <span id="file-chosen">No file chosen</span>
                                                                @if ($errors->has('name'))
                                                                <div style="color: red;">
                                                                    {{ $errors->first('name') }}
                                                                </div>
                                                            @endif
                                                            </div><br>

                                                            <button type="submit" class="btn mt-4">Submit</button>
                                                        </form>
                                                        <script>
                                                            const fileUpload = document.getElementById('file-upload');
                                                            const fileChosen = document.getElementById('file-chosen');

                                                            fileUpload.addEventListener('change', function() {
                                                                fileChosen.textContent = this.files[0].name;
                                                            });
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    @endsection
