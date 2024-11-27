

@extends('Admin.layouts.index')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
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
    </div>
</div>
@endsection


