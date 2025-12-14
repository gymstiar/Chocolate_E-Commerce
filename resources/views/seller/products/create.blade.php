@extends('layouts.seller')

@section('title', 'Add Product - ChocoLuxe Seller')

@section('content')
<section class="py-4" style="background: linear-gradient(135deg, var(--chocolate-dark) 0%, var(--chocolate-medium) 100%);">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="{{ route('seller.products.index') }}" class="text-white text-decoration-none">Products</a></li>
                <li class="breadcrumb-item active text-white-50">Add Product</li>
            </ol>
        </nav>
        <h2 class="text-white mb-0" style="font-family: 'Playfair Display', serif;">
            <i class="bi bi-plus-circle me-2" style="color: var(--chocolate-gold);"></i>Add New Product
        </h2>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-8" data-aos="fade-right">
                    <!-- Basic Info -->
                    <div class="card card-chocolate mb-4">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0"><i class="bi bi-info-circle me-2" style="color: var(--chocolate-gold);"></i>Basic Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label class="form-label">Product Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control form-control-chocolate @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Category <span class="text-danger">*</span></label>
                                    <select name="category_id" class="form-select form-control-chocolate @error('category_id') is-invalid @enderror" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Short Description</label>
                                    <input type="text" name="short_description" class="form-control form-control-chocolate" value="{{ old('short_description') }}" maxlength="255">
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Full Description</label>
                                    <textarea name="description" class="form-control form-control-chocolate" rows="5">{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Chocolate Details -->
                    <div class="card card-chocolate mb-4">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0"><i class="bi bi-stars me-2" style="color: var(--chocolate-gold);"></i>Chocolate Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Chocolate Type <span class="text-danger">*</span></label>
                                    <select name="chocolate_type" class="form-select form-control-chocolate" required>
                                        <option value="dark" {{ old('chocolate_type') == 'dark' ? 'selected' : '' }}>Dark Chocolate</option>
                                        <option value="milk" {{ old('chocolate_type') == 'milk' ? 'selected' : '' }}>Milk Chocolate</option>
                                        <option value="white" {{ old('chocolate_type') == 'white' ? 'selected' : '' }}>White Chocolate</option>
                                        <option value="ruby" {{ old('chocolate_type') == 'ruby' ? 'selected' : '' }}>Ruby Chocolate</option>
                                        <option value="mixed" {{ old('chocolate_type') == 'mixed' ? 'selected' : '' }}>Mixed</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Cocoa Percentage (%)</label>
                                    <input type="number" name="cocoa_percentage" class="form-control form-control-chocolate" min="0" max="100" value="{{ old('cocoa_percentage') }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Origin</label>
                                    <input type="text" name="origin" class="form-control form-control-chocolate" value="{{ old('origin') }}" placeholder="e.g. Ghana, Belgium">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Images -->
                    <div class="card card-chocolate mb-4">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0"><i class="bi bi-images me-2" style="color: var(--chocolate-gold);"></i>Product Images</h5>
                        </div>
                        <div class="card-body">
                            <input type="file" name="images[]" class="form-control form-control-chocolate @error('images.*') is-invalid @enderror" multiple accept="image/*">
                            <small class="text-muted">Upload multiple images. First image will be the primary image.</small>
                            @error('images.*')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="col-lg-4" data-aos="fade-left">
                    <!-- Pricing -->
                    <div class="card card-chocolate mb-4">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0"><i class="bi bi-tag me-2" style="color: var(--chocolate-gold);"></i>Pricing</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Regular Price (Rp) <span class="text-danger">*</span></label>
                                <input type="number" name="price" class="form-control form-control-chocolate @error('price') is-invalid @enderror" value="{{ old('price') }}" required min="0">
                                @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Sale Price (Rp)</label>
                                <input type="number" name="sale_price" class="form-control form-control-chocolate" value="{{ old('sale_price') }}" min="0">
                                <small class="text-muted">Leave empty if not on sale</small>
                            </div>
                        </div>
                    </div>

                    <!-- Inventory -->
                    <div class="card card-chocolate mb-4">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0"><i class="bi bi-box me-2" style="color: var(--chocolate-gold);"></i>Inventory</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Stock Quantity <span class="text-danger">*</span></label>
                                <input type="number" name="stock" class="form-control form-control-chocolate @error('stock') is-invalid @enderror" value="{{ old('stock', 0) }}" required min="0">
                                @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Weight (grams)</label>
                                <input type="number" name="weight" class="form-control form-control-chocolate" value="{{ old('weight') }}" min="0">
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="card card-chocolate mb-4">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0"><i class="bi bi-toggle-on me-2" style="color: var(--chocolate-gold);"></i>Status</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active (visible to customers)</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured" {{ old('is_featured') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">Featured Product</label>
                            </div>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-chocolate btn-lg">
                            <i class="bi bi-check-circle me-2"></i>Create Product
                        </button>
                        <a href="{{ route('seller.products.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
