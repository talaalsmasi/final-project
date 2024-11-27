<!-- Header -->
<header class="header">
    <div class="header-left">
        <button class="menu-toggle" id="menu-toggle"></button>
        <img style="height:60px;width:222px;margin-left:-35px" src="{{ asset('images/admin-logo2.png') }}" alt="">
    </div>
    <div class="header-right">
        <div class="user-profile" style="margin-top: -20px">
            <div class="availability-section">
                <form style="margin-top: 12px" action="{{ route('driver.toggleAvailability') }}" method="POST">
                    <span id="availability-status" style="color: {{ Auth::user()->driver->available ? 'green' : 'red' }};">
                        <i class="fas fa-circle"></i>
                        {{ Auth::user()->driver->available ? 'Available' : 'Not Available' }}
                    </span>
                    @csrf

                </form>
            </div>

            <li class="nav-item">
                <a class="nav-link" style="font-weight: bold;color:white" href="#">
                    @if(auth()->user() && auth()->user()->image)
                        <img src="{{ asset(auth()->user()->image) }}" alt="Profile Image" width="50" height="50" style="border-radius: 50%; margin-right: 10px;margin-top:-10px">
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
        </div>
    </div>
</header>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <nav>
        <ul>
            {{-- <li><a href="{{ route('driver.dashboard.index') }}"><i class="fas fa-tachometer-alt"></i> Dashboard<i style="visibility: hidden" class="fas fa-chevron-down"></i></a></li> --}}
            <li><a href="{{route('driver.info')}}"><i class="fas fa-user-shield"></i> Informations<i style="visibility: hidden" class="fas fa-chevron-down"></i></a></li>
            <li><a href="{{ route('driver.requests.index') }}"><i class="fas fa-taxi"></i> Taxi request<i style="visibility: hidden" class="fas fa-chevron-down"></i></a></li>
            <li>
                <div class="select-container">
                    <form action="{{ route('driver.toggleAvailability') }}" method="POST">
                        @csrf
                        <select id="availability-dropdown" name="available" onchange="this.form.submit()">
                            <option value="1" {{ Auth::user()->driver->available ? 'selected' : '' }}>Available</option>
                            <option value="0" {{ !Auth::user()->driver->available ? 'selected' : '' }}>Not Available</option>
                        </select>
                    </form>
                </div>
            </li>
        </ul>
    </nav>
</aside>
