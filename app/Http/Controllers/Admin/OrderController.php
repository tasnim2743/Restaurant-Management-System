<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Table;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['table', 'items.menuItem'])
            ->latest()
            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        $tables = Table::where('status', '!=', 'maintenance')->get();
        $menuItems = MenuItem::where('is_available', true)
            ->orderBy('category_id')
            ->get();

        return view('admin.orders.create', compact('tables', 'menuItems'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'table_id' => 'required|exists:tables,id',
            'items' => 'required|array|min:1',
            'items.*.menu_item_id' => 'required|exists:menu_items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string'
        ]);

        $order = Order::create([
            'table_id' => $validated['table_id'],
            'status' => 'ordered',
            'notes' => $validated['notes'] ?? null
        ]);

        foreach ($validated['items'] as $item) {
            $menuItem = MenuItem::find($item['menu_item_id']);
            $order->items()->create([
                'menu_item_id' => $menuItem->id,
                'quantity' => $item['quantity'],
                'price' => $menuItem->price
            ]);
        }

        $order->calculateTotal();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order created successfully');
    }

    public function show(Order $order)
    {
        $order->load(['table', 'items.menuItem']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:ordered,preparing,served,paid'
        ]);

        $order->update(['status' => $validated['status']]);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order status updated successfully');
    }
}
