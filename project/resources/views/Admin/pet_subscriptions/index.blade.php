@extends('Admin.layouts.index')

@section('title', 'subscriptions')

@section('content')

<div class="container">
    <h1 class="mb-4">Pet Subscriptions</h1>
<a href="{{ route('admin.pet_subscriptions.create')}}" class="btn btn-orange"><i class="fa-solid fa-plus"></i>  Subscription</a><br><br>


<table class="table">
    <thead>
        <tr>
            <th>Pet Name</th>
            <th>Subscription Name</th>
            <th>Month</th>
            <th>Week Number</th>
            <th>Session Time</th>
            <th>status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($petSubscriptions as $subscription)
        <tr>
            <td>{{ $subscription->pet->name }}</td>
            <td>{{ $subscription->subscription->name }}</td>
            <td>{{ $subscription->month }}</td>
            <td>{{ $subscription->week_number }}</td>
            <td> @if($subscription->status == 'pending')
                <span class="badge badge-warning">Pending</span>
            @elseif($subscription->status == 'approved')
                <span class="badge badge-success">Approved</span>
            @elseif($subscription->status == 'rejected')
                <span class="badge badge-danger">Rejected</span>
            @endif</td>
            <td>{{ $subscription->session_time }}</td>
            <td>

                <a href="{{ route('admin.pet_subscriptions.edit', $subscription->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <form action="{{ route('admin.pet_subscriptions.destroy', $subscription->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background:none; border:none; color:#E17E2A; font-size:20px;" onclick="return confirm('Are you sure you want to delete this subscription?')">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
@endsection
