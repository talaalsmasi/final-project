@extends('Admin.layouts.index')

@section('title', 'Donations')

@section('content')
<div class="container">
    <h1 class="mb-4">Donations</h1>
    <a href="{{ route('admin.donations.create') }}" class="btn btn-orange mb-4"><i class="fa-solid fa-plus"></i> Donation</a>
    <table class="table">
        <thead>
            <tr>
                <th>Rescue Animal</th>
                <th>Donor</th>
                <th>Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($donations as $donation)
                <tr>
                    <td>{{ $donation->rescueAnimal->pet->name }}</td>
                    <td>{{ $donation->user->name }}</td>
                    <td>{{ number_format($donation->amount, 2) }}JD</td>
                    <td>
                        {{-- استبدال الأزرار بأيقونات --}}
                        <a href="{{ route('admin.donations.edit', $donation->id) }}" style="color: #E17E2A; text-decoration:none; font-size:20px;">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('admin.donations.destroy', $donation->id) }}" method="POST" style="display:inline-block;">
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
