<!-- resources/views/Admin/layouts/header.blade.php -->
{{-- <header class="header">
    <div class="user-menu">
        <span>Admin Name</span>
        <img src="{{ asset('Admin/user.jpg') }}" alt="User" class="user-image">
    </div>
</header> --}}

{{-- <nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <p style="font-size: 40px">
        <img style="height:30%;width:30%" src="{{ asset('images/petpaladmin.png') }}" alt=""> PetPal
    </p>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <!-- أيقونة الرسائل -->

                <div class="availability-section">


                    <form action="{{ route('driver.toggleAvailability') }}" method="POST">
                        <span id="availability-status" style="color: {{ Auth::user()->driver->available ? 'green' : 'red' }};">
                            <i class="fas fa-circle"></i>
                            {{ Auth::user()->driver->available ? 'Available' : 'Not Available' }}
                        </span>
                        @csrf
                        <select id="availability-dropdown" name="available" onchange="this.form.submit()" style="margin-left: 10px;">
                            <option value="1" {{ Auth::user()->driver->available ? 'selected' : '' }}>Available</option>
                            <option value="0" {{ !Auth::user()->driver->available ? 'selected' : '' }}>Not Available</option>
                        </select>
                    </form>
                </div>



            </li>

            <!-- صورة الملف الشخصي -->
            <li class="nav-item">
                <a style="color: white" class="nav-link" href="#">
                    @if(auth()->user() && auth()->user()->image)
                        <img src="{{ asset(auth()->user()->image) }}" alt="Profile Image" width="50" height="50" style="border-radius: 50%; margin-right: 10px;">
                    @else
                        <img src="{{ asset('path/to/default/image.jpg') }}" alt="Default Profile Image" width="50" height="50" style="border-radius: 50%; margin-right: 10px;">
                    @endif
                    {{ auth()->user()->name }}
                    <i class="fa-solid fa-right-from-bracket" style="cursor: pointer;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"></i>
                </a>


                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</nav> --}}



