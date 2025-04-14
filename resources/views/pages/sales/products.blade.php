@extends('layouts.main')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Penjualan Produk</li>
        </ol>
    </nav>

    <!-- Title -->
    <h1 class="h5 mb-4">Penjualan Produk</h1>

    <!-- Produk Grid -->
    <div class="row g-2">
        @foreach ($data as $product)
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="card shadow-sm text-center p-2 h-100">
                    <div class="ratio ratio-4x3 mb-2">
                        <img src="{{ asset('asset/product_images/' . $product->image) }}"
                             alt="{{ $product->name }}"
                             class="object-fit-cover rounded" />
                    </div>
                    <h6 class="text-truncate mb-1">{{ $product->name }}</h6>
                    <p class="text-muted small mb-1">Stok: <span id="stock-{{ $product->id }}">{{ $product->stock }}</span></p>
                    <p class="text-danger fw-bold small mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                    <div class="d-flex justify-content-center align-items-center gap-1">
                        <button onclick="updateQuantity({{ $product->id }}, -1, {{ $product->stock }})"
                                class="btn btn-outline-secondary btn-sm px-2 py-0">-</button>

                        <input type="number" id="qty-{{ $product->id }}"
                               value="0" readonly
                               class="form-control form-control-sm text-center px-1 py-0"
                               style="width: 40px;" />

                        <button onclick="updateQuantity({{ $product->id }}, 1, {{ $product->stock }})"
                                class="btn btn-outline-secondary btn-sm px-2 py-0">+</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Checkout -->
    <form id="checkout-form" action="{{ route('sales.checkout') }}" method="POST">
        @csrf
        <input type="hidden" name="cart_checkout" id="cart_checkout">
        <button type="submit" class="btn btn-success w-100 mt-4 text-white fs-5">Selanjutnya</button>
    </form>

    <script>
        let cart_checkout = [];

        function updateQuantity(id, change, maxStock) {
            const qtyInput = document.getElementById('qty-' + id);
            let qty = parseInt(qtyInput.value) || 0;
            let newQty = qty + change;

            newQty = Math.max(0, Math.min(newQty, maxStock));
            qtyInput.value = newQty;

            const index = cart_checkout.findIndex(item => item.id === id);
            if (index > -1) {
                if (newQty === 0) {
                    cart_checkout.splice(index, 1);
                } else {
                    cart_checkout[index].qty = newQty;
                }
            } else if (newQty > 0) {
                cart_checkout.push({ id: id, qty: newQty });
            }
        }

        document.getElementById('checkout-form').addEventListener('submit', function () {
            document.getElementById('cart_checkout').value = JSON.stringify(cart_checkout);
        });
    </script>

@endsection
