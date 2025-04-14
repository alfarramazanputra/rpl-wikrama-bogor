@extends('layouts.main')

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Penjualan</a></li>
        </ol>
    </nav>

    <h1 class="h5 mb-4">Checkout Penjualan</h1>

    <div class="row g-3">
        <!-- Ringkasan -->
        <div class="col-lg-6">
            <div class="card shadow-sm p-3">
                <h5 class="mb-3">Produk yang Dipilih</h5>
                <ul class="list-group small">
                    
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="me-auto">
                                <div class="fw-semibold">name</div>
                                <div>Qty: qty&price</div>
                            </div>
                            <div class="fw-bold text-danger">
                                Rp qty&price
                            </div>
                        </li>
                    
                </ul>

                <div class="mt-3 text-end fw-semibold">
                    <p class="mb-1">Total: Rp subtotal</p>
                    <p class="mb-0">Tunai: Rp amountpaid</p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="col-lg-6">
            <form id="member-form" action="#" method="POST" class="card shadow-sm p-3">
                @csrf

                <h5 class="mb-3">Data Member</h5>

                <div class="mb-3">
                    <label for="member_name" class="form-label">Nama Member</label>
                    <input type="text" name="member_name" id="member_name"
                           class="form-control membername?"
                           value="membername"
                           >
                </div>

                <div class="mb-3">
                    <label class="form-label">Total Poin</label>
                    <input type="text" class="form-control bg-light" value="pointtotal" readonly>
                </div>

                <!-- Checkbox Interaktif -->
                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="use_point"
                           >
                    <label class="form-check-label" for="use_point" id="use_point_label">
                        Gunakan Poin
                        
                            <br><small class="text-danger">Poin tidak dapat digunakan pada pembelanjaan pertama.</small>
                        
                    </label>
                    <input type="hidden" name="use_point" id="usePointsHidden" value="0">
                </div>

                <!-- Hidden Inputs -->
                <input type="hidden" name="cart" id="cart-input">
                <input type="hidden" name="sub_total" value="sub_total">
                <input type="hidden" name="amount_paid" value="amount_paid">
                <input type="hidden" name="total_point" value="point_total">
                <input type="hidden" name="phone_number" value="phone_number">

                <button type="submit" class="btn btn-success w-100 fs-6">Lanjutkan Pembayaran</button>
            </form>
        </div>
    </div>

    
@endsection