@extends('layouts.main')

@section('content')
    <!-- Toast Success -->
    

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Penjualan</li>
        </ol>
    </nav>

    <!-- Title -->
    <h1 class="h4 mb-4">Penjualan</h1>

    <!-- Actions -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
        <div class="d-flex gap-2">
            cekrole
                <a href="#" class="btn btn-primary">+ Tambah Penjualan</a>
            
            <a href="#" class="btn btn-success text-white">Export</a>
        </div>
        <form action="#" method="GET" class="d-flex gap-2">
            <input type="text" name="keyword" placeholder="Cari..." value="keyword" class="form-control" style="width: 250px;" />
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
                    
                        <tr>
                            <td>key+1</td>
                            <td>nonmember</td>
                            <td>date</td>
                            <td>Rp subtotal</td>
                            <td>creataeby</td>
                            <td>
                                <form action="#" method="POST">
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