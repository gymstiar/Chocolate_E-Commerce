@extends('layouts.seller')

@section('title', 'Customers - ChocoLuxe Seller')

@section('content')
<section class="py-4" style="background: linear-gradient(135deg, var(--chocolate-dark) 0%, var(--chocolate-medium) 100%);">
    <div class="container">
        <h2 class="text-white mb-0" style="font-family: 'Playfair Display', serif;">
            <i class="bi bi-people me-2" style="color: var(--chocolate-gold);"></i>Customers
        </h2>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <!-- Search -->
        <div class="card card-chocolate mb-4" data-aos="fade-up">
            <div class="card-body">
                <form action="{{ route('seller.customers.index') }}" method="GET" class="row g-3">
                    <div class="col-md-6">
                        <input type="text" name="search" class="form-control form-control-chocolate" placeholder="Search by name or email..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-chocolate"><i class="bi bi-search me-1"></i>Search</button>
                        <a href="{{ route('seller.customers.index') }}" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Customers Table -->
        <div class="card card-chocolate" data-aos="fade-up">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Customer</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Orders</th>
                                <th>Total Spent</th>
                                <th>Joined</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($customers as $customer)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($customer->avatar)
                                            <img src="{{ asset('storage/' . $customer->avatar) }}" class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                        @else
                                            <div class="rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px; background: var(--chocolate-light); color: white;">
                                                {{ strtoupper(substr($customer->name, 0, 1)) }}
                                            </div>
                                        @endif
                                        <strong>{{ $customer->name }}</strong>
                                    </div>
                                </td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone ?? '-' }}</td>
                                <td><span class="badge badge-gold">{{ $customer->orders_count }}</span></td>
                                <td class="fw-semibold">Rp {{ number_format($customer->total_spent, 0, ',', '.') }}</td>
                                <td>{{ $customer->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('seller.customers.show', $customer) }}" class="btn btn-sm btn-outline-chocolate">
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="bi bi-people display-4 text-muted"></i>
                                    <p class="text-muted mt-3">No customers yet</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $customers->links() }}
        </div>
    </div>
</section>
@endsection
