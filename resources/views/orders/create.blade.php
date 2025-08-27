@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm rounded-3">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0">Create New Order</h4>
        </div>
        <div class="card-body">

            {{-- Hiển thị lỗi --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('orders.store') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-6">
                    <label class="form-label">Date:</label>
                    <input type="date" name="date" value="{{ old('date') }}" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Customer:</label>
                    <select name="customer_id" class="form-select">
                        <option value="">-- Select Customer --</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" @selected(old('customer_id') == $customer->id)>
                                {{ $customer->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Product:</label>
                    <select name="product_id" class="form-select">
                        <option value="">-- Select Product --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" @selected(old('product_id') == $product->id)>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Amount:</label>
                    <input type="number" step="1" name="amount" value="{{ old('amount') }}" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Status:</label>
                    <select name="status" class="form-select">
                        <option value="delivered" @selected(old('status') == 'delivered')>Delivered</option>
                        <option value="received" @selected(old('status') == 'received')>Received</option>
                        <option value="processing" @selected(old('status') == 'processing')>Processing</option>
                    </select>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Save Order
                    </button>
                    <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
