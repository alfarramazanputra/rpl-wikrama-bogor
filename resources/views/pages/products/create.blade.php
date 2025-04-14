@extends('layouts.main')

@section('content')

<div class="container my-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produk</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
        </ol>
    </nav>

    <h1 class="mb-4 h4">Tambah Produk</h1>

    <!-- Form -->
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="p-4 bg-white rounded shadow-sm">
        @csrf

        <div class="row g-3">
            <div class="col-md-6">
                <label for="name" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="image" class="form-label">Gambar Produk</label>
                <input type="file" id="image" name="image" class="form-control">
            </div>

            <div class="col-md-6">
                <label for="price_display" class="form-label">Harga <span class="text-danger">*</span></label>
                <input type="text" id="price_display" class="form-control" placeholder="Rp. 0" required>
                <input type="hidden" id="price" name="price">
            </div>

            <div class="col-md-6">
                <label for="stock" class="form-label">Stok <span class="text-danger">*</span></label>
                <input type="number" id="stock" name="stock" class="form-control" required>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

<script>
    const priceDisplay = document.getElementById('price_display');
    const priceHidden = document.getElementById('price');

    priceDisplay.addEventListener('input', function () {
        let raw = this.value.replace(/[^\d]/g, '');
        let formatted = new Intl.NumberFormat('id-ID').format(raw);
        this.value = 'Rp. ' + formatted;
        priceHidden.value = raw;
    });
</script>

@endsection