@extends('layouts.main')

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('sales.index') }}">Penjualan</a></li>
        </ol>
    </nav>

    <h1 class="h5 mb-4">Checkout Penjualan</h1>

    <div class="row g-3">
        <!-- Ringkasan -->
        <div class="col-lg-6">
            <div class="card shadow-sm p-3">
                <h5 class="mb-3">Produk yang Dipilih</h5>
                <ul class="list-group small">
                    @foreach ($cartItems as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="me-auto">
                                <div class="fw-semibold">{{ $item['name'] }}</div>
                                <div>Qty: {{ $item['qty'] }} x Rp {{ number_format($item['price'], 0, ',', '.') }}</div>
                            </div>
                            <div class="fw-bold text-danger">
                                Rp {{ number_format($item['qty'] * $item['price'], 0, ',', '.') }}
                            </div>
                        </li>
                    @endforeach
                </ul>

                <div class="mt-3 text-end fw-semibold">
                    <p class="mb-1">Total: Rp {{ number_format($sub_total, 0, ',', '.') }}</p>
                    <p class="mb-0">Tunai: Rp {{ number_format($amount_paid, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="col-lg-6">
            <form id="member-form" action="{{ route('sales.memberpayment') }}" method="POST" class="card shadow-sm p-3">
                @csrf

                <h5 class="mb-3">Data Member</h5>

                <div class="mb-3">
                    <label for="member_name" class="form-label">Nama Member</label>
                    <input type="text" name="member_name" id="member_name"
                           class="form-control {{ $member_name ? 'bg-light' : '' }}"
                           value="{{ $member_name ?? '' }}" {{ $member_name ? 'readonly' : '' }}>
                </div>

                <div class="mb-3">
                    <label class="form-label">Total Poin</label>
                    <input type="text" class="form-control bg-light" value="{{ $point_total }}" readonly>
                </div>

                <!-- Checkbox Interaktif -->
                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="use_point" {{ $can_use_point ? '' : '' }}>
                    <label class="form-check-label" for="use_point" id="use_point_label">
                        Gunakan Poin
                        @if (!$can_use_point)
                            <br><small class="text-danger">Poin tidak dapat digunakan pada pembelanjaan pertama.</small>
                        @endif
                    </label>
                    <input type="hidden" name="use_point" id="usePointsHidden" value="0">
                </div>

                <!-- Hidden Inputs -->
                <input type="hidden" name="cart" id="cart-input">
                <input type="hidden" name="sub_total" value="{{ $sub_total }}">
                <input type="hidden" name="amount_paid" value="{{ $amount_paid }}">
                <input type="hidden" name="total_point" value="{{ $point_total }}">
                <input type="hidden" name="phone_number" value="{{ $phone_number }}">

                <button type="submit" class="btn btn-success w-100 fs-6">Lanjutkan Pembayaran</button>
            </form>
        </div>
    </div>

    <script>
        const checkbox = document.getElementById('use_point');
        const label = document.getElementById('use_point_label');
        const pointInfo = document.getElementById('point-info');
        const usePointsHidden = document.getElementById('usePointsHidden');

        checkbox.addEventListener('change', function () {
            if (checkbox.checked) {
                label.classList.add('text-success');
                pointInfo.style.display = 'block';
            } else {
                label.classList.remove('text-success');
                pointInfo.style.display = 'none';
            }
        });

        document.getElementById('member-form').addEventListener('submit', function () {
            document.getElementById('cart-input').value = JSON.stringify(@json($cartItems));
            usePointsHidden.value = checkbox.checked ? "1" : "0";
        });
    </script>
    
@endsection