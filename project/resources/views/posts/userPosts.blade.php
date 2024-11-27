@extends('layouts.index')
@section('title',  $user->name  .' Profile')
@section('content')
@section('from', 'Home')

            <section class="child_service_wrap blog-full"style="	background-image:  url(/images/bg-paw.png);">
                     <section class="pet_exercise_wrap" style="margin: auto">
                <div class="container">
                  <!--pet exercise row service03 start-->
                  <div class="pet_service_detail">
                    <div class="pet_service_detail_row service03" >

                        <div class="blog_product" style="display: flex;flex-direction:row">
                            <div>
                                <img style="height:20vhpx;width:20vh;border-radius:50%" src="{{asset($user->image)}}" alt="">
                            </div>
                            <div style="margin-left: 10%"><br>
                                <h5>{{ $user->name }}</h5>
                                 <p>{{$user->doctor->about}}</p>
                                 <p>email: {{$user->email}}</p>
                            </div>
                        </div>
                    </div>
                    <!--pet sidebar widget end-->
                  </div>
                  <!--pet exercise row service03 end -->
                </div>
              </section>
                <div class="container">
                    <div class="child_service_row">
                        @foreach($user->posts as $post) <!-- Start the foreach loop here -->
                            <div class="child_service_column">
                                <figure class="image-layer-affect">
                                    <img style="height: 374px ; width:567px" src="{{ asset($post->image) }}" alt="{{ $post->content }}">
                                    {{-- <img src="extra-images/blog-grid-post03.jpg" alt=""> --}}
                                        </figure>
                                <div class="child_service_text">

                                    <h5> <br>{{ $post->title }}</h5>
                                    <p>{{ $post->content }}</p> <!-- Updated to display post content -->
                                    <div class="child_service_botton_fig" style="margin-left: 3%">
                                        <figure><img style="height: 50px;width:50px;border-radius:50%" src="{{asset($post->user->image)}}" alt=""></figure>
                                        <a href="{{ route('users.posts', $post->user->id) }}">{{ $post->user ? $post->user->name : 'Anonymous' }}</a> <!-- Display the author's name -->
                                    </div><br>


                                    {{-- <p>{{ $post->content }}</p> --}}
                                    <div class="child_service_botton_fig" style="margin-left: 3%">
                                        <figure><img src="images/shap-fig02.png" alt=""></figure>
                                         <!-- Display the author's name -->
                                    </div><br>
                                    <li style="margin-left: 3%">
                                        <a href="#">
                                            <i class="fa fa-calendar"></i>
                                            {{ $post->created_at ? $post->created_at->format('F j, Y') : 'Date not available' }}
                                        </a><br>
                                    </li>
                                </div>
                            </div>
                        @endforeach <!-- End the foreach loop here -->
                        <!--pet pagination start-->
                        {{-- <div class="pet-pagination">
                            <ul>
                                <li><a class="previous-btn" href="#">Previous</a></li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a class="previous-btn next-btn" href="#">Next</a></li>
                            </ul>
                        </div> --}}
                        <!--pet pagination end-->
                    </div>
                </div>
            </section>

@endsection
