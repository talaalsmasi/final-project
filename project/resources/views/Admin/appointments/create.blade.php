@extends('Admin.layouts.index')

@section('title', 'Add New Appointment')

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
    <h2>Add New Appointment</h2>

    <div class="card" style="background-color: #f6f5f5; padding: 20px;">
        <form action="{{ route('admin.appointments.store') }}" method="POST">
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
                <label for="service_id">Service</label>
                <select name="service_id" id="service_id" class="form-control" required>
                    <option value="" disabled selected>Select Service</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" data-price="{{ $service->price }}">{{ $service->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group" id="doctor-section">
                <label for="doctor_id">Doctor</label>
                <select name="doctor_id" id="doctor_id" class="form-control" required>
                    <option value="" disabled selected>Select Doctor</option>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group" id="appointment_date-section">
                <label for="appointment_date">Appointment Date</label>
                <input type="date" name="appointment_date" id="appointment_date" class="form-control"
                       min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
            </div>

            <div class="form-group" id="time-section">
                <label for="appointment_time">Appointment Time</label>
                <select name="appointment_time" id="appointment_time" class="form-control" required>
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

            <button type="submit" class="btn btn-orange">Save</button>
        </form>
    </div>
</div>

@endsection
