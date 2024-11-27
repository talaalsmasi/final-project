<!-- resources/views/Admin/dashboard.blade.php -->
@extends('Admin.layouts.index')

@section('title', 'Dashboard')


@section('content')
<div class="dashboard">
    <div class="container">
        <div class="row stats">
            <div class="col-md-4 mb-4">
                <div class="stat-card">
                    <h6>Veterinarians</h6>
                    <p>{{ $veterinariansCount }}</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="stat-card">
                    <h6>Registered Pets</h6>
                    <p>{{ $registeredPetsCount }}</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="stat-card">
                    <h6>Services Provided</h6>
                    <p>{{ $servicesProvidedCount }}</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="stat-card">
                    <h6>Adoptions</h6>
                    <p>{{ $adoptionsCount }}</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="stat-card">
                    <h6>Total Appointments</h6>
                    <p>{{ $appointmentsCount }}</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="stat-card">
                    <h6>Room Bookings</h6>
                    <p>{{ $roomBookingsCount }}</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="stat-card">
                    <h6>Grooming Sessions</h6>
                    <p>{{ $groomingSessionsCount }}</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="stat-card">
                    <h6>Products Sold</h6>
                    <p>{{ $productsSoldCount }}</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="stat-card">
                    <h6>Donations Received</h6>
                    <p>{{ $donationsCount }}</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="stat-card">
                    <h6>Event Registrations</h6>
                    <p>{{ $eventRegistrationsCount }}</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="stat-card">
                    <h6>Active Subscriptions</h6>
                    <p>{{ $activeSubscriptionsCount }}</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="stat-card">
                    <h6>Feedback Received</h6>
                    <p>{{ $feedbackCount }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script src="{{ asset('Admin/custom.js') }}"></script>
@endsection
