@extends('layouts.index')

@section('from', 'Home')
@section('title', 'Subscriptions')

@section('content')
<section style="background-image: url(/images/bg-paw.png);">
    <section class="pet_exercise_wrap" style="width: 50%;margin:auto" >
        <div class="mian_heading text-center"><h2>Our Subscriptions</h2></div>

        <div class="container">
          <!--pet exercise row service03 start-->
          @foreach ($subscriptions as $subscription)
          <div class="pet_service_detail">
            <div class="pet_service_detail_row service03">
              <div class="pet_exercise_fig">
                  <figure>
                    <img style="height:450px;width:1280px" src="{{ asset($subscription->image) }}" alt="">
                  </figure>
              </div>
              <div class="pet_exercise_text">
                <h4>{{ $subscription->name }}</h4>
                <ul class="pet_service_list">
                    <li><a href="#"><i class="fa fa-check-circle-o"></i>{{ $subscription->description }}</a></li>
                    <li><a href="#"><i class="fa fa-check-circle-o"></i>3 sessions per week (Sunday, Tuesday, Thursday)</a></li>
                    <li><a href="#"><i class="fa fa-check-circle-o"></i>Price: {{ $subscription->price }} JD/per week</a></li><br>
                    <a href="{{ route('subscriptions.create', $subscription->id) }}" class="main_button btn2 bdr-clr hover-affect">Subscribe Now</a>            </ul>
              </div>
            </div>
          </div><br>
          @endforeach
        </div>
      </section>
</section>
@endsection




