<?php
namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pet;
use App\Models\Service;
use App\Models\Adoption;

class DrDashboardController extends Controller
{
    public function index()
    {
        // جمع الإحصائيات من قاعدة البيانات
        $veterinariansCount = User::where('role_id', 3)->count(); // تعديل هنا للتحقق من role_id = 1
        $registeredPetsCount = Pet::count();
        $servicesProvidedCount = Service::count(); // إعادة تفعيل المتغير
        $adoptionsCount = Adoption::count(); // إعادة تفعيل المتغير

        // إرجاع البيانات إلى العرض
        return view('doctor.dashboard.index', compact(
            'veterinariansCount',
            'registeredPetsCount',
            'servicesProvidedCount',
            'adoptionsCount'
        ));
    }
}
