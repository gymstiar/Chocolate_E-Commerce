@extends('layouts.seller')

@section('title', 'Categories - ChocoLuxe Seller')

@section('content')
<section class="py-4" style="background: linear-gradient(135deg, var(--chocolate-dark) 0%, var(--chocolate-medium) 100%);">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="text-white mb-0" style="font-family: 'Playfair Display', serif;">
                <i class="bi bi-grid me-2" style="color: var(--chocolate-gold);"></i>Categories
            </h2>
            <a href="{{ route('seller.categories.create') }}" class="btn btn-gold">
                <i class="bi bi-plus-circle me-2"></i>Add Category
            </a>
        </div>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <div class="row g-4">
            @forelse($categories as $category)
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <div class="card card-chocolate h-100">
                    @if($category->image)
                    <img src="{{ asset('storage/' . $category->image) }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                    @else
                    <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 150px; background: var(--chocolate-cream);">
                        <i class="bi bi-grid display-1" style="color: var(--chocolate-light);"></i>
                    </div>
                    @endif
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="card-title mb-1">{{ $category->name }}</h5>
                                <span class="badge {{ $category->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $category->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                            <span class="badge badge-gold">{{ $category->products_count }} products</span>
                        </div>
                        @if($category->description)
                        <p class="text-muted small mt-2 mb-0">{{ Str::limit($category->description, 80) }}</p>
                        @endif
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="btn-group w-100">
                            <a href="{{ route('seller.categories.edit', $category) }}" class="btn btn-outline-chocolate">
                                <i class="bi bi-pencil me-1"></i>Edit
                            </a>
                            <form action="{{ route('seller.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this category?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" {{ $category->products_count > 0 ? 'disabled' : '' }}>
                                    <i class="bi bi-trash me-1"></i>Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-grid display-1 text-muted"></i>
                <p class="text-muted mt-3">No categories yet</p>
                <a href="{{ route('seller.categories.create') }}" class="btn btn-chocolate">Add First Category</a>
            </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $categories->links() }}
        </div>
    </div>
</section>
@endsection
