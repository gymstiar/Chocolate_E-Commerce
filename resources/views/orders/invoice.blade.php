@extends('layouts.app')

@section('title', 'Invoice {{ $order->order_number }} - ChocoLuxe')

@push('styles')
<style>
    @media print {
        .no-print { display: none !important; }
        .print-only { display: block !important; }
        body { background: white !important; }
        .invoice-container { box-shadow: none !important; border: none !important; }
    }
    .invoice-container {
        background: white;
        max-width: 800px;
        margin: 0 auto;
        border: 1px solid #ddd;
    }
    .invoice-header {
        background: linear-gradient(135deg, #5D3A1A 0%, #8B5A2B 100%);
        color: white;
        padding: 30px;
    }
    .invoice-body { padding: 30px; }
    .invoice-table th { background: #f8f5f0; }
    .invoice-footer { background: #f8f5f0; padding: 20px; text-align: center; }
</style>
@endpush

@section('content')
<section class="section-padding bg-light">
    <div class="container">
        <!-- Print Button -->
        <div class="text-center mb-4 no-print" data-aos="fade-up">
            <button onclick="window.print()" class="btn btn-chocolate btn-lg me-2">
                <i class="bi bi-printer me-2"></i>Print Invoice
            </button>
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-lg">
                <i class="bi bi-arrow-left me-2"></i>Back
            </a>
        </div>

        <!-- Invoice -->
        <div class="invoice-container shadow" data-aos="fade-up">
            <!-- Header -->
            <div class="invoice-header">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h1 style="font-family: 'Playfair Display', serif; font-size: 2.5rem; margin: 0;">
                            🍫 ChocoLuxe
                        </h1>
                        <p class="mb-0 mt-2 opacity-75">Premium Chocolate Store</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <h2 class="mb-2" style="font-family: 'Playfair Display', serif;">INVOICE</h2>
                        <p class="mb-0"><strong>{{ $order->order_number }}</strong></p>
                    </div>
                </div>
            </div>

            <!-- Body -->
            <div class="invoice-body">
                <!-- Info Row -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">BILL TO:</h6>
                        <strong>{{ $order->user->name ?? 'N/A' }}</strong><br>
                        {{ $order->user->email ?? '' }}<br>
                        {{ $order->user->phone ?? '' }}
                        @if($order->address)
                        <br><br>
                        <h6 class="text-muted mb-2">SHIP TO:</h6>
                        <strong>{{ $order->address->recipient_name }}</strong><br>
                        {{ $order->address->phone }}<br>
                        {{ $order->address->full_address }}
                        @endif
                    </div>
                    <div class="col-md-6 text-md-end">
                        <table class="table table-borderless table-sm ms-auto" style="max-width: 250px;">
                            <tr>
                                <td class="text-muted">Invoice Date:</td>
                                <td class="text-end">{{ $order->created_at->format('d M Y') }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Order Status:</td>
                                <td class="text-end"><span class="badge bg-{{ $order->status_badge }}">{{ $order->status_label }}</span></td>
                            </tr>
                            @if($order->paid_at)
                            <tr>
                                <td class="text-muted">Paid Date:</td>
                                <td class="text-end">{{ $order->paid_at->format('d M Y') }}</td>
                            </tr>
                            @endif
                            @if($order->shipping_method)
                            <tr>
                                <td class="text-muted">Shipping:</td>
                                <td class="text-end">{{ $order->shipping_method }}</td>
                            </tr>
                            @endif
                            @if($order->tracking_number)
                            <tr>
                                <td class="text-muted">Tracking #:</td>
                                <td class="text-end"><code>{{ $order->tracking_number }}</code></td>
                            </tr>
                            @endif
                        </table>
                    </div>
                </div>

                <!-- Items Table -->
                <table class="table invoice-table">
                    <thead>
                        <tr>
                            <th style="width: 50%;">Item Description</th>
                            <th class="text-center">Qty</th>
                            <th class="text-end">Unit Price</th>
                            <th class="text-end">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>
                                <strong>{{ $item->product_name }}</strong>
                                @if($item->product && $item->product->chocolate_type)
                                <br><small class="text-muted">{{ ucfirst($item->product->chocolate_type) }} Chocolate</small>
                                @endif
                            </td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="text-end">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="text-end">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Totals -->
                <div class="row justify-content-end">
                    <div class="col-md-5">
                        <table class="table table-borderless">
                            <tr>
                                <td>Subtotal</td>
                                <td class="text-end">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td>Shipping Cost</td>
                                <td class="text-end">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
                            </tr>
                            @if($order->discount > 0)
                            <tr class="text-success">
                                <td>Discount</td>
                                <td class="text-end">- Rp {{ number_format($order->discount, 0, ',', '.') }}</td>
                            </tr>
                            @endif
                            <tr class="border-top">
                                <td class="fw-bold fs-5">TOTAL</td>
                                <td class="text-end fw-bold fs-5" style="color: #D4AF37;">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Notes -->
                @if($order->notes)
                <div class="alert alert-light border mt-4">
                    <strong>Order Notes:</strong><br>
                    {{ $order->notes }}
                </div>
                @endif
            </div>

            <!-- Footer -->
            <div class="invoice-footer">
                <p class="mb-1"><strong>Thank you for your purchase!</strong></p>
                <p class="mb-0 text-muted small">
                    ChocoLuxe • Premium Chocolate Store • Contact: support@chocoluxe.com
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
