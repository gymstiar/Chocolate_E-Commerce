@extends('layouts.seller')

@section('title', 'Edit Product - ChocoLuxe Seller')

@section('content')
<section class="py-4" style="background: linear-gradient(135deg, var(--chocolate-dark) 0%, var(--chocolate-medium) 100%);">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="{{ route('seller.products.index') }}" class="text-white text-decoration-none">Products</a></li>
                <li class="breadcrumb-item active text-white-50">Edit: {{ $product->name }}</li>
            </ol>
        </nav>
        <h2 class="text-white mb-0" style="font-family: 'Playfair Display', serif;">
            <i class="bi bi-pencil me-2" style="color: var(--chocolate-gold);"></i>Edit Product
        </h2>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <form action="{{ route('seller.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
                                    <input type="text" name="name" class="form-control form-control-chocolate @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}" required>
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Category <span class="text-danger">*</span></label>
                                    <select name="category_id" class="form-select form-control-chocolate" required>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Short Description</label>
                                    <input type="text" name="short_description" class="form-control form-control-chocolate" value="{{ old('short_description', $product->short_description) }}" maxlength="255">
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Full Description</label>
                                    <textarea name="description" class="form-control form-control-chocolate" rows="5">{{ old('description', $product->description) }}</textarea>
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
                                    <label class="form-label">Chocolate Type</label>
                                    <select name="chocolate_type" class="form-select form-control-chocolate" required>
                                        <option value="dark" {{ old('chocolate_type', $product->chocolate_type) == 'dark' ? 'selected' : '' }}>Dark</option>
                                        <option value="milk" {{ old('chocolate_type', $product->chocolate_type) == 'milk' ? 'selected' : '' }}>Milk</option>
                                        <option value="white" {{ old('chocolate_type', $product->chocolate_type) == 'white' ? 'selected' : '' }}>White</option>
                                        <option value="ruby" {{ old('chocolate_type', $product->chocolate_type) == 'ruby' ? 'selected' : '' }}>Ruby</option>
                                        <option value="mixed" {{ old('chocolate_type', $product->chocolate_type) == 'mixed' ? 'selected' : '' }}>Mixed</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Cocoa Percentage (%)</label>
                                    <input type="number" name="cocoa_percentage" class="form-control form-control-chocolate" min="0" max="100" value="{{ old('cocoa_percentage', $product->cocoa_percentage) }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Origin</label>
                                    <input type="text" name="origin" class="form-control form-control-chocolate" value="{{ old('origin', $product->origin) }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Images Section -->
                <div class="card card-chocolate mb-4">
                    <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="bi bi-images me-2" style="color: var(--chocolate-gold);"></i>Product Images</h5>
                        <span class="badge {{ $product->images->count() >= 5 ? 'bg-danger' : 'bg-info' }}">
                            {{ $product->images->count() }}/5 images
                        </span>
                    </div>
                    <div class="card-body">
                        @if($product->images->count() > 0)
                        <div class="row g-3 mb-3">
                            @foreach($product->images as $image)
                            <div class="col-md-3 col-6">
                                <div class="position-relative">
                                    <img src="{{ asset('storage/' . $image->image) }}" class="img-fluid rounded" style="height: 120px; width: 100%; object-fit: cover;">
                                    @if($image->is_primary)
                                    <span class="position-absolute top-0 start-0 badge badge-gold m-1">Primary</span>
                                    @endif
                                    <button type="button" class="btn btn-danger btn-sm position-absolute bottom-0 end-0 m-1 delete-image-btn" 
                                        data-image-id="{{ $image->id }}" 
                                        data-url="{{ route('seller.products.images.delete', $image) }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        @if($product->images->count() < 5)
                        <div class="border-top pt-3">
                            <p class="text-muted small mb-2">
                                <i class="bi bi-info-circle me-1"></i>
                                You can add {{ 5 - $product->images->count() }} more image(s). Max 2MB each (JPEG, PNG, JPG, WebP)
                            </p>
                            <div class="input-group">
                                <input type="file" name="new_images[]" id="newImages" class="form-control form-control-chocolate" accept="image/*" multiple>
                                <button type="button" class="btn btn-chocolate" id="uploadImagesBtn">
                                    <i class="bi bi-upload me-1"></i>Upload
                                </button>
                            </div>
                        </div>
                        @else
                        <div class="alert alert-warning mb-0">
                            <i class="bi bi-exclamation-triangle me-1"></i>
                            Maximum 5 images reached. Delete an image to add a new one.
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Product Video Section -->
                <div class="card card-chocolate mb-4">
                    <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="bi bi-camera-video me-2" style="color: var(--chocolate-gold);"></i>Product Video</h5>
                        <span class="badge {{ $product->video ? 'bg-success' : 'bg-secondary' }}">
                            {{ $product->video ? '1/1' : '0/1' }} video
                        </span>
                    </div>
                    <div class="card-body">
                        @if($product->video)
                        <div class="mb-3">
                            <video controls class="w-100 rounded" style="max-height: 300px;">
                                <source src="{{ asset('storage/' . $product->video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                        <button type="button" class="btn btn-danger" id="deleteVideoBtn">
                            <i class="bi bi-trash me-1"></i>Delete Video
                        </button>
                        @else
                        <p class="text-muted small mb-2">
                            <i class="bi bi-info-circle me-1"></i>
                            Upload 1 video. Max 50MB (MP4, WebM, MOV)
                        </p>
                        <div class="input-group">
                            <input type="file" name="video" id="videoInput" class="form-control form-control-chocolate" accept="video/mp4,video/webm,video/quicktime">
                            <button type="button" class="btn btn-chocolate" id="uploadVideoBtn">
                                <i class="bi bi-upload me-1"></i>Upload Video
                            </button>
                        </div>
                        @endif
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
                                <label class="form-label">Regular Price (Rp)</label>
                                <input type="number" name="price" class="form-control form-control-chocolate" value="{{ old('price', $product->price) }}" required min="0">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Sale Price (Rp)</label>
                                <input type="number" name="sale_price" class="form-control form-control-chocolate" value="{{ old('sale_price', $product->sale_price) }}" min="0">
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
                                <label class="form-label">Stock Quantity</label>
                                <input type="number" name="stock" class="form-control form-control-chocolate" value="{{ old('stock', $product->stock) }}" required min="0">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Weight (grams)</label>
                                <input type="number" name="weight" class="form-control form-control-chocolate" value="{{ old('weight', $product->weight) }}" min="0">
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
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">Featured</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-chocolate btn-lg">
                            <i class="bi bi-check-circle me-2"></i>Update Product
                        </button>
                        <a href="{{ route('seller.products.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Hidden forms for image deletion (outside main form) -->
@if(isset($product) && $product->images->count() > 0)
@foreach($product->images as $image)
<form id="delete-image-{{ $image->id }}" action="{{ route('seller.products.images.delete', $image) }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>
@endforeach
@endif

<!-- Hidden form for image upload -->
<form id="upload-images-form" action="{{ route('seller.products.images', $product) }}" method="POST" enctype="multipart/form-data" class="d-none">
    @csrf
    <input type="file" name="images[]" id="hiddenImagesInput" multiple>
</form>

<!-- Hidden form for video upload -->
<form id="upload-video-form" action="{{ route('seller.products.video', $product) }}" method="POST" enctype="multipart/form-data" class="d-none">
    @csrf
    <input type="file" name="video" id="hiddenVideoInput">
</form>

<!-- Hidden form for video deletion -->
<form id="delete-video-form" action="{{ route('seller.products.video.delete', $product) }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>

@push('scripts')
<script>
// Delete image buttons
document.querySelectorAll('.delete-image-btn').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        if (confirm('Delete this image?')) {
            const imageId = this.getAttribute('data-image-id');
            document.getElementById('delete-image-' + imageId).submit();
        }
    });
});

// Upload images button
const uploadImagesBtn = document.getElementById('uploadImagesBtn');
if (uploadImagesBtn) {
    uploadImagesBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const fileInput = document.getElementById('newImages');
        if (fileInput.files.length === 0) {
            alert('Please select at least one image to upload.');
            return;
        }
        
        // Copy files to hidden form and submit
        const hiddenInput = document.getElementById('hiddenImagesInput');
        hiddenInput.files = fileInput.files;
        document.getElementById('upload-images-form').submit();
    });
}

// Upload video button
const uploadVideoBtn = document.getElementById('uploadVideoBtn');
if (uploadVideoBtn) {
    uploadVideoBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const fileInput = document.getElementById('videoInput');
        if (fileInput.files.length === 0) {
            alert('Please select a video to upload.');
            return;
        }
        
        // Copy file to hidden form and submit
        const hiddenInput = document.getElementById('hiddenVideoInput');
        hiddenInput.files = fileInput.files;
        document.getElementById('upload-video-form').submit();
    });
}

// Delete video button
const deleteVideoBtn = document.getElementById('deleteVideoBtn');
if (deleteVideoBtn) {
    deleteVideoBtn.addEventListener('click', function(e) {
        e.preventDefault();
        if (confirm('Delete this video?')) {
            document.getElementById('delete-video-form').submit();
        }
    });
}
</script>
@endpush
@endsection

