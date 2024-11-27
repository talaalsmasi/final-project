<style>
     .badge {
                        position: absolute;
                        top: -8px;
                        right: -8px;
                        background-color: red;
                        color: white;
                        border-radius: 50%;
                        padding: 4px 6px;
                        font-size: 12px;
                    }
</style>
        <!-- main header  start -->
         <div class="main_header">
          <div class="custom-container-fluid">
            <!-- main top bar start -->
            <div class="main_top_bar">
                  <h1><figure><a href="{{route('home')}}"><img style="height: 74px;width:222px" src="{{ asset('images/top-logo1.png') }}"></a></figure></h1>
                  <ul class="navigation">

                      <li><a href="#">Services<i class="fa fa-caret-down"></i></a>
                        <ul class="sub-menu">
                            <li><a href="{{route('appointment.create')}}">Doctor visit</a></li>
                            <li><a href="{{route('rooms.index')}}">Pets night</a></li>
                            <li><a href="{{route('grooming.create')}}">Grooming</a></li>
                            <li><a href="{{route('adoption.pets')}}">Adoption</a></li>
                            <li><a href="{{route('rescueAnimals.index')}}">Donations</a></li>
                         </ul>
                      </li>
                      <li><a href=""> Shop<i class="fa fa-caret-down"></i></a>
                        <ul class="sub-menu">
                            <li><a href="{{route('products.showProducts')}}">shop</a></li>
                            <li><a href="{{route('cart.show')}}">Your Cart</a></li>
                            <li><a href="{{route('wishlist.show')}}">Your wishlist</a></li>
                         </ul>
                        </li>
                        <li><a href="{{route('taxi.request')}}">Taxi </a></li>
                        <li><a href="{{route('posts.index')}}">Posts </a></li>
                        <li><a href="{{route('contactUs.index')}}">Events </a></li>
                      <li><a href="contact-us.html"> Contact Us</a></li>
                      <li>
                        <a href="{{ route('cart.show') }}">
                            <i class="fa-solid fa-shopping-cart" style="color: #ffffff; position: relative;">
                                @if($cartCount > 0)
                                    <span style="position: absolute; top: -5px; right: -10px; background-color: red; color: white; border-radius: 50%; padding: 2px 6px; font-size: 12px;">
                                        {{ $cartCount }}
                                    </span>
                                @endif
                            </i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('wishlist.show') }}">
                            <i class="fa-solid fa-heart" style="color: #ffffff; position: relative;">
                                @if($wishlistCount > 0)
                                    <span style="position: absolute; top: -5px; right: -10px; background-color: red; color: white; border-radius: 50%; padding: 2px 6px; font-size: 12px;">
                                        {{ $wishlistCount }}
                                    </span>
                                @endif
                            </i>
                        </a>
                    </li>






                  </ul>
                  <!--DL Menu Start-->
                  <div id="kode-responsive-navigation" class="dl-menuwrapper">
                    <button class="dl-trigger">Open Menu</button>
                    <ul class="dl-menu">
                      <li><a class="active" href="{{route('home')}}">Home</a>
                      </li>
                      <li class="menu-item kode-parent-menu"><a href="#">Services</a>
                        <ul class="dl-submenu">
                            <li><a href="{{route('appointment.create')}}">Doctor visit</a></li>
                            <li><a href="{{route('rooms.index')}}">Pets night</a></li>
                            <li><a href="{{route('grooming.create')}}">Grooming</a></li>
                            <li><a href="{{route('adoption.pets')}}">Adoption</a></li>
                            <li><a href="{{route('rescueAnimals.index')}}">Donations</a></li>
                        </ul>
                      </li>
                      <li class="menu-item kode-parent-menu"><a href="#">shop</a>
                        <ul class="dl-submenu">
                            <li><a href="{{route('products.showProducts')}}">shop</a></li>
                            <li><a href="{{route('cart.show')}}">Your Cart</a></li>
                            <li><a href="{{route('wishlist.show')}}">Your wishlist</a></li>
                        </ul>
                      </li>
                      <li class="menu-item kode-parent-menu"><a href="{{route('taxi.request')}}">Taxi</a></li>
                      <li class="menu-item kode-parent-menu"><a href="{{route('posts.index')}}">Posts</a>
                      </li>
                      <li><a href="{{route('events.show')}}">Events</a></li>
                      <li><a href="{{route('contactUs.index')}}">contact Us</a></li>

                      @auth
                      <!-- إذا كان المستخدم مسجل الدخول -->
                      <li class="menu-item kode-parent-menu">
                          <a href="{{ route('profile') }}">Profile</a>
                      </li>
                      <li class="menu-item kode-parent-menu">
                          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                      </li>

                      <!-- نموذج تسجيل الخروج -->
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  @else
                      <!-- إذا لم يكن المستخدم مسجل الدخول -->
                      <li class="menu-item kode-parent-menu">
                          <a href="{{ route('signup') }}">Sign up</a>
                      </li>
                      <li class="menu-item kode-parent-menu">
                          <a href="{{ route('login') }}">Log in</a>
                      </li>
                  @endauth
                    </ul>
                  </div>
                  <!--DL Menu END-->
                  {{-- <a class="main_button hover-affect" href="appointment.html">Book Appointment</a> --}}
                  <div>
                    @auth
                        <!-- المستخدم مسجل الدخول -->
                        <a class="main_button hover-affect" href="{{ route('profile') }}">Profile</a>
                        <a class="main_button hover-affect" href="{{ route('logout') }}" style="margin-left: 2vh"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           Logout
                        </a>

                        <!-- نموذج تسجيل الخروج -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <!-- المستخدم غير مسجل الدخول -->
                        <a class="main_button hover-affect" href="{{ route('signup') }}">Sign up</a>
                        <a class="main_button hover-affect" href="{{ route('login') }}" style="margin-left: 2vh">Log in</a>
                    @endauth
                </div>


                    </ul>
                  </div>

              </div>
              <!-- main top bar end-->
          </div>
        </div>
          <!-- main header end-->

        <!-- main header  start -->
         <div class="main_header fixed">
          <div class="custom-container-fluid">
            <!-- main top bar start -->
            <div class="main_top_bar">
                  <h1><figure><a href="{{route('home')}}"><img style="height: 74px;width:222px" src="images/top-logo02.jpg"></a></figure></h1>
                   <ul class="navigation">
                      <li><a href="{{route('home')}}">Home</a></li>
                      <li><a href="#">Services<i class="fa fa-caret-down"></i></a>
                        <ul class="sub-menu">
                            <li><a href="{{route('appointment.create')}}">Doctor visit</a></li>
                            <li><a href="{{route('rooms.index')}}">Pets night</a></li>
                            <li><a href="{{route('grooming.create')}}">Grooming</a></li>
                            <li><a href="{{route('adoption.pets')}}">Adoption</a></li>
                            <li><a href="{{route('rescueAnimals.index')}}">Donations</a></li>
                        </ul>
                      </li>
                      <li><a href="#">Shop<i class="fa fa-caret-down"></i></a>
                        <ul class="sub-menu">
                            <li><a href="{{route('products.showProducts')}}">shop</a></li>
                            <li><a href="{{route('cart.show')}}">Your Cart</a></li>
                            <li><a href="{{route('wishlist.show')}}">Your wishlist</a></li>
                        </ul>
                      </li>
                      <li><a href="{{route('taxi.request')}}">Taxi</a></li>
                      <li><a href="{{route('posts.index')}}">Posts</a></li>
                      <li><a href="{{route('events.show')}}"> Events</a></li>
                      <li><a href="{{route('contactUs.index')}}"> Contact Us</a></li>
                      <li>
                        <a href="{{ route('cart.show') }}">
                            <i class="fa-solid fa-shopping-cart" style="color: #000000; position: relative;">
                                @if($cartCount > 0)
                                    <span style="position: absolute; top: -5px; right: -10px; background-color: red; color: white; border-radius: 50%; padding: 2px 6px; font-size: 12px;">
                                        {{ $cartCount }}
                                    </span>
                                @endif
                            </i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('wishlist.show') }}">
                            <i class="fa-solid fa-heart" style="color: #040404; position: relative;">
                                @if($wishlistCount > 0)
                                    <span style="position: absolute; top: -5px; right: -10px; background-color: red; color: rgb(255, 255, 255); border-radius: 50%; padding: 2px 6px; font-size: 12px;">
                                        {{ $wishlistCount }}
                                    </span>
                                @endif
                            </i>
                        </a>
                    </li>


                  </ul>
                  <!--DL Menu Start-->
                  <div id="responsive-navigation" class="dl-menuwrapper">
                    <button class="dl-trigger">Open Menu</button>
                    <ul class="dl-menu">
                      <li><a class="active" href="{{route('home')}}">Home</a></li>
                      <li class="menu-item kode-parent-menu"><a href="#">Services</a>
                          <ul class="dl-submenu">
                            <li><a href="{{route('appointment.create')}}">Doctor visit</a></li>
                            <li><a href="{{route('rooms.index')}}">Pets night</a></li>
                            <li><a href="{{route('grooming.create')}}">Grooming</a></li>
                            <li><a href="{{route('adoption.pets')}}">Adoption</a></li>
                            <li><a href="{{route('rescueAnimals.index')}}">Donations</a></li>
                          </ul>
                      </li>
                      <li class="menu-item kode-parent-menu"><a href="#">shop</a>
                        <ul class="dl-submenu">
                            <li><a href="{{route('products.showProducts')}}">shop</a></li>
                            <li><a href="{{route('cart.show')}}">Your Cart</a></li>
                            <li><a href="{{route('wishlist.show')}}">Your wishlist</a></li>
                        </ul>
                      </li>
                      <li class="menu-item kode-parent-menu"><a href="{{route('taxi.request')}}">Taxi</a>

                      </li>
                      <li class="menu-item kode-parent-menu"><a href="#">Posts</a>

                      </li>
                      <li class="menu-item kode-parent-menu"><a href="{{route('events.show')}}">Events</a>

                      </li>
                      <li><a href="{{route('contactUs.index')}}"> Contact Us</a></li>
                      @auth
                      <!-- إذا كان المستخدم مسجل الدخول -->
                      <li class="menu-item kode-parent-menu">
                          <a href="{{ route('profile') }}">Profile</a>
                      </li>
                      <li class="menu-item kode-parent-menu">
                          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                      </li>

                      <!-- نموذج تسجيل الخروج -->
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  @else
                      <!-- إذا لم يكن المستخدم مسجل الدخول -->
                      <li class="menu-item kode-parent-menu">
                          <a href="{{ route('signup') }}">Sign up</a>
                      </li>
                      <li class="menu-item kode-parent-menu">
                          <a href="{{ route('login') }}">Log in</a>
                      </li>
                  @endauth
                    </ul>
                  </div>
                  <!--DL Menu END-->
                  <div>
                    @auth
                        <!-- المستخدم مسجل الدخول -->
                        <a class="main_button hover-affect" href="{{ route('profile') }}">Profile</a>
                        <a class="main_button hover-affect" href="{{ route('logout') }}" style="margin-left: 2vh"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           Logout
                        </a>

                        <!-- نموذج تسجيل الخروج -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <!-- المستخدم غير مسجل الدخول -->
                        <a class="main_button hover-affect" href="{{ route('signup') }}">Sign up</a>
                        <a class="main_button hover-affect" href="{{ route('login') }}" style="margin-left: 2vh">Log in</a>
                    @endauth
                </div>


                    </ul>
                  </div>              </div>
              <!-- main top bar end-->
          </div>
        </div>
          <!-- main header end-->

            <!--sab banner wraper start-->
              <div class="sab-banner-wraper">
                <div class="container">
                  <div class="sab-banner-text">
                     <h2>@yield('title')</h2>
                      <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">@yield('from')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                      </ul>
                  </div>
                </div>
               <div class="custom-shape-divider-bottom-1687358784">
                  <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                      <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
                      <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
                      <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
                  </svg>
              </div>
            </div>
            @php
            $cartCount = session()->has('cart') ? count(session('cart')) : 0;
            $wishlistCount = session()->has('wishlist') ? count(session('wishlist')) : 0;
        @endphp


