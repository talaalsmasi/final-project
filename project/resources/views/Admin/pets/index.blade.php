@extends('Admin.layouts.index')

@section('title', 'Pets')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="container">
        <h1 class="mb-4">Pets</h1>
        <a href="{{ route('admin.pets.create') }}" class="btn btn-orange"><i class="fa-solid fa-plus"></i> Pet</a><br><br>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Animal type</th>
                    <th>Breed</th>
                    <th>Birthday</th>
                    <th>Owner</th>
                    {{-- <th>Appointments</th> --}}
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pets as $pet)
                    <tr>
                        <td>{{ $pet->name }}</td>
                        <td>
                            @if($pet->image)
                                <img style="height: 50px;width:50px;border-radius:50%" src="{{ asset($pet->image) }}" alt="Post Image" width="100">
                            @else
                                No image
                            @endif
                        </td>
                        <td>{{ $pet->animalType->type_name }}</td>
                        <td>{{ $pet->breed }}</td>
                        <td>{{ $pet->birthday }}</td>
                        <td>{{ $pet->user->name }}</td>
                        {{-- <td>
                            @if($pet->appointments->count() > 0)
                                <ul>
                                    @foreach($pet->appointments as $appointment)
                                        <li>{{ $appointment->service->name }} on {{ $appointment->appointment_date }}</li>
                                    @endforeach
                                </ul>
                            @else
                                No appointments
                            @endif
                        </td> --}}
                        <td>
                            {{-- استبدال الأزرار بأيقونات --}}
                            {{-- <a href="{{ route('admin.pets.show', $pet->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;">
                                <i class="fa-solid fa-eye"></i>
                            </a> --}}
                            <a href="{{ route('admin.pets.edit', $pet->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.pets.destroy', $pet->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background:none; border:none; color:#E17E2A; font-size:20px;" onclick="return confirm('Are you sure you want to delete this pet?')">
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
