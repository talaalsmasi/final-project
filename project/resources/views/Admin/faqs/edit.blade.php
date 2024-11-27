@extends('Admin.layouts.index')

@section('title', 'Questions')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit FAQ</h2>

    <div class="card" style="background-color: #f6f5f5; padding: 20px;">
        <form action="{{ route('admin.faqs.update', $faq->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Question Field -->
            <div class="mb-3">
                <label for="question" class="form-label">Question</label>
                <input type="text" name="question" class="form-control" value="{{ $faq->question }}" required>
            </div>

            <!-- Answer Field -->
            <div class="mb-3">
                <label for="answer" class="form-label">Answer</label>
                <textarea name="answer" class="form-control" required>{{ $faq->answer }}</textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-orange">Update</button>
        </form>
    </div>
</div>
@endsection
