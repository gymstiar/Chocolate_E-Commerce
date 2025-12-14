@extends('layouts.seller')

@section('title', 'Products Report - ChocoLuxe Seller')

@section('content')
<section class="py-4" style="background: linear-gradient(135deg, var(--chocolate-dark) 0%, var(--chocolate-medium) 100%);">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="{{ route('seller.reports.index') }}" class="text-white text-decoration-none">Reports</a></li>
                <li class="breadcrumb-item active text-white-50">Products</li>
            </ol>
        </nav>
        <h2 class="text-white mb-0" style="font-family: 'Playfair Display', serif;">
            <i class="bi bi-box-seam me-2" style="color: var(--chocolate-gold);"></i>Products Report
        </h2>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <!-- Date Filter -->
        <div class="card card-chocolate mb-4" data-aos="fade-up">
            <div class="card-body">
                <form action="{{ route('seller.reports.products') }}" method="GET" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">Start Date</label>
                        <input type="date" name="start_date" class="form-control form-control-chocolate" value="{{ $startDate }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">End Date</label>
                        <input type="date" name="end_date" class="form-control form-control-chocolate" value="{{ $endDate }}">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-chocolate"><i class="bi bi-filter me-1"></i>Apply</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Products Table -->
        <div class="card card-chocolate" data-aos="fade-up">
            <div class="card-header bg-transparent">
                <h5 class="mb-0"><i class="bi bi-star me-2" style="color: var(--chocolate-gold);"></i>Top Selling Products</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Unit Price</th>
                                <th>Qty Sold</th>
                                <th>Revenue</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($topProducts as $index => $product)
                            <tr>
                                <td>{{ $topProducts->firstItem() + $index }}</td>
                                <td>
                                    <strong>{{ $product->name }}</strong>
                                    @if($product->is_featured)
                                    <span class="badge badge-gold ms-1">Featured</span>
                                    @endif
                                </td>
                                <td>{{ $product->category->name ?? '-' }}</td>
                                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td><span class="badge bg-success">{{ $product->total_sold }}</span></td>
                                <td class="fw-semibold" style="color: var(--chocolate-gold);">Rp {{ number_format($product->total_revenue, 0, ',', '.') }}</td>
                                <td>
                                    @if($product->stock <= 0)
                                        <span class="badge bg-danger">Out</span>
                                    @elseif($product->stock <= 10)
                                        <span class="badge bg-warning text-dark">{{ $product->stock }}</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $product->stock }}</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="7" class="text-center py-4 text-muted">No sales data</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $topProducts->links() }}
        </div>
    </div>
</section>
@endsection
