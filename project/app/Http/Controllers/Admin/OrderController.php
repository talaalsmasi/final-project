<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Display all orders
    public function index()
    {
        $orders = Order::with('user')->get();
        return view('Admin.orders.index', compact('orders'));
    }

    // Show form for creating a new order
    public function create()
    {
        $users = User::all();
        return view('Admin.orders.create', compact('users'));
    }

    // Store a new order
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'total_price' => 'required|numeric',
            'status' => 'required|in:pending,completed,cancelled',
            'payment_method' => 'required|string',
            'address' => 'required|string',
        ]);

        Order::create($data);

        return redirect()->route('admin.orders.index')->with('success', 'Order created successfully.');
    }

    // Show details of a specific order
    public function show(Order $order)
    {
        return view('Admin.orders.show', compact('order'));
    }

    // Show form for editing an order
    public function edit(Order $order)
    {
        $users = User::all();
        return view('Admin.orders.edit', compact('order', 'users'));
    }

    // Update an existing order
    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'total_price' => 'required|numeric',
            'status' => 'required|in:pending,completed,cancelled',
            'payment_method' => 'required|string',
            'address' => 'required|string',
        ]);

        $order->update($data);

        return redirect()->route('admin.orders.index')->with('success', 'Order updated successfully.');
    }

    // Delete an order
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully.');
    }
}
