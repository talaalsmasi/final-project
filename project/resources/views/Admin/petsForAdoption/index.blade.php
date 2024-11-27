@extends('Admin.layouts.index')

@section('title', 'Pets for Adoption')

@section('content')
<div class="container">
    <h1 class="mb-4">Pets for Adoption</h1>
    {{-- <a href="{{ route('admin.petsForAdoption.create') }}" class="btn btn-orange mb-4"><i class="fa-solid fa-plus"></i> Pet</a> --}}

    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Breed</th>
                <th>Age</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pets as $pet)
                <tr>
                    <td><img style="height: 50px;width:50px;border-radius:50%" src="{{ asset($pet->image) }}" alt="{{ $pet->name }}" width="100"></td>
                    <td>{{ $pet->name }}</td>
                    <td>{{ $pet->breed }}</td>
                    <td>{{ \Carbon\Carbon::parse($pet->birthday)->age }} years</td>
                    <td>
                        {{-- استبدال الأزرار بأيقونات --}}
                        {{-- <a href="{{ route('admin.petsForAdoption.show', $pet->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.petsForAdoption.edit', $pet->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a> --}}
                        <form action="{{ route('admin.petsForAdoption.destroy', $pet->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            {{-- <button type="submit" style="background:none; border:none; color:#E17E2A; font-size:20px;" onclick="return confirm('Are you sure you want to delete this pet?')">
                                <i class="fas fa-trash-alt"></i>
                            </button> --}}
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
