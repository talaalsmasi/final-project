@extends('layouts.index')
@section('title', 'Rating')
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

        </style>

            <section class="pet_appointment_wrap">
                <div class="container">


                    @if ($errors->any())
                        <div style="color: red;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('ratings.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="pet_appointment_row" style="width: 50%;margin:auto">
                            <div class="appiontment_list">
                                <div class="pet_appointment_colum">
                                    <h6 for="rating">Rating:</h6>
                                    <div class="stars">
                                        <input type="radio" id="star5" name="rating" value="5" required/>
                                        <label for="star5" class="star">&#9733;</label>
                                        <input type="radio" id="star4" name="rating" value="4"/>
                                        <label for="star4" class="star">&#9733;</label>
                                        <input type="radio" id="star3" name="rating" value="3"/>
                                        <label for="star3" class="star">&#9733;</label>
                                        <input type="radio" id="star2" name="rating" value="2"/>
                                        <label for="star2" class="star">&#9733;</label>
                                        <input type="radio" id="star1" name="rating" value="1"/>
                                        <label for="star1" class="star">&#9733;</label>
                                    </div>
                                </div>
                                <div class="pet_appointment_colum full-width">
                                    <h6 for="feedback">Feedback:</h6>
                                    <textarea name="feedback" class="form-control" rows="4"></textarea>
                                </div><br>

                                <div><br>
                                    <button type="submit" class="main_button btn2 bdr-clr hover-affect">Submit Rating</button>
                                    <a href="{{ route('profile') }}" class="main_button btn2 bdr-clr hover-affect">Back to Profile</a>


                                </div>


                            </div>
                        </div>
                    </form>
                </div>
            </section>

           @endsection
