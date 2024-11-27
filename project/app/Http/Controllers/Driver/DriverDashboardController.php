<?php

namespace App\Http\Controllers\Driver;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaxiRequest;
use App\Models\Driver;



class DriverDashboardController extends Controller
{
    // Ensure only authenticated drivers can access the dashboard
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the driver dashboard.
     */
    public function index()
    {
        // Add any data needed for the dashboard here

        return view('driver.dashboard.index'); // Make sure this view file exists
    }
    public function show()
    {
        $driver = Auth::user();
        $about = $driver->about;

        return view('driver.info.show', compact('driver', 'about'));
    }

    public function edit()
    {
        $driver = Auth::user();
        $about = $driver->about;

        return view('driver.info.edit', compact('driver', 'about'));
    }
    public function update(Request $request)
    {
        $driver = Auth::user();

        // التحقق من البيانات المدخلة
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $driver->id,
            'phone' => 'required|string|max:15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // تحقق من وصول البيانات
        // dd($validatedData); // Debug to check the data

        // تحديث معلومات المستخدم
        $driver->fill([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
        ]);

        // تحديث الصورة الشخصية إذا تم رفع صورة جديدة
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('img/users', 'public');
            $driver->image = $imagePath;
        }

        $driver->save();

        return redirect()->route('driver.info')->with('success', 'Information updated successfully.');
    }



    public function showRequests()
    {
        $user = Auth::user();

        if ($user && $user->driver) {
            // جلب driver_id الخاص بالسائق
            $driverId = $user->driver->id;

            // جلب طلبات التاكسي الخاصة بالسائق الحالي
            $requests = TaxiRequest::where('driver_id', $driverId)->get();

            return view('driver.requests.index', compact('requests'));
        }

        return redirect()->back()->with('error', 'Driver not found or unauthorized access');
    }




    public function toggleAvailability(Request $request)
    {
        $driver = Auth::user()->driver;

        if ($driver) {
            // Update availability status based on dropdown selection
            $driver->available = $request->input('available') == '1';
            $driver->save();

            return redirect()->back()->with('success', 'Availability status updated successfully.');
        }

        return redirect()->back()->with('error', 'Driver not found or unauthorized access');
    }

    public function changeRequestStatus($id, $status)
    {
        // جلب الطلب من قاعدة البيانات باستخدام المعرف (id)
        $request = TaxiRequest::findOrFail($id);

        // التحقق من أن الحالة المرسلة هي إحدى الحالات المقبولة
        $validStatuses = ['pending', 'approved', 'completed'];
        if (!in_array($status, $validStatuses)) {
            return redirect()->back()->with('error', 'Invalid status provided.');
        }

        // تحديث حالة الطلب
        $request->status = $status;
        $request->save();

        // تحديث توفر السائق بناءً على الحالة الجديدة
        $driver = $request->driver; // جلب السائق المرتبط بالطلب
        if ($status == 'approved') {
            $driver->available = false; // تعيين السائق كـ "مشغول"
        } elseif ($status == 'completed') {
            $driver->available = true; // تعيين السائق كـ "متاح"
        }
        $driver->save();

        return redirect()->route('driver.requests.index')->with('success', 'Request status and driver availability updated successfully.');
    }






}
