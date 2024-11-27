@extends('layouts.index')
@section('from', 'Subscriptions')
@section('title', 'Create Subscription')
@section('content')

<section class="pet_service_wrapper"style="background-image: url(/images/bg-paw.png);">
    <div class="mian_heading text-center"><h2>Paw Distance</h2></div>
    <div class="custom-container">
        <div class="pet_service02_row service_grid">
            @foreach($areas as $area)
            <div class="pet_service02_column">
                <figure>
                    <img src="extra-images/service-fig.jpg" alt="">
                </figure>
                <h5>{{ $area->name }}</h5>
                <p>{{ $area->description }}</p>
                <p>Price (One Way): {{ $area->price_one_way }} JD</p>
                <p>Price (Two Way): {{ $area->price_two_way }} JD</p>
                @if($area->drivers()->where('available', true)->count() > 0)
                <a href="{{ route('taxi.order', ['area_id' => $area->id]) }}" >Order Now</a>
            @else
                <button class="main_button btn2 bdr-clr hover-affect"disabled>No Drivers Available</button>
            @endif
            </div>
            @endforeach
            <p>**if you dont know what you should choose follow <a style="font-weight: bold; color: chocolate; text-decoration: underline;" href="">This</a>
            </p>
        </div>
    </div>
</section>
@endsection







