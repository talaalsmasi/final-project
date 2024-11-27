<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\TaxiRequest;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;

class TaxiRequestController extends Controller
{
    // عرض جميع طلبات التاكسي
    public function index()
    {
        $taxiRequests = TaxiRequest::with(['user', 'driver'])->get();
        return view('admin.taxi_requests.index', compact('taxiRequests'));
    }

    // عرض نموذج إنشاء طلب تاكسي جديد
    public function create()
    {
        $drivers = Driver::where('available', true)->get();
        $users = User::all();
        return view('admin.taxi_requests.create', compact('drivers', 'users'));
    }

    // حفظ طلب التاكسي الجديد في قاعدة البيانات
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'driver_id' => 'required|exists:drivers,id',
            'status' => 'required|in:pending,approved,completed',
            'trip_type' => 'required|in:one_way,round_trip',
            'price' => 'required|numeric'
        ]);

        TaxiRequest::create($request->all());

        return redirect()->route('admin.taxi_requests.index')->with('success', 'Taxi Request created successfully');
    }

    // عرض تفاصيل طلب تاكسي معين
    public function show(TaxiRequest $taxiRequest)
    {
        return view('admin.taxi_requests.show', compact('taxiRequest'));
    }

    // عرض نموذج تعديل طلب التاكسي
    public function edit(TaxiRequest $taxiRequest)
    {
        $drivers = Driver::where('available', true)->get();
        $users = User::all();
        return view('admin.taxi_requests.edit', compact('taxiRequest', 'drivers', 'users'));
    }

    // تحديث بيانات طلب التاكسي في قاعدة البيانات
    public function update(Request $request, TaxiRequest $taxiRequest)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'driver_id' => 'required|exists:drivers,id',
            'status' => 'required|in:pending,approved,completed',
            'trip_type' => 'required|in:one_way,round_trip',
            'price' => 'required|numeric'
        ]);

        $taxiRequest->update($request->all());

        return redirect()->route('admin.taxi_requests.index')->with('success', 'Taxi Request updated successfully');
    }

    // حذف طلب التاكسي من قاعدة البيانات
    public function destroy(TaxiRequest $taxiRequest)
    {
        $taxiRequest->delete();

        return redirect()->route('admin.taxi_requests.index')->with('success', 'Taxi Request deleted successfully');
    }
}
