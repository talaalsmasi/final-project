@extends('Admin.layouts.index')

@section('title', 'Edit Adoption Request')

@section('content')
<div class="container">
    <h2>Edit Adoption Request</h2>

    <div class="card" style="background-color: #f6f5f5; padding: 20px;">
        <form action="{{ route('admin.adoptions.update', $adoption->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="pending" {{ $adoption->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ $adoption->status == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ $adoption->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            <button type="submit" class="btn btn-orange">Update Adoption Request</button>
        </form>
    </div>
</div>
@endsection
