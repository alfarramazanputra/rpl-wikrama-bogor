@extends('layouts.main')

@section('content')
<div class="container my-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produk</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>

    <h1 class="h4 mb-4">Edit Produk</h1>

    <!-- Form -->
    <form action="{{ route('products.update', $productId['id']) }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
        @csrf
        @method('PATCH')

        <div class="row g-3">
            <div class="col-md-6">
                <label for="name" class="form-label">Nama Produk</label>
                <input type="text" id="name" name="name" value="{{ $productId['name'] }}" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="image" class="form-label">Gambar Produk</label>
                <input type="file" id="image" name="image" class="form-control">
            </div>

            <div class="col-md-6">
                <label for="price_display" class="form-label">Harga</label>
                <input type="text" id="price_display" class="form-control" value="Rp. {{ number_format($productId['price'], 0, ',', '.') }}" required>
                <input type="hidden" id="price" name="price" value="{{ $productId['price'] }}">
            </div>

            <div class="col-md-6">
                <label for="stock" class="form-label">Stok</label>
                <input type="number" id="stock" name="stock" value="{{ $productId['stock'] }}" class="form-control" required>
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-end gap-2">
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>


@endsection