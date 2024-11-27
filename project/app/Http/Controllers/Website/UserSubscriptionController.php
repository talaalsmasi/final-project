<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Subscription;
use App\Models\AnimalSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class UserSubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::all();

        return view('subscriptions.showSubscriptions', compact('subscriptions')); // تمرير الاشتراكات إلى الواجهة
    }
    public function create(Subscription $subscription)
    {
        // التحقق مما إذا كان المستخدم مسجل الدخول
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You have to login first');
        }

        // جلب الحيوانات الخاصة بالمستخدم الحالي
        $pets = Pet::where('user_id', auth()->id())->get();

        // جلب جميع الجلسات المحجوزة لهذا الاشتراك
        $bookedSessions = AnimalSubscription::where('subscription_id', $subscription->id)
            ->get(['month', 'week_number', 'session_time']); // جلب البيانات من قاعدة البيانات

        // تمرير البيانات إلى العرض
        return view('subscriptions.createSubscription', compact('pets', 'subscription', 'bookedSessions'));
    }






    public function showPaymentPage(Request $request)
    {
        $subscription = Subscription::findOrFail($request->subscription_id);
        $pet = Pet::findOrFail($request->pet_id);

        // جلب الشهر ورقم الأسبوع من الطلب
        $selectedMonth = $request->selected_month;
        $selectedWeek = $request->selected_week;

        $weeklySessions = 3; // عدد الحصص في الأسبوع (الأحد، الثلاثاء، والخميس)
        $pricePerSession = $subscription->price; // السعر لكل حصة

        // حساب إجمالي عدد الحصص (كل أسبوع يحتوي على 3 حصص)
        $totalSessions = $weeklySessions * 4; // نفترض أن كل شهر يحتوي على 4 أسابيع
        $totalPrice = $totalSessions * $pricePerSession;

        return view('subscriptions.subscriptionPayment', [
            'subscription' => $subscription,
            'pet' => $pet,
            'sessionTime' => $request->session_time,
            'selectedMonth' => $selectedMonth,
            'selectedWeek' => $selectedWeek,
            'totalPrice' => $totalPrice,
        ]);
    }

    public function processPayment(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $validated = $request->validate([
            'card_number' => 'required|digits:16',
            'cardholder_name' => 'required|string|max:255',
            'expiry_date' => 'required|regex:/^\d{2}\/\d{2}$/',
            'cvv' => 'required|digits:3',
        ]);

        // استخراج الشهر كرقم من "selected_month" الذي يكون بتنسيق "YYYY-MM"
        $month = (int) \Carbon\Carbon::parse($request->selected_month)->format('m');

        // إنشاء الاشتراك في قاعدة البيانات بعد نجاح الدفع
        AnimalSubscription::create([
            'subscription_id' => $request->subscription_id,
            'pet_id' => $request->pet_id,
            'session_time' => $request->session_time,
            'month' => $month, // تخزين الشهر كرقم بين 1 و 12
            'week_number' => $request->selected_week,
        ]);

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->route('profile')->with('success', 'Subscription completed successfully!');
    }

    public function showSubscriptions()
{
    // Ensure the user is authenticated
    if (!auth()->check()) {
        return redirect()->route('login')->with('error', 'You need to log in first.');
    }

    // Get the current authenticated user's ID
    $userId = auth()->id();

    // Fetch the pets associated with the current user
    $pets = Pet::where('user_id', $userId)->pluck('id');

    // Fetch subscriptions associated with user's pets
    $subscriptions = AnimalSubscription::with(['subscription', 'pet'])
        ->whereIn('pet_id', $pets)
        ->get();

    // Pass the subscriptions to the view
    return view('subscriptions.UserSubscriptions', compact('subscriptions'));
}







}
