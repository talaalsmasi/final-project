{{-- @extends('Admin.layouts.index')

@section('title', 'Dashboard')

@section('content')
    <div class="stats">
        <div class="stat-card">
            <h6>Veterinarians</h6>
            <p>{{ $veterinariansCount }}</p>
        </div>
        <div class="stat-card">
            <h6>Registered Pets</h6>
            <p>{{ $registeredPetsCount }}</p>
        </div>
        <div class="stat-card">
            <h6>Services Provided</h6>
            <p>{{ $servicesProvidedCount }}</p>
        </div>
        <div class="stat-card">
            <h6>Adoptions</h6>
            <p>{{ $adoptionsCount }}</p>
        </div>
    </div>

    <canvas id="revenueChart"></canvas>
    <canvas id="careReportChart"></canvas>
@endsection --}}

@extends('doctor.layouts.index')

@section('title', 'Dashboard')


@section('content')
    <div class="dashboard">
        <div class="stats">
            <div class="stat-card">
                <h6>Veterinarians</h6>
                <p>{{ $veterinariansCount }}</p>
            </div>
            <div class="stat-card">
                <h6>Registered Pets</h6>
                <p>{{ $registeredPetsCount }}</p>
            </div>
            <div class="stat-card">
                <h6>Services Provided</h6>
                <p>{{ $servicesProvidedCount }}</p>
            </div>
            <div class="stat-card">
                <h6>Adoptions</h6>
                <p>{{ $adoptionsCount }}</p>
            </div>
        </div>

        <div class="charts">
            <div class="chart-container">
                <h6>Monthly Revenue</h6>
                <canvas id="revenueChart"></canvas>
            </div>
            <div class="chart-container">
                <h6>Pet Care Report</h6>
                <canvas id="careReportChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('Admin/custom.js') }}"></script>
@endsection
