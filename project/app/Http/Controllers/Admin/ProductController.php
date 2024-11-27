<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Storage;


use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('Admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('Admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // احصل على اسم الملف الأصلي وقم بتوليد اسم فريد
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();

            // قم بنقل الصورة إلى مجلد التخزين (public/img/pets)
            $request->file('image')->move(public_path('img/products'), $imageName);

            // حفظ المسار بشكل صحيح في قاعدة البيانات
            $data['image'] = 'img/products/' . $imageName; // تم تعديل $validatedData إلى $data
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('Admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('Admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إن وجدت
            if (!empty($user->image) && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            // تخزين الصورة الجديدة في public/img/users
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('img/users'), $imageName);

            // تخزين مسار الصورة في قاعدة البيانات
            $data['image'] = 'img/users/' . $imageName;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
