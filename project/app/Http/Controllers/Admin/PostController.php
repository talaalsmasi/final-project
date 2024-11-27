<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // عرض قائمة المنشورات
    public function index()
    {
        $posts = Post::all();
        return view('Admin.posts.index', compact('posts'));
    }

    // عرض صفحة إنشاء منشور جديد
    public function create()
    {
        return view('Admin.posts.create');
    }

    // تخزين المنشور الجديد في قاعدة البيانات
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('img/posts'), $imageName);
            $data['image'] = 'img/posts/' . $imageName;
        }

        $data['user_id'] = auth()->id();
        $data['likes'] = 0;

        Post::create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully.');
    }

    // عرض صفحة تعديل منشور
    public function edit(Post $post)
    {
        return view('Admin.posts.edit', compact('post'));
    }

    // تحديث بيانات المنشور في قاعدة البيانات
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if (!empty($post->image) && file_exists(public_path($post->image))) {
                unlink(public_path($post->image));
            }

            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('img/posts'), $imageName);
            $data['image'] = 'img/posts/' . $imageName;
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully.');
    }

    // حذف منشور من قاعدة البيانات
    public function destroy(Post $post)
    {
        if (!empty($post->image) && file_exists(public_path($post->image))) {
            unlink(public_path($post->image));
        }

        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully.');
    }
}
