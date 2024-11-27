@extends('Admin.layouts.index')

@section('title', 'Add New Pet')

@section('content')
<div class="container">
    <h1 class="mb-4">Add New Pet</h1>

    <form action="{{ route('admin.petsForAdoption.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Pet Name</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>
        <div class="mb-3">
            <label for="breed" class="form-label">Breed</label>
            <input type="text" name="breed" class="form-control" id="breed" required>
        </div>
        <div class="mb-3">
            <label for="birthday" class="form-label">Birthday</label>
            <input type="date" name="birthday" class="form-control" id="birthday" required>
        </div>
        <div class="mb-3">
            <label for="animal_type_id" class="form-label">Animal Type</label>
            <select name="animal_type_id" class="form-control" id="animal_type_id" required>
                <!-- قم بجلب أنواع الحيوانات المتاحة -->
                <option value="1">Dog</option>
                <option value="2">Cat</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Pet Image</label>
            <input type="file" name="image" class="form-control" id="image" required>
        </div>
        <button type="submit" class="btn btn-orange">Save Pet</button>
    </form>
</div>
@endsection
