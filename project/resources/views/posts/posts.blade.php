@extends('layouts.index')
@section('title', 'posts')
@section('from', 'Home')
@section('content')
            <section class="child_service_wrap blog-full" style="	background-image:  url(/images/bg-paw.png);">
                <div class="mian_heading text-center"><h2>Our posts</h2></div>

                <div class="container">
                    <div class="child_service_row">
                        @foreach($posts as $post) <!-- Start the foreach loop here -->
                            <div class="child_service_column">
                                <figure class="image-layer-affect">
                                    <img style="height: 374px ; width:567px" src="{{ $post->image }}" alt="{{ $post->content }}">
                                    {{-- <img src="extra-images/blog-grid-post03.jpg" alt=""> --}}
                                        </figure>
                                <div class="child_service_text">

                                    <h5><br>{{ $post->title }} <br></h5>
                                    <p>{{ $post->content }} <br></p> <!-- Updated to display post content -->


                                    {{-- <p>{{ $post->content }}</p> --}}
                                    <div class="child_service_botton_fig" style="margin-left: 3%">
                                        <figure><img style="height: 50px;width:50px;border-radius:50%" src="{{$post->user->image}}" alt=""></figure>
                                        <a href="{{ route('users.posts', $post->user->id) }}">{{ $post->user ? $post->user->name : 'Anonymous' }}</a> <!-- Display the author's name -->
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
