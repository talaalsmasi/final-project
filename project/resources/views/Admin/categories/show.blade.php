@extends('Admin.layouts.index')

@section('title', 'Category Details')

@section('content')
    <div class="container">
        <h1 class="mb-4">Category Details</h1>
        <div class="mb-3">
            <label class="form-label">Name:</label>
            <p>{{ $category->name }}</p>
        </div>
        <div class="mb-3">
            <label class="form-label">Description:</label>
            <p>{{ $category->description }}</p>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-orange">Back</a>
    </div>
@endsection
