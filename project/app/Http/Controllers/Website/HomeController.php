<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Rating;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Post;
use App\Models\Pet;
use App\Models\Faq;
use App\Models\Product;
use App\Models\Doctor;
use App\Models\ContactMessage;





class HomeController extends Controller
{
    public function index()
    {
        // استرداد التقييمات مع تفاصيل المستخدم
        $ratings = Rating::with('user')->get(); // تأكد من وجود العلاقة المناسبة في النموذج

        // استرداد جميع الحيوانات
        $pets = Pet::take(12)->get();

        $doctors = Doctor::with('user')->get();

        $usersCount = User::count();

        // استرجاع عدد الأطباء
        $doctorsCount = Doctor::count();

        // استرجاع عدد الحيوانات الأليفة
        $petsCount = Pet::count();

        $faqs = Faq::orderBy('id', 'asc')->get();
        // استرجاع عدد المنتجات
        $productsCount = Product::count();
        $cartCount = session()->has('cart') ? count(session('cart')) : 0;
        $wishlistCount = session()->has('wishlist') ? count(session('wishlist')) : 0;

        // استرداد البوستات مع تفاصيل المستخدم، والطلب من الأحدث إلى الأقدم
        $posts = Post::with('user')->latest()->get(); // تأكد من وجود العلاقة المناسبة في النموذج

        // تمرير البيانات إلى الـ View
        return view('index', compact('ratings', 'posts', 'pets','doctors','usersCount', 'doctorsCount', 'petsCount', 'productsCount','cartCount', 'wishlistCount','faqs'));
    }


    public function showFeedback()
    {
        // استرداد التقييمات مع تفاصيل المستخدم
        $ratings = Rating::with('user')->get();

        return view('home.feedback', compact('ratings'));
    }


    public function showGallery()
    {
        // جلب 11 صورة بشكل عشوائي من جدول pets
        $pets = Pet::inRandomOrder()->take(11)->get();
        return view('gallery', compact('pets'));
    }
    public function showContact()
    {
        return view('home.contactus');
    }

    public function store(Request $request)
    {
        // تحقق من صحة البيانات
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // حفظ الرسالة في قاعدة البيانات
        ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        // إعادة توجيه مع رسالة نجاح
        return redirect()->back()->with('success', 'Message sent successfully!');
    }
    public function showHeader()
{
    $cartCount = session()->has('cart') ? count(session('cart')) : 0;
    $wishlistCount = session()->has('wishlist') ? count(session('wishlist')) : 0;

    return view('layouts.header', compact('cartCount', 'wishlistCount'));
}






}
