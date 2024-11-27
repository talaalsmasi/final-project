@extends('Admin.layouts.index')

@section('title', 'Add New Booking')

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
    <h2>Add New Booking</h2>

    <div class="card" style="background-color: #f6f5f5; padding: 20px;">
        <form action="{{ route('admin.bookings.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="user_id">Owner</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <option value="" disabled selected>Select Owner</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="pet_id">Pet</label>
                <select name="pet_id" id="pet_id" class="form-control" required>
                    <option value="" disabled selected>Select Pet</option>
                    <!-- سيتم تحديث هذه الخيارات ديناميكياً -->
                </select>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function () {
                    $('#user_id').change(function () {
                        let ownerId = $(this).val();

                        // تنظيف خيارات الحيوانات عند تغيير الـ Owner
                        $('#pet_id').html('<option value="" disabled selected>Loading...</option>');

                        if (ownerId) {
                            $.ajax({
                                url: '{{ route("admin.getPetsByOwner") }}',
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

<div class="form-group">
    <label for="user_id">Room</label>
    <select name="room_id" id="room_id" class="form-control" required>
        <option value="" disabled selected>Select Room</option>
        @foreach($rooms as $room)
            <option value="{{ $room->id }}">{{ $room->room_name }}</option>
        @endforeach
    </select>
</div>


            <div class="form-group">
                <label for="check_in_date">Check-in Date</label>
                <input type="date" name="check_in_date" class="form-control" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
            </div>

            <div class="form-group">
                <label for="check_out_date">Check-out Date</label>
                <input type="date" name="check_out_date" class="form-control" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
            </div>

            <button type="submit" class="btn btn-orange">Save</button>
        </form>
    </div>
</div>

@endsection
