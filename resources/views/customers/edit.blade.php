@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">✏️ Edit Customer</h4>
            </div>
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Oops!</strong> Please check the errors below:
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('customers.update', $customer) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">👤 Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $customer->name) }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">📧 Email</label>
                        <input type="email" name="email" class="form-control"
                            value="{{ old('email', $customer->email) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">📞 Phone</label>
                        <input type="text" name="phone" class="form-control"
                            value="{{ old('phone', $customer->phone) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">🏠 Address</label>
                        <textarea name="address" class="form-control" rows="3">{{ old('address', $customer->address) }}</textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('customers.index') }}" class="btn btn-secondary">⬅ Back</a>
                        <button type="submit" class="btn btn-primary">💾 Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
