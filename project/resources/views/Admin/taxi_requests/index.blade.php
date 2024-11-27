@extends('Admin.layouts.index')

@section('title', 'Taxi Request')

@section('content')
<div class="container">
    <h1 class="mb-4">All Taxi Requests</h1>
    <a href="{{ route('admin.taxi_requests.create') }}" class="btn btn-orange"><i class="fa-solid fa-plus"></i> Taxi Request</a><br><br>

    <div>
        <table class="table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Driver</th>
                    <th>Status</th>
                    <th>Trip Type</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($taxiRequests as $request)
                    <tr>
                        <td>{{ $request->user->name }}</td>
                        <td>{{ $request->driver->user->name }}</td>
                        <td>
                            @if($request->status == 'pending')
                                <span class="badge badge-warning">Pending</span>
                            @elseif($request->status == 'approved')
                                <span class="badge badge-success">Approved</span>
                            @elseif($request->status == 'completed')
                                <span class="badge badge-primary">Completed</span>
                            @endif
                        </td>

                        <td>{{ ucfirst($request->trip_type) }}</td>
                        <td>{{ number_format($request->price, 2) }} JD</td>
                        <td>
                            <a href="{{ route('admin.taxi_requests.edit', $request) }}" style="color: #E17E2A; font-size:20px;">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.taxi_requests.destroy', $request) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background:none; border:none; color:#E17E2A; font-size:20px;" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
