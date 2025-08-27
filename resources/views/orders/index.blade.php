@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3">Orders List</h1>
            <a href="{{ route('orders.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Create New Order
            </a>
        </div>

        {{-- Hiển thị thông báo thành công --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Form lọc -->
    <form method="GET" action="{{ route('orders.index') }}" class="row g-3 mb-4">
        <div class="col-md-3">
            <label class="form-label">Customer</label>
            <select name="customer_id" class="form-select">
                <option value="">-- All --</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" @selected(request('customer_id') == $customer->id)>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="form-label">Product</label>
            <select name="product_id" class="form-select">
                <option value="">-- All --</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" @selected(request('product_id') == $product->id)>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="">-- All --</option>
                <option value="processing" @selected(request('status')=='processing')>Processing</option>
                <option value="received" @selected(request('status')=='received')>Received</option>
                <option value="delivered" @selected(request('status')=='delivered')>Delivered</option>
            </select>
        </div>

        <div class="col-md-2">
            <label class="form-label">Sort by Date</label>
            <select name="sort_date" class="form-select">
                <option value="">Default</option>
                <option value="asc" @selected(request('sort_date')=='asc')>Oldest first</option>
                <option value="desc" @selected(request('sort_date')=='desc')>Newest first</option>
            </select>
        </div>

        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-pink w-100">Filter</button>
        </div>
    </form>

        {{-- Bảng danh sách đơn hàng --}}
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th class="text-center" width="180px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->date }}</td>
                                <td>{{ $order->customer->name ?? 'N/A' }}</td>
                                <td>{{ $order->product->name ?? 'N/A' }}</td>
                                <td>{{ number_format($order->amount, 0, ',', '.') }}</td>
                                <td>
                                    @switch($order->status)
                                        @case('delivered')
                                            <span class="badge bg-success">Delivered</span>
                                        @break

                                        @case('received')
                                            <span class="badge bg-primary">Received</span>
                                        @break

                                        @case('processing')
                                            <span class="badge bg-warning text-dark">Processing</span>
                                        @break

                                        @default
                                            <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                                    @endswitch
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('orders.edit', $order) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('orders.destroy', $order) }}" method="POST"
                                        style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this order?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No orders found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="d-flex justify-content-center mt-3">
                {{ $orders->links() }}
            </div>

        </div>
    @endsection

