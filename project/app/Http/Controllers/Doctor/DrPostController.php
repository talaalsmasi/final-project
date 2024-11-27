<?php
namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DrPostController extends Controller
{
    // عرض جميع البوستات الخاصة بالطبيب المسجل
    public function index()
    {
        // جلب بيانات المستخدم المسجل
        $doctor = Auth::user();

        // جلب جميع البوستات الخاصة بالطبيب
        $posts = Post::where('user_id', $doctor->id)->get();

        // عرض صفحة البوستات
        return view('doctor.posts.index', compact('posts'));
    }

    // عرض نموذج إضافة بوست جديد
    public function create()
    {
        return view('doctor.posts.create');
    }

    // حفظ البوست الجديد في قاعدة البيانات
    public function store(Request $request)
{
    $data = $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($request->hasFile('image')) {
        // إنشاء اسم فريد للصورة
        $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
        // نقل الصورة إلى مجلد التخزين
        $request->file('image')->move(public_path('img/posts'), $imageName);
        // تخزين مسار الصورة في البيانات
        $data['image'] = 'img/posts/' . $imageName;
    }

    // إضافة معلومات المستخدم
    $data['user_id'] = auth()->id();
    $data['likes'] = 0;

    // إنشاء البوست
    Post::create($data);

    // إعادة التوجيه مع رسالة نجاح
    return redirect()->route('doctor.posts.index')->with('success', 'Post created successfully.');
}


    // عرض نموذج تعديل بوست
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        // التحقق من أن المستخدم هو صاحب البوست
        if ($post->user_id != Auth::id()) {
            return redirect()->route('doctor.posts.index')->with('error', 'Unauthorized action.');
        }

        return view('doctor.posts.edit', compact('post'));
    }

    // تحديث بيانات البوست
    public function update(Request $request, $id)
{
    $post = Post::findOrFail($id);

    // التحقق من صحة البيانات المدخلة
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $post->title = $validatedData['title'];
    $post->content = $validatedData['content'];

    // التحقق من وجود صورة جديدة ورفعها
    if ($request->hasFile('image')) {
        // إنشاء اسم فريد للصورة الجديدة
        $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('img/posts'), $imageName);

        // تحديث مسار الصورة في البوست
        $post->image = 'img/posts/' . $imageName;
    }

    // حفظ التعديلات
    $post->save();

    // إعادة التوجيه مع رسالة نجاح
    return redirect()->route('doctor.posts.index')->with('success', 'Post updated successfully.');
}


    // حذف بوست
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // التحقق من أن المستخدم هو صاحب البوست
        if ($post->user_id != Auth::id()) {
            return redirect()->route('doctor.posts.index')->with('error', 'Unauthorized action.');
        }

        $post->delete();

        return redirect()->route('doctor.posts.index')->with('success', 'Post deleted successfully.');
    }

    public function show($id)
{
    // Find the post by ID or return a 404 error if not found
    $post = Post::findOrFail($id);

    // Check if the authenticated user is the owner of the post
    if ($post->user_id != Auth::id()) {
        return redirect()->route('doctor.posts.index')->with('error', 'Unauthorized action.');
    }

    // Return the view with the post data
    return view('doctor.posts.show', compact('post'));
}

}
