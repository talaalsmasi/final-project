@extends('Admin.layouts.index')

@section('title', 'Questions')

@section('content')
<div class="container">
    <h2 class="mb-4">Add New FAQ</h2>

    <div class="card" style="background-color: #f6f5f5; padding: 20px;">
        <form action="{{ route('admin.faqs.store') }}" method="POST">
            @csrf

            <!-- Question Field -->
            <div class="mb-3">
                <label for="question" class="form-label">Question</label>
                <input type="text" name="question" class="form-control" required>
            </div>

            <!-- Answer Field -->
            <div class="mb-3">
                <label for="answer" class="form-label">Answer</label>
                <textarea name="answer" class="form-control" required></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-orange">Save</button>
        </form>
    </div>
</div>
@endsection
