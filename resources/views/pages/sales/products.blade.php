@extends('layouts.main')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Penjualan Produk</li>
        </ol>
    </nav>

    <!-- Title -->
    <h1 class="h5 mb-4">Penjualan Produk</h1>

    <!-- Produk Grid -->
    <div class="row g-2">
        
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="card shadow-sm text-center p-2 h-100">
                    <div class="ratio ratio-4x3 mb-2">
                        <img src="#"
                             alt="#"
                             class="object-fit-cover rounded" />
                    </div>
                    <h6 class="text-truncate mb-1">#</h6>
                    <p class="text-muted small mb-1">Stok: <span id="stock">stock</span></p>
                    <p class="text-danger fw-bold small mb-2">Rp priceprod</p>

                    <div class="d-flex justify-content-center align-items-center gap-1">
                        <button onclick=""
                                class="btn btn-outline-secondary btn-sm px-2 py-0">-</button>

                        <input type="number" id="qty-"
                               value="0" readonly
                               class="form-control form-control-sm text-center px-1 py-0"
                               style="width: 40px;" />

                        <button onclick="updateQuantity"
                                class="btn btn-outline-secondary btn-sm px-2 py-0">+</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Checkout -->
    <form id="checkout-form" action="#" method="POST">
        @csrf
        <input type="hidden" name="cart_checkout" id="cart_checkout">
        <button type="submit" class="btn btn-success w-100 mt-4 text-white fs-5">Selanjutnya</button>
    </form>

@endsection
