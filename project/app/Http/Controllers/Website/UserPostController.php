<?php
namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;


class UserPostController extends Controller
{
    public function index()
    {
        // استرداد جميع البوستات مرتبة من الأحدث إلى الأقدم
        $posts = Post::with('user')->orderBy('created_at', 'desc')->get(); // ترتيب البوستات
        return view('posts.posts', compact('posts')); // عرض البوستات في الصفحة
    }


    public function showUserPosts($id)
{
    // Retrieve the user and their posts
    $user = User::with('posts')->findOrFail($id); // Ensure the user exists

    return view('posts.userPosts', compact('user')); // Pass user data to a new view
}
public function like(Post $post)
{
    // قم بزيادة عدد الإعجابات
    $post->increment('likes');

    // أعد التوجيه إلى الصفحة السابقة
    return redirect()->back();
}
}
