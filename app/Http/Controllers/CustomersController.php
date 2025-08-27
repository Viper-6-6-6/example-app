<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CustomersController extends Controller
{
    // Hiển thị danh sách customers
    // public function index()
    // {
    //     $customers = Customer::orderBy('id', 'desc')->paginate(10);
    //     return view('customers.index', compact('customers'));
    // }

    public function index(Request $request)
    {
        $query = Customer::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }

        $customers = $query->latest()->paginate(10)->appends($request->all());

        return view('customers.index', compact('customers'));
    }

    // Hiển thị form tạo mới customer
    public function create()
    {
        return view('customers.create');
    }

    // Lưu customer mới
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'email'   => 'required|email|unique:customers,email',
            'phone'   => 'nullable|int|unique:customers,phone',
        ]);

        Customer::create($request->all());

        return redirect()->route('customers.index')
            ->with('success', 'Customer created successfully.');
    }

    // Xem chi tiết customer
    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    // Hiển thị form sửa customer
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    // Cập nhật customer
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'email'   => 'required|email|unique:customers,email,' . $customer->id,
            'phone'   => 'nullable|int|unique:customers,phone,' . $customer->id,
        ]);

        $customer->update($request->all());

        return redirect()->route('customers.index')
            ->with('success', 'Customer updated successfully.');
    }

    // Xóa customer
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')
            ->with('success', 'Customer deleted successfully.');
    }



    public function sendEmail(Request $request, Customer $customer)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Gửi email
        Mail::raw($request->message, function ($mail) use ($customer, $request) {
            $mail->to([$customer->email,'accchuyensanxuatda@gmail.com'])
                ->subject($request->subject);
        });

        return redirect()->route('customers.index')->with('success', 'Email sent to ' . $customer->name);
    }
}
