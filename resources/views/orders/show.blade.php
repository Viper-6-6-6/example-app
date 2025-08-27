@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm rounded-3">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0">Order Details #{{ $order->id }}</h4>
        </div>
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Date:</strong> {{ $order->date }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Amount:</strong> {{ $order->amount }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Customer:</strong> {{ $order->customer->name ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Product:</strong> {{ $order->product->name ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="mb-3">
                <p><strong>Status:</strong> 
                    @if($order->status == 'delivered')
                        <span class="badge bg-success">Delivered</span>
                    @elseif($order->status == 'received')
                        <span class="badge bg-primary">Received</span>
                    @elseif($order->status == 'processing')
                        <span class="badge bg-warning text-dark">Processing</span>
                    @else
                        <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                    @endif
                </p>
            </div>

            <div class="mt-4">
                <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back to list
                </a>
                <a href="{{ route('orders.edit', $order) }}" class="btn btn-warning">
                    <i class="bi bi-pencil-square"></i> Edit
                </a>
                <form action="{{ route('orders.destroy', $order) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" 
                            onclick="return confirm('Are you sure you want to delete this order?')">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
