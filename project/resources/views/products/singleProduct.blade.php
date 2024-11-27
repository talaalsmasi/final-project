@extends('layouts.index')
@section('from', 'Shop')
@section('title', $product->name . ' details')
@section('content')
			<section class="pet_detail_wrap" style="background-image: url(/images/bg-paw.png);">
				<div class="container">
					<div class="pet_detail_row">
						<div class="pet_product_detail">
							<div class="pet_product_slider">
								<ul class="bxslider bx-pager">
									<li><img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-fluid"></li>
                                    <div>
                                        <a class="pet_heart_icon" href="{{ route('wishlist.add', $product->id) }}">
                                            <i style="margin-left: 1.2vh" class="fa {{ in_array($product->id, session('wishlist', [])) ? 'fa-heart' : 'fa-heart-o' }}"></i>
                                        </a>
                                       </div>
								</ul>
							</div>
							{{-- <div class="pet_img_list" id="bx-pager">
							  <a data-slide-index="0" href=""><img src="extra-images/pet-detail.jpg" alt="image"></a>
							  <a data-slide-index="1" href=""><img src="extra-images/pet-detail01.jpg" alt="image"></a>
							  <a data-slide-index="2" href=""><img src="extra-images/pet-detail02.jpg" alt="image"></a>
							  <a data-slide-index="3" href=""><img src="extra-images/pet-detail01.jpg" alt="image"></a>
							  <a data-slide-index="4" href=""><img src="extra-images/pet-detail02.jpg" alt="image"></a>
							</div> --}}
						</div>

						<div class="pet_detail_text"><br><br><br>
							<h2>{{ $product->name }}</h2>
							{{-- <div class="pet_product_review">
								<div class="pet_product_rating">
									<a href="#"><i class="fa fa-star"></i></a>
									<a href="#"><i class="fa fa-star"></i></a>
									<a href="#"><i class="fa fa-star"></i></a>
									<a href="#"><i class="fa fa-star"></i></a>
									<a href="#"><i class="fa fa-star"></i></a>
								</div>
								<span>(05 Customers Review)</span>
							</div> --}}
							<div class="pet_product_price">
								<h4>{{ $product->price }}JD</h4>

							</div>
							<p>{{ $product->description }}</p>

							<div class="pet_tags_icon">
								<ul class="pet_tags" style="color: black">
									<li><span>Stock:</span>{{ $product->stock_quantity }}</li>
									<li><span>Categoires:</span> {{ $product->category->name }} </li>
                                    <a class="pet_heart_icon" href="{{ route('wishlist.add', $product->id) }}">
                                        <i class="fa {{ in_array($product->id, session('wishlist', [])) ? 'fa-heart' : 'fa-heart-o' }}"></i>
                                    </a>

								</ul>
								{{-- <ul class="pet_social_icon">
									<li><a class="active" href="#"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
									<li><a href="#"><i class="fa fa-skype"></i></a></li>
									<li><a href="#"><i class="fa fa-youtube"></i></a></li>
									<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								</ul> --}}

                                <div class="pet_spinner_list">
                                    @if ($product->stock_quantity > 0)
                                    <a class="theme_btn" href="{{ route('cart.add', $product->id) }}">add to cart</a>

                                @else
                                    <span style="color: red;">Out of Stock</span>
                                @endif

                                </div>
							</div>
						</div>
					</div>
				</div>
			</section>

@endsection
