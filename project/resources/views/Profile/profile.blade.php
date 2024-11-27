@extends('layouts.index')
@section('from', 'Home')
@section('title', 'Profile')
@section('content')

<style>
    body {
        background-image: url('http://localhost:8000/images/bg-paw.png'); /* ضع هنا رابط الصورة المباشر */
        background-color: rgb(249, 246, 246);
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
</style>



          <!-- main header end-->



            <!--pet 404 warp start -->
           <div style="margin-left: 5%" >
            <a href="{{ route('profile.showInfo') }}" class="btn btn-primary">Show Information</a>
            <a href="{{ route('profile.editInfo') }}" class="btn btn-primary">Edit Information</a>
            <a href="{{ route('adoption.request') }}" class="btn btn-primary">Adoption request</a>
            <a href="{{ route('user.donations') }}" class="btn btn-primary">My Donations</a>
            <a href="{{ route('user.orders')}}" class="btn btn-primary">Shop Order</a>
            <a href="{{ route('user.events') }}" class="btn btn-primary">My Registered Events </a>
            <a href="{{ route('taxi.requests') }}" class="btn btn-primary">Taxi order </a>
            <br><br><br>
           </div>


            <div class="container">

                <div class="mian_heading text-center"><h2>Welcome, {{ $user->name }} <br>Your Pets</h2></div>

                @if (session('success'))
                    <div style="color: green;">
                        {{ session('success') }}
                    </div>
                @endif

                <ul style="list-style: none; padding: 0;">
                    @foreach($pets as $pet)
                        <li style="margin-bottom: 20px; padding: 15px; border: 1px solid #ddd; border-radius: 8px; display: flex; align-items: center;">
                            <div style="margin-right: 20px;">
                                <!-- عرض صورة الحيوان -->
                                @if($pet->image)
                                    <img src="{{ asset($pet->image) }}" alt="{{ $pet->name }}" style="width: 70px; height: 70px; object-fit: cover; border-radius: 50%;">
                                @else
                                    <img src="https://via.placeholder.com/70" alt="No Image" style="width: 70px; height: 70px; object-fit: cover; border-radius: 50%;">
                                @endif
                            </div>
                            <div style="flex-grow: 1;">
                                <!-- معلومات الحيوان -->
                                <h5 style="margin: 0; font-size: 18px; color: #333;text-transform: capitalize">{{ $pet->name }}</h5>
                                <p style="margin: 5px 0; color: #777;">Breed: {{ $pet->breed ?? 'Unknown Breed' }}</p>
                                <p style="margin: 5px 0; color: #777;">Birthday: {{ $pet->birthday ?? 'No Birthday Info' }}</p>
                                <p style="margin: 5px 0; color: #777;">Animal type: {{  $pet->animalType->type_name?? 'No Type Info' }}</p>
                            </div>

                            {{-- <div>
                                <!-- زر تعديل الحيوان -->
                                <a href="{{ route('profile.edit-pet-form', $pet->id) }}" class="main_button btn2 bdr-clr hover-affect" style="padding: 10px 20px; font-size: 14px;">Edit</a>

                                <!-- زر الموعد إذا كان للحيوان موعد -->
                                @if($pet->appointments->count() > 0)
                                    <a href="{{ route('appointments.show', $pet->appointments->first()->id) }}" class="main_button btn2 bdr-clr hover-affect" style="padding: 10px 20px; font-size: 14px; margin-left: 10px;">Appointment</a>
                                @endif
                            </div> --}}
                            <div>
                                <!-- زر تعديل الحيوان -->
                                <a href="{{ route('profile.edit-pet-form', $pet->id) }}" class="main_button btn2 bdr-clr hover-affect" style="padding: 10px 20px; font-size: 14px;">Edit</a>


                                <!-- زر الموعد إذا كان للحيوان موعد -->
                                @if($pet->appointments->count() > 0)
                                    <a href="{{ route('appointment.show', $pet->id) }}" class="main_button btn2 bdr-clr hover-affect" style="padding: 10px 20px; font-size: 14px; margin-left: 10px;">Appointment</a>
                                @endif

                                @if($pet->broomings->count() > 0)
                                <a href="{{ route('brooming.show', $pet->id) }}" class="main_button btn2 bdr-clr hover-affect" style="padding: 10px 20px; font-size: 14px; margin-left: 10px;">Grooming </a>
                                @endif

                                @if($pet->subscriptions->count() > 0)
                                <a href="{{ route('subscriptions.show', $pet->id) }}" class="main_button btn2 bdr-clr hover-affect" style="padding: 10px 20px; font-size: 14px; margin-left: 10px;">Subscription</a>
                                @endif



                                <!-- زر الحجز إذا كان للحيوان حجز -->
                                @if($pet->bookings->count() > 0)
                                <a href="{{ route('bookings.show', $pet->id) }}" class="main_button btn2 bdr-clr hover-affect" style="padding: 10px 20px; font-size: 14px; margin-left: 10px;">Booking</a>
                                @endif
                                <form action="{{ route('profile.destroy-pet', $pet->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="main_button btn2 bdr-clr hover-affect" onclick="return confirm('Are you sure you want to delete this pet?')"style="padding: 10px 20px; font-size: 14px; margin-left: 10px;">Delete</button>
                                </form>


                            </div>

                        </li>
                    @endforeach
                </ul>

                <a href="{{ route('profile.add-pet-form') }}" class="main_button btn2 bdr-clr hover-affect">Add New Pet</a>
            </div><br><br>


           @endsection
