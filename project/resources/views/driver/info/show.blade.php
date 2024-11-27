@extends('driver.layouts.index')
@section('title', 'Dashboard')
@section('content')
<div class="container">
    <h1 class="mb-4">Driver Information</h1>

    {{-- عرض الرسالة بعد التحديث --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- كارد لعرض المعلومات --}}
    <div class="card" style="box-shadow: 0px 6px 12px -1px #ddd; border-radius: 8px; padding: 20px;">
        <div class="row g-0">
            {{-- الصورة --}}
            <div class="col-md-4 text-center">
                @if($driver->image)
                    <img src="{{ asset($driver->image) }}" alt="Profile Image" class="img-fluid rounded" style="width:50vh; height: 50vh;border-radius:50% ">
                @else
                    <p>No image available</p>
                @endif
            </div>
            {{-- المعلومات --}}
            <div class="">
                <div class="">
                    <div >
                        <p ><b>Name:</b></p>
                        <p >{{ $driver->name }}</p>
                    </div>
                    <div >
                        <p ><b>Email:</b></p>
                        <p >{{ $driver->email }}</p>
                    </div>
                    <div >
                        <p><b>Phone:</b></p>
                        <p >{{ $driver->phone }}</p>
                    </div>

                    {{-- زر لتعديل المعلومات --}}
                    <a href="{{ route('driver.edit') }}" class="btn btn-orange mt-3">Edit Information</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
