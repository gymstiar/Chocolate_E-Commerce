@extends('layouts.seller')

@section('title', 'Edit Category - ChocoLuxe Seller')

@section('content')
<section class="py-4" style="background: linear-gradient(135deg, var(--chocolate-dark) 0%, var(--chocolate-medium) 100%);">
    <div class="container">
        <h2 class="text-white mb-0" style="font-family: 'Playfair Display', serif;">
            <i class="bi bi-pencil me-2" style="color: var(--chocolate-gold);"></i>Edit Category
        </h2>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6" data-aos="fade-up">
                <div class="card card-chocolate">
                    <div class="card-body p-4">
                        <form action="{{ route('seller.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @if($category->image)
                            <div class="text-center mb-3">
                                <img src="{{ asset('storage/' . $category->image) }}" class="img-fluid rounded" style="max-height: 150px;">
                            </div>
                            @endif
                            <div class="mb-3">
                                <label class="form-label">Category Name</label>
                                <input type="text" name="name" class="form-control form-control-chocolate @error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control form-control-chocolate" rows="3">{{ old('description', $category->description) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" name="image" class="form-control form-control-chocolate" accept="image/*">
                                <small class="text-muted">Leave empty to keep current image</small>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label class="form-label">Sort Order</label>
                                    <input type="number" name="sort_order" class="form-control form-control-chocolate" value="{{ old('sort_order', $category->sort_order) }}" min="0">
                                </div>
                                <div class="col-6 d-flex align-items-end">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Active</label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-chocolate btn-lg">
                                    <i class="bi bi-check-circle me-2"></i>Update Category
                                </button>
                                <a href="{{ route('seller.categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
