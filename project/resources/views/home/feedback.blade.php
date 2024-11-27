@extends('layouts.index')
@section('title', 'FeedBack')
@section('content')
        <style>
            .stars {
    direction: rtl; /* لتسهيل النقر على النجوم */
    display: inline-block;
}

.stars {
    display: flex;
    direction: row;
    margin-right: 8vh;
    margin-top: -5vh
}

.stars input {
    display: none; /* إخفاء الراديو */
}

.stars label {
    font-size: 24px; /* حجم النجوم */
    color: gray; /* لون النجوم الافتراضي */
    cursor: pointer;
}

.stars input:checked ~ label {
    color: gold; /* لون النجوم عند الاختيار */
}

.stars label:hover,
.stars label:hover ~ label {
    color: gold; /* لون النجوم عند التمرير */
}
.stars {
    color: #FFD700; /* Gold color for filled stars */
}

.star {
    font-size: 20px; /* Adjust size as needed */
    margin-right: 2px; /* Space between stars */
}


        </style>


           <section style="	background-image:  url(/images/bg-paw.png);">
            <section class="pet_exercise_wrap" style="margin-left: 24%;">
                <div class="container" >
                  <!--pet exercise row service03 start-->
                  <div class="pet_service_detail">
                    <div class="pet_service_detail_row service03">



                      <div class="pet_comments">
                         <div class="mian_heading text-center"><h2>Our Client Feedback</h2></div>

                        <ul id="pet_comment" class="comment">
                            @foreach($ratings as $rating)
                            <li>
                                <div class="pet_comment_item padding-top">
                                    <figure class="imghvr-strip-shutter-up">
                                        {{-- Uncomment this line if you have a user image --}}
                                        <img style="height: 77px;width:76px;border-radius:50%" src="{{ $rating->user->image }}" alt="{{ $rating->user->name }}">
                                    </figure>
                                    <div class="pet_comment_text">
                                        <h5>{{ $rating->user->name }}</h5>
                                        {{-- Optional: Uncomment to show the date --}}
                                        <p>{{ $rating->feedback }}</p>
                                        <div>
                                            <i style="color: black;font-size:10px" class="fa fa-calendar"></i>
                                        <span style="color: black;font-size:13px">{{ $rating->created_at ? $rating->created_at->format('F j, Y') : 'Date not available'}}</span>
                                        </div>

                                  {{-- <span>{{ $rating->created_at->format('F Y') }}</span> --}}


                                        <!-- Displaying the stars -->
                                        <div class="stars">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $rating->rating)
                                                    <span class="star">&#9733;</span> <!-- Filled star -->
                                                @else
                                                    <span class="star">&#9734;</span> <!-- Empty star -->
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                      </div>
                      <div class="contact_form_column blog-detail">
                        {{-- <h4 class="sidebar_title">leave on your feedback</h4>
                        <div class="contact_filed">
                          <input type="type" name="text" placeholder="Name">
                          <input type="type" name="text" placeholder="Email">
                        </div>
                        <textarea>your Message</textarea> --}}
                        <a href="{{route('ratings.show')}}" class="main_button btn2 bdr-clr hover-affect">Add a feedback</a>
                        <a href="{{ route('home') }}" class="main_button btn2 bdr-clr hover-affect">Back to Home</a>

                      </div>
                    </div>
                    <div class="pet_sidebar_widget">
                </div>
              </section>
           </section>
@endsection
