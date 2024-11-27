@extends('Admin.layouts.index')

@section('title', 'Services')

@section('content')
    <div class="container">
        <h1 class="mb-4">Services</h1>
        <a href="{{ route('admin.services.create') }}" class="btn btn-orange"><i class="fa-solid fa-plus"></i> Service</a><br><br>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                    <tr>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->price }}</td>
                        <td>
                            {{-- استبدال الأزرار بأيقونات --}}
                            {{-- <a href="{{ route('admin.services.show', $service->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;">
                                <i class="fa-solid fa-eye"></i>
                            </a> --}}
                            <a href="{{ route('admin.services.edit', $service->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background:none; border:none; color:#E17E2A; font-size:20px;" onclick="return confirm('Are you sure you want to delete this service?')">
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
