@extends('Admin.layouts.index')

@section('title', 'Edit Booking')

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
    <h2>Edit Booking</h2>

    <div class="card" style="background-color: #f6f5f5; padding: 20px;">
        <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Owner (User) Dropdown -->
            <div class="form-group">
                <label for="user_id">Owner</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" @if(isset($booking) && $user->id == $booking->user_id) selected @endif>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="pet_id">Pet</label>
                <select name="pet_id" id="pet_id" class="form-control" required>
                    @if(isset($pets))
                        @foreach($pets as $pet)
                            @if($pet->user_id == $booking->user_id)
                                <option value="{{ $pet->id }}" @if($pet->id == $booking->pet_id) selected @endif>
                                    {{ $pet->name }}
                                </option>
                            @endif
                        @endforeach
                    @else
                        <option value="" disabled selected>Select Pet</option>
                    @endif
                </select>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function () {
                    $('#user_id').change(function () {
                        let ownerId = $(this).val();

                        // Clear the pet select box and show a loading message
                        $('#pet_id').html('<option value="" disabled selected>Loading...</option>');

                        if (ownerId) {
                            $.ajax({
                                url: '{{ route("admin.getPetsByOwner") }}', // تأكد أن هذا Route مناسب للحجز
                                type: 'GET',
                                data: { owner_id: ownerId },
                                success: function (data) {
                                    let options = '<option value="" disabled selected>Select Pet</option>';
                                    data.forEach(function (pet) {
                                        options += `<option value="${pet.id}">${pet.name}</option>`;
                                    });
                                    $('#pet_id').html(options);
                                },
                                error: function () {
                                    alert('Unable to fetch pets. Please try again.');
                                }
                            });
                        }
                    });
                });
            </script>


            <!-- Check-in Date -->
            <div class="form-group">
                <label for="check_in_date">Check-in Date</label>
                <input type="date" name="check_in_date" class="form-control" value="{{ old('check_in_date', \Carbon\Carbon::parse($booking->check_in_date)->format('Y-m-d')) }}" required>
            </div>

            <!-- Check-out Date -->
            <div class="form-group">
                <label for="check_out_date">Check-out Date</label>
                <input type="date" name="check_out_date" class="form-control" value="{{ old('check_out_date', \Carbon\Carbon::parse($booking->check_out_date)->format('Y-m-d')) }}" required>
            </div>

            <!-- Status Dropdown -->
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="pending" @if($booking->status == 'pending') selected @endif>Pending</option>
                    <option value="approved" @if($booking->status == 'approved') selected @endif>Approved</option>
                    <option value="rejected" @if($booking->status == 'rejected') selected @endif>Rejected</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-orange">Update</button>
        </form>
    </div>
</div>

@endsection
