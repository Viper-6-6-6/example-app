@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Customers List</h3>
            <a href="{{ route('customers.create') }}" class="btn btn-primary">+ Add Customer</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- 🔍 Bộ lọc tìm kiếm --}}
        <div class="card shadow mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0 ">🔍 Search Customers</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('customers.index') }}" class="row g-3">

                    <div class="col-md-3">
                        <input type="text" name="name" class="form-control" placeholder="Search by name"
                            value="{{ request('name') }}">
                    </div>

                    <div class="col-md-3">
                        <input type="email" name="email" class="form-control" placeholder="Search by email"
                            value="{{ request('email') }}">
                    </div>

                    <div class="col-md-3">
                        <input type="text" name="phone" class="form-control" placeholder="Search by phone"
                            value="{{ request('phone') }}">
                    </div>

                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">🔎 Filter</button>
                        <a href="{{ route('customers.index') }}" class="btn btn-secondary">❌ Reset</a>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered table-striped shadow-sm">
            <thead class="table-info">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th width="450px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>
                            <a href="{{ route('customers.show', $customer) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('customers.edit', $customer) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('customers.destroy', $customer) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                            <a href="{{ route('customers.sendWelcomeEmail', $customer) }}" class="btn btn-sm btn-primary">Send Welcome Email</a>
                            <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                data-bs-target="#emailModal{{ $customer->id }}">
                                Send Email
                            </button>
                            <div class="modal fade" id="emailModal{{ $customer->id }}" tabindex="-1"
                                aria-labelledby="emailModalLabel{{ $customer->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form method="POST" action="{{ route('customers.sendEmail', $customer->id) }}">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="emailModalLabel{{ $customer->id }}">Send Email
                                                    to {{ $customer->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Subject</label>
                                                    <input type="text" name="subject" class="form-control" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Message</label>
                                                    <textarea name="message" class="form-control" rows="4" required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Send Email</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>


                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No customers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-3">
            {{ $customers->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
