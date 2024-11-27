@extends('Admin.layouts.index')

@section('title', 'Contact Messages')

@section('content')
</style>
<div class="container">
    <h1 class="mb-4">Contact Messages</h1><br>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $message)
                <tr>
                    <td>{{ $message->name }}</td>
                    <td>{{ $message->email }}</td>
                    <td>{{ $message->subject }}</td>
                    <td>
                        <!-- Icon for Viewing Message -->
                        <a href="{{ route('admin.contact-messages.show', $message->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;" title="View">
                            <i class="fa-solid fa-eye"></i>
                        </a>

                        <!-- Icon for Deleting Message -->
                        <form action="{{ route('admin.contact-messages.destroy', $message->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:none; border:none; color:#E17E2A; font-size:20px;" title="Delete" onclick="return confirm('Are you sure you want to delete this message?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
