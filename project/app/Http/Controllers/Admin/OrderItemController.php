<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    // Display the list of order items for a specific order
    public function index(Order $order)
    {
        $orderItems = $order->orderItems()->with('product')->get();
        return view('Admin.order_items.index', compact('orderItems', 'order'));
    }

    // Show form for creating a new order item
    public function create(Order $order)
    {
        $products = Product::all(); // Retrieve all products for selection
        return view('Admin.order_items.create', compact('order', 'products'));
    }

    // Store the newly created order item
    public function store(Request $request, Order $order)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $orderItem = new OrderItem([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);

        $order->orderItems()->save($orderItem);

        return redirect()->route('admin.orders.order_items.index', $order->id)
            ->with('success', 'Order item added successfully.');
    }

    // Show form for editing an existing order item
    public function edit(Order $order, OrderItem $orderItem)
    {
        $products = Product::all(); // Retrieve all products for selection
        return view('Admin.order_items.edit', compact('order', 'orderItem', 'products'));
    }

    // Update the specified order item
    public function update(Request $request, Order $order, OrderItem $orderItem)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $orderItem->update([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('admin.orders.order_items.index', $order->id)
            ->with('success', 'Order item updated successfully.');
    }

    // Delete the specified order item
    public function destroy(Order $order, OrderItem $orderItem)
    {
        $orderItem->delete();
        return redirect()->route('admin.orders.order_items.index', $order->id)
            ->with('success', 'Order item deleted successfully.');
    }
}
