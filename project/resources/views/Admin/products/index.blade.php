@extends('Admin.layouts.index')

@section('title', 'Products')

@section('content')
    <div class="container">
        <h1 class="mb-4">Products</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-orange"><i class="fa-solid fa-plus"></i> Product</a><br><br>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>
                            @if($product->image)
                                <img style="height: 50px;width:50px;border-radius:50%" src="{{ asset($product->image) }}" alt="Post Image" width="100">
                            @else
                                No image
                            @endif
                        </td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->stock_quantity }}</td>
                        <td>
                            {{-- استبدال الأزرار بأيقونات --}}
                            {{-- <a href="{{ route('admin.products.show', $product->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;">
                                <i class="fa-solid fa-eye"></i>
                            </a> --}}
                            <a href="{{ route('admin.products.edit', $product->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background:none; border:none; color:#E17E2A; font-size:20px;" onclick="return confirm('Are you sure you want to delete this product?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
