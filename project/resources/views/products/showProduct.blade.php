@extends('layouts.index')
@section('title', 'product')
@section('from', 'Home')
@section('content')
              <!--shop wraper start-->
             <!-- نموذج الفلترة --> <br><br>
             <section class="pet_shop_wraper "  style="background-image: url(/images/bg-paw.png);">
                <div class="mian_heading text-center"><h2>Shop</h2></div>


<div class="filter-wrapper" style="width:90%;margin-left:17%">

    <form style="display:flex;flex-direction:row;gap:3vh" method="GET" action="{{ route('products.showProducts') }}">
        <div style="width: 20%">
            <label class="appointment-main-title" for="category">Category:</label>
            <select style="border-radius: 3vh; height: 6vh;border:solid black 2px"
            class="appointment-main-title" name="category" id="category">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div style="width: 20%;">
            <label class="appointment-main-title" for="min_price">Min Price:</label>
            <input style="border-radius: 3vh;border:solid black 2px" class="appointment-main-title" type="number" name="min_price" placeholder="Min Price" value="{{ request('min_price') }}">
        </div>

        <div style="width:20%">
            <label class="appointment-main-title" for="max_price">Max Price:</label>
            <input style="border-radius: 3vh;border:solid black 2px" class="appointment-main-title" type="number" name="max_price" placeholder="Max Price" value="{{ request('max_price') }}">
        </div>
        <button style="height:6.5vh ;margin-top:8vh" class="main_button btn2 bdr-clr hover-affect"
        type="submit">Filter</button>
    </form>
</div><br><br><br>


    <div class="container">
        <div class="pet_shop_row">
            @foreach($products as $product)
                <div class="pet_shop_column" style="background-color: rgb(232, 230, 230)">
                    <figure>
                        <img style="height: 257px; width: 250px;" src="{{ asset($product->image) }}" alt="Product image">
                       <div>
                        <a class="pet_heart_icon" href="{{ route('wishlist.add', $product->id) }}">
                            <i class="fa {{ in_array($product->id, session('wishlist', [])) ? 'fa-heart' : 'fa-heart-o' }}"></i>
                        </a>
                       </div>
                    </figure>
                    <div class="pet_shop_text">
                        <h4><a href="{{ route('product.single', $product->id) }}">{{ $product->name }}</a></h4>
                        <span style="color: black">{{ $product->description }}</span>
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

    <!-- Pagination -->
    <div class="pet-pagination">
        <ul>
            <!-- Previous Page Link -->
            @if ($products->onFirstPage())
                <li><a class="previous-btn" href="#" style="pointer-events: none; opacity: 0.5;">Previous</a></li>
            @else
                <li><a class="previous-btn" href="{{ $products->previousPageUrl() }}">Previous</a></li>
            @endif

            <!-- Page Numbers -->
            @for ($i = 1; $i <= $products->lastPage(); $i++)
                <li>
                    <a href="{{ $products->url($i) }}" class="{{ $i == $products->currentPage() ? 'active' : '' }}">
                        {{ $i }}
                    </a>
                </li>
            @endfor
            <!-- Next Page Link -->
            @if ($products->hasMorePages())
                <li><a class="previous-btn next-btn" href="{{ $products->nextPageUrl() }}">Next</a></li>
            @else
                <li><a class="previous-btn next-btn" href="#" style="pointer-events: none; opacity: 0.5;">Next</a></li>
            @endif
        </ul>
    </div>
</section>
@endsection
