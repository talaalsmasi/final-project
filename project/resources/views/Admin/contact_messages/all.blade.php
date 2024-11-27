@extends('Admin.layouts.index')

@section('title', 'All Contact Messages')

@section('content')
<div class="container mt-4">
    <h1>All Contact Messages</h1>

    <!-- عرض جميع الرسائل -->
    <ul class="list-group">
        @foreach($messages as $message)
            <li class="list-group-item">
                <a href="{{ route('admin.contact_messages.show', $message->id) }}">
                    <strong>{{ $message->name }}</strong> - {{ $message->subject }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
