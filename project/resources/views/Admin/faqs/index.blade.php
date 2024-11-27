@extends('Admin.layouts.index')

@section('title', 'Questions')

@section('content')
<div class="container">
    <h1 class="mb-4">FAQs</h1>


    <table class="table">
        <thead>
            <tr>
                <th>Question</th>
                <th>Answer</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($faqs as $faq)
                <tr>
                    <td>{{ $faq->question }}</td>
                    <td>{{ $faq->answer }}</td>
                    <td>
                        <!-- Icon for Editing FAQ -->
                        <a href="{{ route('admin.faqs.edit', $faq->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;" title="Edit">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>

                        <!-- Icon for Deleting FAQ -->
                        {{-- <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #E17E2A; font-size: 20px;" title="Delete" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
