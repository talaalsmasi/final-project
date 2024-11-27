@extends('Admin.layouts.index')

@section('title', 'Brooming Services')

@section('content')
<div class="container">
    <h1 class="mb-4">Grooming Services</h1>
    <a href="{{ route('admin.grooming_services.create') }}" class="btn btn-orange mb-4"><i class="fa-solid fa-plus"></i> Grooming Service</a>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($groomingServices as $service)
                <tr>
                    <td>{{ $service->name }}</td>
                    <td>{{ number_format($service->price, 2)}} JD</td>
                    <td>{{ $service->description ?? 'No description available' }}</td>
                    <td>
                        {{-- استبدال الأزرار بأيقونات --}}
                        {{-- <a href="{{ route('admin.grooming_services.show', $service->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;">
                            <i class="fa-solid fa-eye"></i>
                        </a> --}}
                        <a href="{{ route('admin.grooming_services.edit', $service->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('admin.grooming_services.destroy', $service->id) }}" method="POST" style="display:inline-block;">
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
