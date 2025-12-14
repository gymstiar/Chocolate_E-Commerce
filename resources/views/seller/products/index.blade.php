@extends('layouts.seller')

@section('title', 'Products - ChocoLuxe Seller')

@section('content')
<section class="py-4" style="background: linear-gradient(135deg, var(--chocolate-dark) 0%, var(--chocolate-medium) 100%);">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h2 class="text-white mb-0" style="font-family: 'Playfair Display', serif;">
                <i class="bi bi-box-seam me-2" style="color: var(--chocolate-gold);"></i>Products
            </h2>
            {{-- <a href="{{ route('seller.products.create') }}" class="btn btn-gold">
                <i class="bi bi-plus-circle me-2"></i>Add Product
            </a> --}}
        </div>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <!-- Filters -->
        <div class="card card-chocolate mb-4" data-aos="fade-up">
            <div class="card-body">
                <form action="{{ route('seller.products.index') }}" method="GET" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">Search</label>
                        <input type="text" name="search" class="form-control form-control-chocolate" placeholder="Product name..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Category</label>
                        <select name="category" class="form-select form-control-chocolate">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select form-control-chocolate">
                            <option value="">All</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-chocolate me-2"><i class="bi bi-search me-1"></i>Filter</button>
                        <a href="{{ route('seller.products.index') }}" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Products Table -->
        <div class="card card-chocolate" data-aos="fade-up">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                            <tr>
                                <td>
                                    @if($product->primaryImage)
                                        <img src="{{ asset('storage/' . $product->primaryImage->image) }}" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <img src="https://images.unsplash.com/photo-1549007994-cb92caebd54b?w=100" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $product->name }}</strong>
                                    @if($product->is_featured)
                                    <span class="badge badge-gold ms-1">Featured</span>
                                    @endif
                                    <br><small class="text-muted">{{ $product->chocolate_type }}</small>
                                </td>
                                <td>{{ $product->category->name ?? '-' }}</td>
                                <td>
                                    @if($product->sale_price)
                                        <span class="text-decoration-line-through text-muted small">Rp {{ number_format($product->price, 0, ',', '.') }}</span><br>
                                        <span class="fw-bold" style="color: var(--chocolate-gold);">Rp {{ number_format($product->sale_price, 0, ',', '.') }}</span>
                                    @else
                                        <span class="fw-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($product->stock <= 0)
                                        <span class="badge bg-danger">Out of Stock</span>
                                    @elseif($product->stock <= 10)
                                        <span class="badge bg-warning text-dark">{{ $product->stock }} left</span>
                                    @else
                                        <span class="badge bg-success">{{ $product->stock }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($product->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('seller.products.edit', $product) }}" class="btn btn-outline-chocolate" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="{{ route('products.show', $product->slug) }}" target="_blank" class="btn btn-outline-secondary" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <form action="{{ route('seller.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Delete this product?')" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="bi bi-box-seam display-4 text-muted"></i>
                                    <p class="text-muted mt-3">No products yet</p>
                                    <a href="{{ route('seller.products.create') }}" class="btn btn-chocolate">Add First Product</a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $products->links() }}
        </div>
    </div>
</section>
@endsection
