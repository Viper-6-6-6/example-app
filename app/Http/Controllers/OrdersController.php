<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;


class OrdersController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Order::class, 'order');
    }
    
    public function index(Request $request)
    {

        $query = Order::with(['customer', 'product']);


        if ($request->filled('customer_id')) {
            $query->where('customer_id', $request->customer_id);
        }

        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('sort_date')) {
            $query->orderBy('date', $request->sort_date);
        } else {
            $query->latest('date');
        }

        $orders = $query->paginate(10);

        // Lấy dữ liệu cho form filter
        $customers = Customer::all();
        $products = Product::all();

        return view('orders.index', compact('orders', 'customers', 'products'));
    }

    // Hiển thị form tạo mới
    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('orders.create', compact('customers', 'products'));
    }

    // Lưu order mới
    public function store(OrderRequest $request)
    {

        Order::create($request->validated());

        return redirect()->route('orders.index')
            ->with('success', 'Order created successfully.');
    }

    // Xem chi tiết order
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    // Hiển thị form sửa order
    public function edit(Order $order)
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('orders.edit', compact('order', 'customers', 'products'));
    }

    // Cập nhật order
    public function update(OrderRequest $request, Order $order)
    {
        $order->update($request->validated());

        return redirect()->route('orders.index')
            ->with('success', 'Xong');
    }

    // Xóa order
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Order deleted successfully.');
    }
}
