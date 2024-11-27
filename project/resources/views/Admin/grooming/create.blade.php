@extends('Admin.layouts.index')

@section('title', 'Add Grooming Appointment')

@section('content')
<div class="container">
    <h2 class="mb-4">Add Grooming Appointment</h2>

    <div class="card" style="background-color: #f6f5f5; padding: 20px;">
        <form action="{{ route('admin.grooming.store') }}" method="POST">
            @csrf

            <!-- Owner Field -->
            <div class="mb-3">
                <label for="user_id" class="form-label">Owner</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <option value="" disabled selected>Select Owner</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Pet Field -->
            <div class="mb-3">
                <label for="pet_id" class="form-label">Pet</label>
                <select name="pet_id" id="pet_id" class="form-control" required>
                    <option value="" disabled selected>Select Pet</option>
                </select>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function () {
                    $('#user_id').change(function () {
                        let ownerId = $(this).val();

                        // مسح قائمة الحيوانات الحالية وعرض رسالة "جاري التحميل"
                        $('#pet_id').html('<option value="" disabled selected>Loading...</option>');

                        if (ownerId) {
                            $.ajax({
                                url: '{{ route("admin.getPetsByOwner") }}', // تأكد أن هذا الـ Route مناسب
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


            <!-- Appointment Date Field -->
            <div class="mb-3">
                <label for="appointment_date" class="form-label">Appointment Date</label>
                <input type="date" name="appointment_date" id="appointment_date" class="form-control" required>
            </div>

            <!-- Appointment Time Field -->
            <div class="mb-3">
                <label for="appointment_time" class="form-label">Appointment Time</label>
                <select name="appointment_time" id="appointment_time"class="form-control" required>
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
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Status Field -->
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-orange">Save</button>
        </form>
    </div>
</div>
@endsection
