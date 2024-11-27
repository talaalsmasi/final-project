<?php
namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\RescueAnimal;
use App\Models\Donation;
use Illuminate\Http\Request;

class UserRescueAnimalController extends Controller
{
    public function index()
    {
        $rescueAnimals = RescueAnimal::with('pet')->get();
        return view('rescueAnimals.rescueAnimals', compact('rescueAnimals'));
    }

    public function show($id)
    {
        $rescueAnimal = RescueAnimal::with('pet')->findOrFail($id);
        return view('rescueAnimals.showDetails', compact('rescueAnimal'));
    }

    public function donate($id)
    {
        // التحقق مما إذا كان المستخدم مسجل الدخول
        if (!auth()->check()) {
            // تحويل المستخدم إلى صفحة تسجيل الدخول مع رسالة
            return redirect()->route('login')->with('error', 'You have to login first');
        }

        // جلب بيانات الحيوان مع بيانات pet
        $rescueAnimal = RescueAnimal::with('pet')->findOrFail($id);

        // تخزين رقم الحيوان واليوزر في الجلسة
        session()->put('rescue_animal_id', $rescueAnimal->id);
        session()->put('user_id', auth()->id());

        // عرض صفحة التبرع مع بيانات الحيوان
        return view('rescueAnimals.donate', compact('rescueAnimal'));
    }

    public function processDonation(Request $request, $id)
    {
        // التحقق من صحة البيانات
        $validated = $request->validate([
            'donation_amount' => 'required|numeric|min:1',
            'card_number' => 'required|digits:16',
            'cardholder_name' => 'required|string',
            'cvv' => 'required|digits:3',
        ]);

        // التحقق من وجود البيانات في الجلسة
        if (!session()->has('rescue_animal_id') || !session()->has('user_id')) {
            return back()->withErrors(['error' => 'Session data is missing. Please try again.']);
        }

        // جلب الحيوان المحتاج للتبرع
        $rescueAnimal = RescueAnimal::findOrFail($id);

        // إضافة المبلغ المتبرع به إلى المبلغ الحالي
        $newDonationAmount = $rescueAnimal->current_donated_amount + $validated['donation_amount'];

        // التأكد من أن المبلغ لا يتجاوز المبلغ المطلوب
        if ($newDonationAmount > $rescueAnimal->total_required_amount) {
            return back()->withErrors(['donation_amount' => 'Donation exceeds the required amount.']);
        }

        // محاولة حفظ البيانات في قاعدة البيانات
        try {
            // تحديث المبلغ المتبرع به للحيوان
            $rescueAnimal->update([
                'current_donated_amount' => $newDonationAmount,
            ]);

            // تسجيل التبرع في جدول التبرعات
            Donation::create([
                'user_id' => session('user_id'), // ID المستخدم المخزن في الجلسة
                'rescue_animal_id' => session('rescue_animal_id'), // ID الحيوان المخزن في الجلسة
                'amount' => $validated['donation_amount'], // مبلغ التبرع
            ]);

            // إعادة توجيه إلى صفحة النجاح
            return redirect()->route('profile', $rescueAnimal->id)->with('success', 'Thank you for your donation! Payment successful.');
        } catch (\Exception $e) {
            // في حالة حدوث خطأ
            return back()->withErrors(['error' => 'Payment failed. Please try again.']);
        }
    }

    public function showUserDonations()
    {
        // جلب تبرعات المستخدم من جدول التبرعات
        $userDonations = Donation::where('user_id', auth()->id())->with('rescueAnimal')->get();

        // تمرير التبرعات إلى العرض (view)
        return view('rescueAnimals.userDonations', compact('userDonations'));
    }

}
