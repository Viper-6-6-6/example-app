@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0">👤 Customer Details</h4>
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $customer->id }}</p>
            <p><strong>Name:</strong> {{ $customer->name }}</p>
            <p><strong>Email:</strong> {{ $customer->email }}</p>
            <p><strong>Phone:</strong> {{ $customer->phone }}</p>
            <p><strong>Address:</strong> {{ $customer->address }}</p>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('customers.index') }}" class="btn btn-secondary">⬅ Back</a>
            <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning">✏️ Edit</a>
        </div>
    </div>
</div>
@endsection
