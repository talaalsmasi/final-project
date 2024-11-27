@extends('Admin.layouts.index')

@section('title', 'Show Product')

@section('content')
    <div class="container">
        <h1 class="mb-4">Product Details</h1>

        <div class="card mb-4">
            <div class="card-header">
                <h3>{{ $product->name }}</h3>
            </div>
            <div class="card-body">
                <p><strong>Category:</strong> {{ $product->category->name }}</p>
                <p><strong>Description:</strong> {{ $product->description }}</p>
                <p><strong>Price:</strong> ${{ $product->price }}</p>
                <p><strong>Stock Quantity:</strong> {{ $product->stock_quantity }}</p>
                
                @if($product->image)
                    <p><strong>Image:</strong></p>
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 300px;">
                @endif
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-orange">Edit</a>
                <a href="{{ route('admin.products.index') }}" class="btn btn-orange">Back</a>
            </div>
        </div>
    </div>
    <div style="position: fixed; bottom: -50px; right: 32vh;">
        <img src="{{ asset('Admin/dog3.jpg.png') }}" alt="Dog Image" style="width: 350px; height: auto;">
    </div>
    <div style="position: fixed; bottom: -50px; right: 110vh;">
        <img src="{{ asset('Admin/dog5.jpg.png') }}" alt="Dog Image" style="width: 250px; height: auto;">
    </div>
    <div style="position: fixed; bottom:-10px; right: 75vh;">
        <img src="{{ asset('Admin/dog6.jpg.jpg') }}" alt="Dog Image" style="width: 270px; height:330px;">
    </div>
@endsection
