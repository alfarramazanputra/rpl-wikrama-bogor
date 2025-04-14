@extends('layouts.main')

@section('content')
    <!-- Toast Success -->
    @if (Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.index') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Penjualan</li>
        </ol>
    </nav>

    <!-- Title -->
    <h1 class="h4 mb-4">Penjualan</h1>

    <!-- Actions -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
        <div class="d-flex gap-2">
            @if (Auth::user()->role === 'petugas')
                <a href="{{ route('sales.productSale') }}" class="btn btn-primary">+ Tambah Penjualan</a>
            @endif
            <a href="{{ route('sales.exportInvoice') }}" class="btn btn-success text-white">Export</a>
        </div>
        <form action="{{ route('sales.index') }}" method="GET" class="d-flex gap-2">
            <input type="text" name="keyword" placeholder="Cari..." value="{{ request('keyword') }}" class="form-control" style="width: 250px;" />
            <button type="submit" class="btn btn-outline-secondary">Cari</button>
        </form>
    </div>

    <!-- Table -->
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No.</th>
                        <th>Nama Pelanggan</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Dibuat Oleh</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->member ? $item->member->name : 'Non-Member' }}</td>
                            <td>{{ $item->date }}</td>
                            <td>Rp {{ number_format($item->sub_total, 0, ',', '.') }}</td>
                            <td>{{ $item->created_by }}</td>
                            <td>
                                <form action="{{ route('sales.invoice', $item->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-warning text-white">PDF</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada data penjualan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4 d-flex justify-content-end">
        {{ $data->links() }}
    </div>
@endsection