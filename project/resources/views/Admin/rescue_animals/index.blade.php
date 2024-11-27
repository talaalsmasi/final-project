@extends('Admin.layouts.index')

@section('title', 'Rescue Animals')

@section('content')
<div class="container">
    <h1 class="mb-4">Rescue Animals</h1>
    <a href="{{ route('admin.rescue_animals.create') }}" class="btn btn-orange mb-4"><i class="fa-solid fa-plus"></i> Rescue Animal</a>

    <table class="table">
        <thead>
            <tr>
                <th>Pet</th>
                <th>Total Required Amount</th>
                <th>Current Donated Amount</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rescueAnimals as $animal)
                <tr>
                    <td>{{ $animal->pet->name }}</td>
                    <td>${{ number_format($animal->total_required_amount, 2) }}</td>
                    <td>${{ number_format($animal->current_donated_amount, 2) }}</td>
                    <td>{{ $animal->description }}</td>
                    <td>
                        {{-- استبدال الأزرار بأيقونات --}}
                        <a href="{{ route('admin.rescue_animals.edit', $animal->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('admin.rescue_animals.destroy', $animal->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:none; border:none; color:#E17E2A; font-size:20px;" onclick="return confirm('Are you sure you want to delete this animal?')">
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
