@extends('layouts.app')

@section('title', 'My Addresses - ChocoLuxe')

@section('content')
<section class="py-4" style="background: linear-gradient(135deg, var(--chocolate-dark) 0%, var(--chocolate-medium) 100%);">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="text-white mb-0" style="font-family: 'Playfair Display', serif;">
                <i class="bi bi-geo-alt me-2" style="color: var(--chocolate-gold);"></i>My Addresses
            </h2>
            <button class="btn btn-gold" data-bs-toggle="modal" data-bs-target="#addAddressModal">
                <i class="bi bi-plus-circle me-2"></i>Add Address
            </button>
        </div>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        @if($addresses->count() > 0)
        <div class="row g-4">
            @foreach($addresses as $address)
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <div class="card card-chocolate h-100 {{ $address->is_default ? 'border-warning' : '' }}">
                    <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0">{{ $address->label }}</h5>
                            @if($address->is_default)
                            <span class="badge badge-gold small">Default</span>
                            @endif
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <button class="dropdown-item" onclick="editAddress({{ json_encode($address) }})">
                                        <i class="bi bi-pencil me-2"></i>Edit
                                    </button>
                                </li>
                                @if(!$address->is_default)
                                <li>
                                    <form action="{{ route('buyer.addresses.default', $address) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-star me-2"></i>Set as Default
                                        </button>
                                    </form>
                                </li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('buyer.addresses.delete', $address) }}" method="POST" onsubmit="return confirm('Delete this address?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-trash me-2"></i>Delete
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="mb-1"><strong>{{ $address->recipient_name }}</strong></p>
                        <p class="mb-1 text-muted"><i class="bi bi-telephone me-1"></i>{{ $address->phone }}</p>
                        <p class="mb-0 text-muted"><i class="bi bi-geo me-1"></i>{{ $address->full_address }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-5" data-aos="fade-up">
            <i class="bi bi-geo-alt display-1 text-muted"></i>
            <h3 class="mt-4 text-muted">No addresses saved</h3>
            <p class="text-muted mb-4">Add a shipping address to start ordering</p>
            <button class="btn btn-chocolate btn-lg" data-bs-toggle="modal" data-bs-target="#addAddressModal">
                <i class="bi bi-plus-circle me-2"></i>Add Address
            </button>
        </div>
        @endif
    </div>
</section>

<!-- Add Address Modal -->
<div class="modal fade" id="addAddressModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('buyer.addresses.store') }}" method="POST">
                @csrf
                <div class="modal-header" style="background: var(--chocolate-dark);">
                    <h5 class="modal-title text-white"><i class="bi bi-geo-alt me-2" style="color: var(--chocolate-gold);"></i>Add New Address</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Label <small class="text-muted">(e.g. Home, Office)</small></label>
                            <input type="text" name="label" class="form-control form-control-chocolate" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Recipient Name</label>
                            <input type="text" name="recipient_name" class="form-control form-control-chocolate" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" name="phone" class="form-control form-control-chocolate" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Province</label>
                            <input type="text" name="province" class="form-control form-control-chocolate" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">City</label>
                            <input type="text" name="city" class="form-control form-control-chocolate" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Postal Code</label>
                            <input type="text" name="postal_code" class="form-control form-control-chocolate" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Full Address</label>
                            <textarea name="address" class="form-control form-control-chocolate" rows="3" required></textarea>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_default" value="1" id="is_default">
                                <label class="form-check-label" for="is_default">Set as default address</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-chocolate">
                        <i class="bi bi-check-circle me-2"></i>Save Address
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Address Modal -->
<div class="modal fade" id="editAddressModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editAddressForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header" style="background: var(--chocolate-dark);">
                    <h5 class="modal-title text-white"><i class="bi bi-pencil me-2" style="color: var(--chocolate-gold);"></i>Edit Address</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Label</label>
                            <input type="text" name="label" id="edit_label" class="form-control form-control-chocolate" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Recipient Name</label>
                            <input type="text" name="recipient_name" id="edit_recipient_name" class="form-control form-control-chocolate" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" name="phone" id="edit_phone" class="form-control form-control-chocolate" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Province</label>
                            <input type="text" name="province" id="edit_province" class="form-control form-control-chocolate" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">City</label>
                            <input type="text" name="city" id="edit_city" class="form-control form-control-chocolate" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Postal Code</label>
                            <input type="text" name="postal_code" id="edit_postal_code" class="form-control form-control-chocolate" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Full Address</label>
                            <textarea name="address" id="edit_address" class="form-control form-control-chocolate" rows="3" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-chocolate">
                        <i class="bi bi-check-circle me-2"></i>Update Address
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function editAddress(address) {
    document.getElementById('editAddressForm').action = '/buyer/addresses/' + address.id;
    document.getElementById('edit_label').value = address.label;
    document.getElementById('edit_recipient_name').value = address.recipient_name;
    document.getElementById('edit_phone').value = address.phone;
    document.getElementById('edit_province').value = address.province;
    document.getElementById('edit_city').value = address.city;
    document.getElementById('edit_postal_code').value = address.postal_code;
    document.getElementById('edit_address').value = address.address;
    new bootstrap.Modal(document.getElementById('editAddressModal')).show();
}
</script>
@endpush
@endsection
