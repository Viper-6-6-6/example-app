@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">➕ Create New Customer</h4>
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

                <form action="{{ route('customers.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">👤 Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter customer name"
                            value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">📧 Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter email"
                            value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">📞 Phone</label>
                        <input type="text" name="phone" class="form-control" placeholder="Enter phone number"
                            value="{{ old('phone') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">🏠 Address</label>
                        <textarea name="address" class="form-control" rows="3" placeholder="Enter address">{{ old('address') }}</textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('customers.index') }}" class="btn btn-secondary">⬅ Back</a>
                        <button type="submit" class="btn btn-success">💾 Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
