@extends('Admin.layouts.index')

@section('title', 'Create Adoption Request')

@section('content')
<div class="container">
    <h2>Create Adoption Request</h2>

    <div class="card" style="background-color: #f6f5f5; padding: 20px;">
        <form action="{{ route('admin.adoptions.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="pet_id">Select Pet</label>
                <select name="pet_id" id="pet_id" class="form-control">
                    @foreach($pets as $pet)
                        <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="reason">Reason for Adoption</label>
                <textarea name="reason" id="reason" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="can_feed">Can Provide Food?</label>
                <select name="can_feed" id="can_feed" class="form-control">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="form-group">
                <label for="can_treat">Can Provide Medical Treatment?</label>
                <select name="can_treat" id="can_treat" class="form-control">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="form-group">
                <label for="has_other_pets">Has Other Pets?</label>
                <select name="has_other_pets" id="has_other_pets" class="form-control">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <button type="submit" class="btn btn-orange">Submit</button>
        </form>
    </div>
</div>
@endsection
