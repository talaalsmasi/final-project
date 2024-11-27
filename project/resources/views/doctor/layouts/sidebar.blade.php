<!-- Header -->
  <header class="header">
    <div class="header-left">
      <button class="menu-toggle" id="menu-toggle"></button>
      <img style="height:60px;width:222px;margin-left:-35px" src="{{ asset('images/admin-logo2.png') }}" alt=""> </div>
    <div class="header-right">
      <div class="user-profile" style="margin-top: -20px">
        <li class="nav-item">
            <a  class="nav-link" style="font-weight: bold;color:white" href="#">
                @if(auth()->user() && auth()->user()->image)
                    <img src="{{ asset(auth()->user()->image) }}" alt="Profile Image" width="50" height="50" style="border-radius: 50%; margin-right: 10px;margin-top:-10px">
                @else
                    <img src="{{ asset('path/to/default/image.jpg') }}" alt="Default Profile Image" width="50" height="50" style="border-radius: 50%; margin-right: 10px;">
                @endif
               Dr. {{ auth()->user()->name }}
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
        {{-- <li> <a href="{{ route('doctor.dashboard.index') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li> --}}
        <li><a href="{{route('doctor.info')}}"><i class="fas fa-user-shield"></i> Informations<i style="visibility: hidden" class="fas fa-chevron-down"></i></a></li>
        <li><a href="{{ route('doctor.appointments.index') }}"><i class="fas fa-calendar-alt"></i> Appointments<i style="visibility: hidden" class="fas fa-chevron-down"></i></a></li>
        <li><a href="{{ route('doctor.posts.index') }}"><i class="fa-solid fa-address-card"></i> Posts<i style="visibility: hidden" class="fas fa-chevron-down"></i></a></li>
      </ul>
    </nav>
  </aside>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="scripts.js"></script>
  <script>
    $(document).ready(function() {
  // Toggle sidebar
  $('#menu-toggle').click(function() {
    $('.sidebar').toggleClass('collapsed');
    $('.content').toggleClass('expanded');
  });

  // Dropdown functionality
  $('.dropdown > a').click(function(e) {
    e.preventDefault();
    const $submenu = $(this).next('.submenu');
    $('.submenu').not($submenu).slideUp();
    $submenu.slideToggle();
  });
});

  </script>



