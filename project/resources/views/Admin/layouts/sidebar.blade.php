 <header class="header">

    <div class="header-left">
      <button class="menu-toggle" id="menu-toggle"></button>
      <img style="height:60px;width:222px;margin-left:-35px" src="{{ asset('images/admin-logo2.png') }}" alt=""> </div>
    <div class="header-right">
      <div class="user-profile" style="margin-top: -20px">
        <div style="margin-top: 15px">
            <a href="{{route('admin.contact-messages.index')}}"><i class="fas fa-envelope" style="color: white;"></i></a>
        </div>
        <li class="nav-item">

            <a  class="nav-link" style="font-weight: bold;color:white" href="#">
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
        <li>
          <a href="{{route('admin.dashboard.index')}}"><i class="fas fa-tachometer-alt"></i> Dashboard<i style="visibility: hidden" class="fas fa-chevron-down"></i></a>
        </li>
        <li class="dropdown">
          <a href="#"><i class="fas fa-tasks"></i> Requests <i class="fas fa-chevron-down"></i></a>
          <ul class="submenu">
            <li><a href="{{ route('admin.appointments.request') }}">Appointment</a></li>
            <li><a href="{{ route('admin.bookings.request') }}">Booking</a></li>
            <li><a href="{{ route('admin.groomings.request') }}">Grooming</a></li>
            <li><a href="{{ route('admin.orders.request') }}">Orders</a></li>
            <li><a href="{{ route('admin.adoptions.request') }}">Adoptions</a></li>
            <li><a href="{{ route('admin.subscriptions.request') }}">Subscription</a></li>
            <li><a href="{{ route('admin.taxi_requests.request') }}">Taxi</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#"><i class="fas fa-user-friends"></i> Users <i class="fas fa-chevron-down"></i></a>
          <ul class="submenu">
            <li><a href="{{ route('admin.roles.index') }}">Roles</a></li>
            <li><a href="{{ route('admin.users.index') }}">Users</a></li>
            <li><a href="{{ route('admin.doctors.index') }}">Doctors</a></li>
            <li><a href="{{ route('admin.drivers.index') }}">Drivers</a></li>

          </ul>
        </li>
        <li class="dropdown">
          <a href="#"><i class="fas fa-paw"></i> Pets <i class="fas fa-chevron-down"></i></a>
          <ul class="submenu">
            <li><a href="{{ route('admin.animaltypes.index') }}">Animal Type</a></li>
            <li><a href="{{ route('admin.pets.index') }}">Pets</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#"><i class="fas fa-calendar-check"></i> Appointments <i class="fas fa-chevron-down"></i></a>
          <ul class="submenu">
            <li><a href="{{ route('admin.services.index') }}">Services</a></li>
            <li><a href="{{ route('admin.appointments.index') }}">Appointments</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#"><i class="fas fa-hotel"></i> Hotel <i class="fas fa-chevron-down"></i></a>
          <ul class="submenu">
            <li><a href="{{ route('admin.rooms.index') }}">Rooms</a></li>
            <li><a href="{{ route('admin.bookings.index') }}">Bookings</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#"><i class="fas fa-cut"></i> Grooming <i class="fas fa-chevron-down"></i></a>
          <ul class="submenu">
            <li><a href="{{ route('admin.grooming_services.index') }}">Grooming Services</a></li>
            <li><a href="{{ route('admin.grooming.index') }}">Grooming</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#"><i class="fas fa-shopping-cart"></i> Shop <i class="fas fa-chevron-down"></i></a>
          <ul class="submenu">
            <li><a href="{{ route('admin.categories.index') }}">Product Categories</a></li>
            <li><a href="{{ route('admin.products.index') }}">Products</a></li>
            <li><a href="{{ route('admin.orders.index') }}">Orders</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#"><i class="fas fa-heart"></i> Adoptions <i class="fas fa-chevron-down"></i></a>
          <ul class="submenu">
            <li><a href="{{ route('admin.petsForAdoption.index') }}">For Adoptions</a></li>
            <li><a href="{{ route('admin.adoptions.index') }}">Adoptions</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#"><i class="fas fa-hand-holding-heart"></i> Donations <i class="fas fa-chevron-down"></i></a>
          <ul class="submenu">
            <li><a href="{{ route('admin.rescue_animals.index') }}">Rescue Animals</a></li>
            <li><a href="{{ route('admin.donations.index') }}">Donation</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#"><i class="fas fa-calendar-alt"></i> Events <i class="fas fa-chevron-down"></i></a>
          <ul class="submenu">
            <li><a href="{{ route('admin.events.index') }}">Events</a></li>
            <li><a href="{{ route('admin.event-registrations.index') }}">Event Registrations</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#"><i class="fas fa-sync-alt"></i> Subscriptions <i class="fas fa-chevron-down"></i></a>
          <ul class="submenu">
            <li><a href="{{ route('admin.subscriptions.index') }}">Subscriptions</a></li>
            <li><a href="{{ route('admin.pet_subscriptions.index') }}">Pet Subscriptions</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#"><i class="fas fa-ellipsis-h"></i> Others <i class="fas fa-chevron-down"></i></a>
          <ul class="submenu">
            <li><a href="{{ route('admin.feedback.index') }}">Feedback</a></li>
            <li><a href="{{ route('admin.posts.index') }}">Posts</a></li>
            <li><a href="{{ route('admin.faqs.index') }}">fre. Questions</a></li>
            <li><a href="{{ route('admin.taxi_requests.index') }}">Taxi Requests</a></li>
          </ul>
        </li>
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


