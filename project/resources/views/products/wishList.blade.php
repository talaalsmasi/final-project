@extends('layouts.index')
@section('from', 'Home')
@section('title', 'your wishlist')
@section('content')
            <div class="container"style="background-image: url(/images/bg-paw.png);">
                <h4 class="appointment-main-title">Your Wishlist</h4>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('info'))
                    <div class="alert alert-info">{{ session('info') }}</div>
                @endif

                @if($products->isEmpty())
                    <p>Your wishlist is empty.</p>
                @else
                <div class="pet_shop_row">
                    @foreach($products as $product)
                        <div class="pet_shop_column" style="background-color: rgb(232, 230, 230)">
                            <figure>
                                <img style="height: 257px; width: 250px;" src="{{ asset($product->image) }}" alt="Product image">
                               <div>
                                <a class="pet_heart_icon" href="{{ route('wishlist.remove', $product->id) }}" style="color: #e74c3c; text-decoration: none; cursor: pointer;">

                                        <i class="fa-solid fa-trash" style="color:white"></i>


                                </a>
                                {{-- <a class="pet_heart_icon" href="{{ route('wishlist.add', $product->id) }}">
                                    <i class="fa {{ in_array($product->id, session('wishlist', [])) ? 'fa-heart' : 'fa-heart-o' }}"></i>
                                </a> --}}
                               </div>
                            </figure>
                            <div class="pet_shop_text">
                                <h4><a href="{{ route('product.single', $product->id) }}">{{ $product->name }}</a></h4>
                                <span>{{ $product->description }}</span>
                                <div class="product_price">
                                    <h6><a href="#">{{ $product->price }}JD</a></h6>
                                    @if ($product->stock_quantity > 0)
                                        <a href="{{ route('cart.add', $product->id) }}"><i class="fa fa-cart-arrow-down"></i></a>
                                    @else
                                        <span style="color: red;">Out of Stock</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
                {{-- <table class="table" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="text-align: center; padding: 10px; border-bottom: 1px solid #ddd;">Image</th>
                            <th style="text-align: center; padding: 10px; border-bottom: 1px solid #ddd;">Product Name</th>
                            <th style="text-align: center; padding: 10px; border-bottom: 1px solid #ddd;">Unit Price</th>
                            <th style="text-align: center; padding: 10px; border-bottom: 1px solid #ddd;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td style="text-align: center; padding: 10px;">
                                <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" width="50px" height="auto" style="border-radius: 8px;">
                            </td>
                            <td style="text-align: center; padding: 10px;">
                                {{ $product->name }}
                            </td>
                            <td style="text-align: center; padding: 10px;">
                                {{ number_format($product->price, 2) }} JD
                            </td>
                            <td style="text-align: center; padding: 10px;">
                                <a href="{{ route('wishlist.remove', $product->id) }}" style="color: #e74c3c; text-decoration: none; cursor: pointer;">
                                    <button class="remove-btn" style="background-color: #fff; border: none; cursor: pointer; font-size: 18px;">
                                        <i class="fa-solid fa-trash" style="color: #ff8931;"></i>
                                        <a href="{{ route('cart.add', $product->id) }}"><i class="fas fa-shopping-cart" style="color: #ff8931;"></i></a>
                                    </button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table> --}}
            @endif
            </div>

@endsection
