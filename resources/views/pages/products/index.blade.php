@extends('layouts.main')

@section('content')
<div class="container my-4">
    <!-- Toast Success -->
    @if (Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif


    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Produk</li>
        </ol>
    </nav>
    <h1 class="h4 mb-4">Product</h1>

    <div class="mb-3 text-end">
        @if (Auth::user()->role === 'admin')
            <a href="{{ route('products.create') }}" class="btn btn-primary">+ Tambah Produk</a>  
            <a href="{{ route('products.exportProduct') }}" class="btn btn-success text-white">Export</a>
        @endif
    </div>

    <!-- Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    @if (Auth::user()->role === 'admin')
                        <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="border rounded overflow-hidden" style="width: 64px; height: 64px;">
                                    @if ($item->image)
                                        <img src="{{ asset('asset/product_images/' . $item->image) }}" alt="photo" class="img-fluid">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center h-100 text-muted small">
                                            Tidak ada gambar
                                        </div>
                                    @endif
                                </div>
                                <span>{{ $item['name'] }}</span>
                            </div>
                        </td>
                        <td>Rp {{ number_format($item['price'], 0, ',', '.')}}</td>
                        <td>{{ $item['stock'] }}</td>
                        @if (Auth::user()->role === 'admin')
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('products.edit', $item['id']) }}" class="btn btn-warning btn-sm text-white">Edit</a>
                                    <form action="{{ route('products.delete', $item['id']) }}" method="POST"
                                          onsubmit="return confirm('Apakah Anda Yakin Ingin Menghapus Produk {{ $item['name'] }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach

                @if(count($data) === 0)
                    <tr>
                        <td colspan="" class="text-center text-muted py-4">
                            Belum ada data produk.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection