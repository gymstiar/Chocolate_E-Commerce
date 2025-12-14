@extends('layouts.seller')

@section('title', 'Promos - ChocoLuxe Seller')

@section('content')
<section class="py-4" style="background: linear-gradient(135deg, var(--chocolate-dark) 0%, var(--chocolate-medium) 100%);">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="text-white mb-0" style="font-family: 'Playfair Display', serif;">
                <i class="bi bi-ticket me-2" style="color: var(--chocolate-gold);"></i>Promo Codes
            </h2>
            <a href="{{ route('seller.promos.create') }}" class="btn btn-gold">
                <i class="bi bi-plus-circle me-2"></i>Add Promo
            </a>
        </div>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <div class="card card-chocolate" data-aos="fade-up">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Code</th>
                                <th>Discount</th>
                                <th>Min. Purchase</th>
                                <th>Usage</th>
                                <th>Validity</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($promos as $promo)
                            <tr>
                                <td><code class="fs-6">{{ $promo->code }}</code></td>
                                <td>
                                    @if($promo->type === 'percentage')
                                        <span class="fw-bold" style="color: var(--chocolate-gold);">{{ $promo->value }}%</span>
                                    @else
                                        <span class="fw-bold" style="color: var(--chocolate-gold);">Rp {{ number_format($promo->value, 0, ',', '.') }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($promo->min_purchase)
                                        Rp {{ number_format($promo->min_purchase, 0, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    {{ $promo->used_count ?? 0 }} / {{ $promo->usage_limit ?? '∞' }}
                                </td>
                                <td>
                                    <small>
                                        {{ $promo->start_date ? $promo->start_date->format('d M Y') : 'N/A' }} - 
                                        {{ $promo->end_date ? $promo->end_date->format('d M Y') : 'N/A' }}
                                    </small>
                                </td>
                                <td>
                                    @if($promo->isValid())
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('seller.promos.edit', $promo) }}" class="btn btn-outline-chocolate">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('seller.promos.destroy', $promo) }}" method="POST" onsubmit="return confirm('Delete this promo?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="bi bi-ticket display-4 text-muted"></i>
                                    <p class="text-muted mt-3">No promo codes yet</p>
                                    <a href="{{ route('seller.promos.create') }}" class="btn btn-chocolate">Create First Promo</a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $promos->links() }}
        </div>
    </div>
</section>
@endsection
