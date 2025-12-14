@extends('layouts.seller')

@section('title', 'Edit Promo - ChocoLuxe Seller')

@section('content')
<section class="py-4" style="background: linear-gradient(135deg, var(--chocolate-dark) 0%, var(--chocolate-medium) 100%);">
    <div class="container">
        <h2 class="text-white mb-0" style="font-family: 'Playfair Display', serif;">
            <i class="bi bi-pencil me-2" style="color: var(--chocolate-gold);"></i>Edit Promo: {{ $promo->code }}
        </h2>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6" data-aos="fade-up">
                <div class="card card-chocolate">
                    <div class="card-body p-4">
                        <form action="{{ route('seller.promos.update', $promo) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Promo Code <span class="text-danger">*</span></label>
                                    <input type="text" name="code" class="form-control form-control-chocolate text-uppercase @error('code') is-invalid @enderror" value="{{ old('code', $promo->code) }}" required>
                                    @error('code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Promo Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control form-control-chocolate @error('name') is-invalid @enderror" value="{{ old('name', $promo->name) }}" placeholder="e.g. Summer Sale" required>
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Discount Type <span class="text-danger">*</span></label>
                                    <select name="type" class="form-select form-control-chocolate" required>
                                        <option value="percentage" {{ old('type', $promo->type) == 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                                        <option value="fixed" {{ old('type', $promo->type) == 'fixed' ? 'selected' : '' }}>Fixed Amount (Rp)</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Discount Value <span class="text-danger">*</span></label>
                                    <input type="number" name="value" class="form-control form-control-chocolate @error('value') is-invalid @enderror" value="{{ old('value', $promo->value) }}" min="0" required>
                                    @error('value')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Max Discount (for %)</label>
                                    <input type="number" name="max_discount" class="form-control form-control-chocolate" value="{{ old('max_discount', $promo->max_discount) }}" min="0">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Min. Purchase (Rp)</label>
                                    <input type="number" name="min_purchase" class="form-control form-control-chocolate" value="{{ old('min_purchase', $promo->min_purchase) }}" min="0">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Usage Limit (Total)</label>
                                    <input type="number" name="usage_limit" class="form-control form-control-chocolate" value="{{ old('usage_limit', $promo->usage_limit) }}" min="1">
                                    <small class="text-muted">Leave empty for unlimited</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Start Date</label>
                                    <input type="date" name="start_date" class="form-control form-control-chocolate" value="{{ old('start_date', $promo->start_date?->format('Y-m-d')) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">End Date</label>
                                    <input type="date" name="end_date" class="form-control form-control-chocolate" value="{{ old('end_date', $promo->end_date?->format('Y-m-d')) }}">
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control form-control-chocolate" rows="2">{{ old('description', $promo->description) }}</textarea>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', $promo->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Active</label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-chocolate btn-lg">Update Promo</button>
                                <a href="{{ route('seller.promos.index') }}" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
