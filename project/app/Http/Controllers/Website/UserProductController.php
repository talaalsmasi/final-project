<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Category;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    // عرض جميع المنتجات
    public function showProducts(Request $request)
    {
        $query = Product::query();

        // فلترة حسب الفئة
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // فلترة حسب نطاق السعر
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // استرجاع المنتجات مع التصفح (pagination) مع تمرير الفلاتر في الصفحات اللاحقة
        $products = $query->paginate(9)->appends(request()->query());
        // استرجاع الفئات لعرضها في نموذج الفلترة
        $categories = Category::all();

        return view('products.showProduct', compact('products', 'categories'));
    }

    // عرض منتج واحد
    public function showProduct($id)
{
    $product = Product::findOrFail($id); // جلب المنتج من قاعدة البيانات باستخدام المعرف

    return view('products.singleProduct', compact('product')); // عرض تفاصيل المنتج
}




    // إضافة منتج إلى السلة
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
                'image' => $product->image
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('products.showProducts')->with('success', 'Product added to cart successfully!');
    }

    // عرض السلة
    public function showCart()
    {
        $cart = session()->get('cart');

        // Check if the cart is empty
        if (!$cart) {
            return view('products.cart', ['cart' => [], 'totalPrice' => 0]); // Empty cart scenario
        }

        // Calculate the total price of the cart
        $totalPrice = 0;
        foreach ($cart as $id => $details) {
            $totalPrice += $details['price'] * $details['quantity'];
        }

        // Check if a coupon is applied and subtract the discount from the total price
        if (session()->has('coupon')) {
            $discount = session('coupon')['discount'];
            $totalPrice -= $discount;  // Apply the discount to the total price
        }

        // Pass the cart, total price, and coupon information (if exists) to the view
        return view('products.cart', [
            'cart' => $cart,
            'totalPrice' => $totalPrice,
            'coupon' => session('coupon') ?? null // Pass coupon if it exists
        ]);
    }



    // إزالة منتج من السلة
    public function removeFromCart($id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.show')->with('success', 'Product removed from cart successfully!');
    }

    // عرض صفحة الدفع (checkout)
    public function showCheckout()
    {
        // التحقق مما إذا كان المستخدم مسجل الدخول
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You need to log in to proceed to checkout.');
        }

        // جلب محتويات السلة من الجلسة
        $cart = session()->get('cart');


        // إذا كانت السلة فارغة
        if (!$cart) {
            return redirect()->route('cart.show')->with('error', 'Your cart is empty.');
        }

        // حساب إجمالي السعر
        $totalPrice = 0;
        foreach ($cart as $id => $details) {
            $totalPrice += $details['price'] * $details['quantity'];
        }

        return view('products.checkout', compact('cart', 'totalPrice'));
    }

    // صفحة الدفع (checkout) وتخزين الطلب
    public function checkout(Request $request)
    {
        $cart = session()->get('cart');


        if (!$cart) {
            return redirect()->route('cart.show')->with('error', 'Your cart is empty.');
        }

        // Validation rules
        $validatedData = $request->validate([
            // 'address' => 'required|string|max:255',
            // 'city' => 'required|string|max:255',
            // 'payment_method' => 'required|in:cash,visa',
            // Visa-specific fields
            // 'card_number' => 'required_if:payment_method,visa|nullable|digits:16',
            // 'expiry_date' => 'required_if:payment_method,visa|nullable|regex:/^(0[1-9]|1[0-2])\/([0-9]{2})$/',
            // 'cvv' => 'required_if:payment_method,visa|nullable|digits:3',
        ]);

        // حساب إجمالي السعر
        $totalPrice = 0;
        foreach ($cart as $id => $details) {
            $totalPrice += $details['price'] * $details['quantity'];
        }
        // dd($request->all());

        // dd($request->all()); // تحقق مما إذا كانت قيمة payment_method موجودة

        // إنشاء الطلب في جدول orders
        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => $totalPrice,
            'status' => 'pending',
            'payment_method' => $request->payment_method, // تأكد من أنك تستخدم هذه القيمة
            'address' => $request->address,
        ]);


        // تخزين المنتجات الخاصة بالطلب في جدول order_items
        foreach ($cart as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $details['quantity'],
            ]);

            // تقليل الكمية المتاحة في المخزون
            $product = Product::find($id);
            if ($product) {
                $product->stock_quantity -= $details['quantity'];
                $product->save(); // حفظ التغييرات في المخزون
            }
        }

        // تفريغ السلة بعد إتمام الطلب
        session()->forget('cart');

        return redirect()->route('profile')->with('success', 'Order placed successfully!');
    }



    public function increaseQuantity($id)
{
    $cart = session()->get('cart');

    if (isset($cart[$id])) {
        $cart[$id]['quantity']++;
        session()->put('cart', $cart);
    }

    return redirect()->route('cart.show')->with('success', 'Product quantity increased successfully!');
}

public function calculateCartTotal()
{
    $cart = session()->get('cart', []);
    $total = 0;

    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    return $total;
}
public function applyCoupon(Request $request)
{
    $coupon = Coupon::where('code', $request->coupon_code)
                    ->where('is_active', true)
                    ->where('expires_at', '>=', now())
                    ->first();

    if (!$coupon) {
        return back()->with('error', 'Invalid or expired coupon.');
    }

    $cartTotal = $this->calculateCartTotal();
    $discount = 0;

    if ($coupon->discount_type == 'percentage') {
        $discount = ($coupon->discount / 100) * $cartTotal;
    } elseif ($coupon->discount_type == 'fixed') {
        $discount = $coupon->discount;
    }

    // Save coupon data to session
    session()->put('coupon', [
        'code' => $coupon->code,
        'discount' => $discount,
    ]);

    // Debugging the session data

    return back()->with('success', 'Coupon applied successfully!');
}



public function decreaseQuantity($id)
{
    $cart = session()->get('cart');

    if (isset($cart[$id])) {
        if ($cart[$id]['quantity'] > 1) {
            // Decrease quantity by 1
            $cart[$id]['quantity']--;
            session()->put('cart', $cart);
        } else {
            // Remove the item from cart if quantity is 1
            unset($cart[$id]);
            session()->put('cart', $cart); // Update the session with the new cart
        }
    }

    return redirect()->route('cart.show')->with('success', 'Product quantity decreased successfully!');
}

public function addToWishlist($productId)
{
    $wishlist = session()->get('wishlist', []);

    // Check if the product is already in the wishlist
    if (!in_array($productId, $wishlist)) {
        $wishlist[] = $productId;
        session()->put('wishlist', $wishlist);
        return redirect()->back()->with('success', 'Product added to wishlist!');
    }

    return redirect()->back()->with('info', 'Product is already in your wishlist.');
}

// Show wishlist
public function showWishlist()
{
    $wishlist = session()->get('wishlist', []);
    $products = Product::whereIn('id', $wishlist)->get();

    return view('products.wishList', compact('products'));
}

// Remove product from wishlist
public function removeFromWishlist($productId)
{
    $wishlist = session()->get('wishlist', []);

    // Remove product from wishlist
    if (($key = array_search($productId, $wishlist)) !== false) {
        unset($wishlist[$key]);
        session()->put('wishlist', $wishlist);
        return redirect()->back()->with('success', 'Product removed from wishlist!');
    }

    return redirect()->back()->with('info', 'Product not found in your wishlist.');
}

public function showUserOrders()
{
    // Get all orders for the authenticated user
    $orders = Order::where('user_id', auth()->id())->get();

    // Initialize an array to store the order details and related items
    $orderDetails = [];

    // Loop through each order and get its items
    foreach ($orders as $order) {
        $items = OrderItem::where('order_id', $order->id)->with('product')->get(); // Get order items and their products

        // Add the order and its items to the orderDetails array
        $orderDetails[] = [
            'order' => $order,
            'items' => $items
        ];
    }

    // Pass the order details (with items) to the view
    return view('products.ShowOrders', ['orders' => $orderDetails]);
}





}
