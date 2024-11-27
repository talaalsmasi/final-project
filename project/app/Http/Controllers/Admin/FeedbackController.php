<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    // عرض جميع التقييمات
    public function index()
    {
        $ratings = Rating::all();
        return view('admin.ratings.index', compact('ratings'));
    }

    // عرض صفحة إنشاء تقييم جديد
    public function create()
    {
        return view('admin.ratings.create');
    }

    // تخزين تقييم جديد
    public function store(Request $request)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'nullable|string',
            'booking_id' => 'nullable|exists:bookings,id',
            'appointment_id' => 'nullable|exists:appointments,id',
            'brooming_id' => 'nullable|exists:broomings,id',
        ]);

        // إنشاء التقييم
        Rating::create($request->all());

        return redirect()->route('ratings.index')->with('success', 'Rating created successfully.');
    }

    // عرض صفحة تعديل تقييم
    public function edit(Rating $rating)
    {
        return view('admin.ratings.edit', compact('rating'));
    }

    // تحديث تقييم موجود
    public function update(Request $request, Rating $rating)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'nullable|string',
            'booking_id' => 'nullable|exists:bookings,id',
            'appointment_id' => 'nullable|exists:appointments,id',
            'brooming_id' => 'nullable|exists:broomings,id',
        ]);

        // تحديث التقييم
        $rating->update($request->all());

        return redirect()->route('ratings.index')->with('success', 'Rating updated successfully.');
    }

    // حذف تقييم
    public function destroy(Rating $rating)
    {
        $rating->delete();
        return redirect()->route('ratings.index')->with('success', 'Rating deleted successfully.');
    }

    public function show(Rating $rating)
    {
        // عرض تفاصيل التقييم في صفحة show
        return view('admin.ratings.show', compact('rating'));
    }
}
