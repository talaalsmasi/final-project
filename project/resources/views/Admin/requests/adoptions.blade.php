@extends('Admin.layouts.index')

@section('title', 'Posts')

@section('content')

<div class="container">
    <h1 class="mb-4">Adoption Requests</h1>
    <table class="table">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Pet ID</th>
                <th>Reason</th>
                <th>Can Feed</th>
                <th>Can Treat</th>
                <th>Has Other Pets</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($adoptions as $adoption)
            <tr>
                <td>{{ $adoption->user_id }}</td>
                <td>{{ $adoption->pet_id }}</td>
                <td>{{ $adoption->reason }}</td>
                <td>{{ $adoption->can_feed ? 'Yes' : 'No' }}</td>
                <td>{{ $adoption->can_treat ? 'Yes' : 'No' }}</td>
                <td>{{ $adoption->has_other_pets ? 'Yes' : 'No' }}</td>
                <td>
                    @if($adoption->status == 'pending')
                        <span class="badge badge-warning">Pending</span>
                    @elseif($adoption->status == 'approved')
                        <span class="badge badge-success">Approved</span>
                    @elseif($adoption->status == 'rejected')
                        <span class="badge badge-danger">Rejected</span>
                    @endif
                </td>
                <td>
                    <!-- زر الموافقة -->
                    <form action="{{ route('admin.adoptions.approve', $adoption->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" style="background: none; border: none; color: #28a745; font-size: 20px;">
                            <i class="fas fa-check-circle"></i>
                        </button>
                    </form>

                    <!-- زر الرفض -->
                    <form action="{{ route('admin.adoptions.reject', $adoption->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" style="background: none; border: none; color: #dc3545; font-size: 20px;">
                            <i class="fas fa-times-circle"></i>
                        </button>
                    </form>

                    <!-- زر إعادة التعيين إلى Pending -->
                    <form action="{{ route('admin.adoptions.pending', $adoption->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" style="background: none; border: none; color: #ffc107; font-size: 20px;">
                            <i class="fas fa-clock"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
