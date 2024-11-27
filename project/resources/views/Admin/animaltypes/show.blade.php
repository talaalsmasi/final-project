@extends('Admin.layouts.index')

@section('title', 'View Animal Type')

@section('content')
    <div class="container">
        <h1 class="mb-4">View Animal Type</h1>
        <div class="mb-3">
            <label for="type_name" class="form-label">Type Name</label>
            <input type="text" id="type_name" class="form-control" value="{{ $animalType->type_name }}" readonly>
        </div>
        <a href="{{ route('admin.animaltypes.index') }}" class="btn btn-orange">Back to List</a>
    </div>
@endsection
