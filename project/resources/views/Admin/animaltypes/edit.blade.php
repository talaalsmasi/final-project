@extends('Admin.layouts.index')

@section('title', 'Edit Animal Type')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
    <h2>Edit Animal Type</h2>

    <div class="card" style="background-color: #f6f5f5; padding: 20px;">
        <form action="{{ route('admin.animaltypes.update', $animalType->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="type_name">Type Name</label>
                <input type="text" name="type_name" id="type_name" class="form-control" value="{{ $animalType->type_name }}" required>
            </div>

            <button type="submit" class="btn btn-orange">Update</button>
        </form>
    </div>
</div>
@endsection
