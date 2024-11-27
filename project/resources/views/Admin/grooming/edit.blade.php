@extends('Admin.layouts.index')

@section('title', 'Edit Grooming Appointment')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Grooming Appointment</h2>

    <div class="card" style="background-color: #f6f5f5; padding: 20px;">
        <form action="{{ route('admin.grooming.update', $grooming->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Owner Field -->
            <div class="mb-3">
                <label for="user_id" class="form-label">Owner</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <option value="" disabled>Select Owner</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" @if($user->id == $grooming->user_id) selected @endif>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Pet Field -->
            <div class="mb-3">
                <label for="pet_id" class="form-label">Pet</label>
                <select name="pet_id" id="pet_id" class="form-control" required>
                    <option value="" disabled>Select Pet</option>
                    @foreach($pets as $pet)
                        @if($pet->user_id == $grooming->user_id)
                            <option value="{{ $pet->id }}" @if($pet->id == $grooming->pet_id) selected @endif>{{ $pet->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function () {
                    // Function to load pets based on selected owner
                    function loadPets(ownerId, selectedPetId = null) {
                        $('#pet_id').html('<option value="" disabled selected>Loading...</option>');

                        if (ownerId) {
                            $.ajax({
                                url: '{{ route("admin.getPetsByOwner") }}', // تأكد أن هذا الـ Route صحيح للحجز
                                type: 'GET',
                                data: { owner_id: ownerId },
                                success: function (data) {
                                    let options = '<option value="" disabled>Select Pet</option>';
                                    data.forEach(function (pet) {
                                        options += `<option value="${pet.id}" ${pet.id == selectedPetId ? 'selected' : ''}>${pet.name}</option>`;
                                    });
                                    $('#pet_id').html(options);
                                },
                                error: function () {
                                    alert('Unable to fetch pets. Please try again.');
                                }
                            });
                        }
                    }

                    // Load pets for the selected owner on page load
                    loadPets($('#user_id').val(), {{ $grooming->pet_id }});

                    // Fetch pets when the owner is changed
                    $('#user_id').change(function () {
                        let ownerId = $(this).val();
                        loadPets(ownerId);
                    });
                });
            </script>


            <!-- Appointment Date Field -->
            <div class="mb-3">
                <label for="appointment_date" class="form-label">Appointment Date</label>
                <input type="date" name="appointment_date" id="appointment_date" class="form-control" value="{{ $grooming->appointment_date }}" required>
            </div>

            <!-- Appointment Time Field -->
            <div class="mb-3">
                <label for="appointment_time" class="form-label">Appointment Time</label>
                <select name="appointment_time" id="appointment_time"class="form-control" value="{{ $grooming->appointment_time }}" required>
                <option value="" disabled selected>Select Time Slot</option>
                <option value="10:00 AM - 10:30 AM">10:00 AM - 10:30 AM</option>
                <option value="10:30 AM - 11:00 AM">10:30 AM - 11:00 AM</option>
                <option value="11:00 AM - 11:30 AM">11:00 AM - 11:30 AM</option>
                <option value="11:30 AM - 12:00 PM">11:30 AM - 12:00 PM</option>
                <option value="12:00 PM - 12:30 PM">12:00 PM - 12:30 PM</option>
                <option value="12:30 PM - 01:00 PM">12:30 PM - 01:00 PM</option>
                <option value="01:30 PM - 02:00 PM">01:30 PM - 02:00 PM</option>
                <option value="02:00 PM - 02:30 PM">02:00 PM - 02:30 PM</option>
                <option value="02:30 PM - 03:00 PM">02:30 PM - 03:00 PM</option>
                <option value="03:00 PM - 03:30 PM">03:00 PM - 03:30 PM</option>
                <option value="03:30 PM - 04:00 PM">03:30 PM - 04:00 PM</option>
                <option value="04:00 PM - 04:30 PM">04:00 PM - 04:30 PM</option>
                <option value="04:30 PM - 05:00 PM">04:30 PM - 05:00 PM</option>
                <option value="05:00 PM - 05:30 PM">05:00 PM - 05:30 PM</option>
                <option value="05:30 PM - 06:00 PM">05:30 PM - 06:00 PM</option>
                <option value="06:00 PM - 06:30 PM">06:00 PM - 06:30 PM</option>
                <option value="06:30 PM - 07:00 PM">06:30 PM - 07:00 PM</option>
                <option value="07:00 PM - 07:30 PM">07:00 PM - 07:30 PM</option>
                <option value="07:00 PM - 08:00 PM">07:00 PM - 08:00 PM</option>
                <option value="08:00 PM - 08:30 PM">08:00 PM - 08:30 PM</option>
                <option value="08:30 PM - 09:00 PM">08:30 PM - 09:00 PM</option>
            </select>
            </div>

            <!-- Service Field -->
            <div class="mb-3">
                <label for="service_id" class="form-label">Service</label>
                <select name="service_id" id="service_id" class="form-control" required>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" @if($service->id == $grooming->service_id) selected @endif>{{ $service->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Status Field -->
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="pending" @if($grooming->status == 'pending') selected @endif>Pending</option>
                    <option value="approved" @if($grooming->status == 'approved') selected @endif>Approved</option>
                    <option value="rejected" @if($grooming->status == 'rejected') selected @endif>Rejected</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-orange">Update</button>
        </form>
    </div>
</div>
@endsection
