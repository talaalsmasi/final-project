@extends('Admin.layouts.index')

@section('title', 'Message Details')

@section('content')
<div class="container">
    <h2>Message Details</h2>

    <div class="card mt-4" style="background-color: #f6f5f5; padding: 20px;">
        <!-- Header with Subject and Sender Details -->
        <div class="card-header">
            <h4>{{ $message->subject }}</h4>
            <p>From: <strong>{{ $message->name }}</strong> (<a href="mailto:{{ $message->email }}">{{ $message->email }}</a>)</p>
        </div>

        <!-- Message Body -->
        <div class="card-body">
            <p>{{ $message->message }}</p>
        </div>

        <!-- Footer with Back Button -->
        <div class="card-footer">
            <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-orange">Back to All Messages</a>
        </div>
    </div>
</div>
@endsection
