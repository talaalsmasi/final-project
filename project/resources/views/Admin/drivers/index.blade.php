@extends('Admin.layouts.index')

@section('title', 'Drivers')

@section('content')
<div class="container">
    <h1 class="mb-4"> Drivers</h1>
    <a href="{{ route('admin.drivers.create') }}" class="btn btn-orange"><i class="fa-solid fa-plus"></i> Driver</a><br><br>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Available</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($drivers as $driver)
                <tr>
                    <td>{{ $driver->user->name }}</td>
                    <td>{{ $driver->user->phone }}</td>
                    <td>{{ $driver->available ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('admin.drivers.edit', $driver->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('admin.drivers.destroy', $driver->id) }}" method="POST" style="display:inline-block;">
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
@endsection
