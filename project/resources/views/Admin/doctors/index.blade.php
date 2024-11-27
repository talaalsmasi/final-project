<!-- resources/views/Admin/doctors/index.blade.php -->
@extends('Admin.layouts.index')

@section('title', 'Doctors')

@section('content')
    <div class="container">
        <h1 class="mb-4">Doctors</h1>
        <a href="{{ route('admin.doctors.create') }}" class="btn btn-orange"><i class="fa-solid fa-plus"></i> Doctor</a><br><br>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>About</th>
                    {{-- <th>Email</th> --}}
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($doctors as $doctor)
                    <tr>
                        <td>{{ $doctor->user->name }}</td>
                        <td>{{ $doctor->about }}</td>
                        {{-- <td>{{ $doctor->user->email }}</td> --}}
                        <td>
                            {{-- استبدال الأزرار بأيقونات --}}
                            <a href="{{ route('admin.doctors.edit', $doctor->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background:none; border:none; color:#E17E2A; font-size:20px; margin-top:-10px;">
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
