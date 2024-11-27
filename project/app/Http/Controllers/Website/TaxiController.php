<?php
namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\TaxiRequest;
use App\Models\Driver;
use App\Models\Area;
use App\Models\Pet;



use Illuminate\Http\Request;

class TaxiController extends Controller
{
    public function showRequestForm()
    {
        // جلب الحيوانات الأليفة الخاصة بالمستخدم الحالي
        $pets = Pet::where('user_id', auth()->id())->get();

        // عرض الفورم مع تمرير بيانات الحيوانات الأليفة
        return view('taxi.requestTaxi', compact('pets'));
    }



    public function checkAvailability(Request $request)
    {
        // التحقق من إدخال جميع البيانات المطلوبة
        $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'trip_type' => 'required|in:one_way,round_trip',
            'location' => 'required|string'
        ]);

        // استخراج الإحداثيات من الرابط إذا كان الموقع رابط Google Maps
        $location = $request->location;
        if (strpos($location, 'https://www.google.com/maps') !== false) {
            // استخراج الإحداثيات باستخدام تعبير منتظم
            preg_match('/@([\d\.]+),([\d\.]+)/', $location, $matches);
            if (isset($matches[1]) && isset($matches[2])) {
                $location = $matches[1] . ',' . $matches[2];
            } else {
                return back()->withErrors(['error' => 'Invalid location link. Please enter a link that contains coordinates.']);
            }
        }

        // العثور على سائق متاح
        $driver = Driver::where('available', true)
            ->leftJoin('taxi_requests', 'drivers.id', '=', 'taxi_requests.driver_id')
            ->select('drivers.*')
            ->selectRaw('IFNULL(MAX(taxi_requests.updated_at), "1970-01-01") as last_trip')
            ->groupBy('drivers.id', 'drivers.available', 'drivers.user_id', 'drivers.created_at', 'drivers.updated_at')
            ->orderBy('last_trip', 'asc') // اختيار السائق الذي لديه أطول مدة منذ آخر رحلة
            ->first();

        if (!$driver) {
            return back()->withErrors(['error' => 'Sorry, there is no driver available at the moment.']);
        }

        // جلب بيانات الحيوان الأليف
        $pet = Pet::find($request->pet_id);

        // حساب المسافة بناءً على الموقع المدخل
        $distance = $this->calculateDistanceFromClinic($location);

        // حساب السعر بناءً على المسافة ونوع الرحلة
        $price = $distance * ($request->trip_type === 'round_trip' ? 2 : 1);

        // عرض صفحة التأكيد مع تفاصيل السائق، الحيوان الأليف، والسعر
        return view('taxi.confirmation', compact('driver', 'price', 'request', 'pet'));
    }






    private function calculateDistanceFromClinic($destination)
    {
        // إحداثيات العيادة
        $clinicLat = 32.051063;
        $clinicLon = 35.882757;

        // فصل إحداثيات الوجهة المدخلة
        list($destLat, $destLon) = explode(',', str_replace(' ', '', $destination));

        // تحويل الإحداثيات إلى قيم عددية
        $destLat = (float) $destLat;
        $destLon = (float) $destLon;

        // تطبيق صيغة Haversine لحساب المسافة
        $earthRadius = 6371; // نصف قطر الأرض بالكيلومترات

        $dLat = deg2rad($destLat - $clinicLat);
        $dLon = deg2rad($destLon - $clinicLon);

        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($clinicLat)) * cos(deg2rad($destLat)) *
             sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c; // المسافة بالكيلومترات

        return $distance;
    }






public function storeRequest(Request $request)
{
    // التحقق من صحة البيانات المطلوبة
    $request->validate([
        'pet_id' => 'required|exists:pets,id',
        'trip_type' => 'required|in:one_way,round_trip',
        'location' => 'required|url',
        'driver_id' => 'required|exists:drivers,id',
        'price' => 'required|numeric'
    ]);

    // حفظ الطلب في قاعدة البيانات
    $taxiRequest = TaxiRequest::create([
        'user_id' => auth()->id(),
        'pet_id' => $request->pet_id,
        'driver_id' => $request->driver_id,
        'trip_type' => $request->trip_type,
        'price' => $request->price,
        'status' => 'pending'
    ]);

    // تحديث حالة السائق ليصبح غير متاح
    $driver = $taxiRequest->driver;
    $driver->update(['available' => false]);

    return redirect()->route('profile')->with('success', 'Your taxi booking has been successfully completed! ');
}


public function showUserTaxiRequests()
{
    // جلب الطلبات الخاصة بالمستخدم الحالي مع تفاصيل السائق
    $userTaxiRequests = TaxiRequest::where('user_id', auth()->id())
        ->with('driver')
        ->get();

    return view('taxi.userTaxiRequest', compact('userTaxiRequests'));
}







}
