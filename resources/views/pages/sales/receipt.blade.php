@extends('layouts.main')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Penjualan</li>
        </ol>
    </nav>

    <h1 class="h4 mb-4 fw-semibold">Penjualan</h1>

    <!-- Main Card -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <!-- Action Buttons -->
            <div class="mb-4 d-flex gap-2">
                <form action="#" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning text-white">Unduh</button>
                </form>
                <a href="#" class="btn btn-secondary text-white">Kembali</a>
            </div>

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                <h5 class="mb-0">Invoice - #sale_id</h5>
                <small class="text-muted">date</small>
            </div>

            <!-- Member Info -->
            
                <div class="bg-light rounded p-3 mb-4">
                    <div class="row">
                        <div class="col-sm-6">
                            <strong>Member Sejak:</strong> date
                        </div>
                        <div class="col-sm-6">
                            <strong>Poin Tersisa:</strong> poin
                        </div>
                    </div>
                </div>
            

            <!-- Table Produk -->
            <div class="table-responsive mb-4">
                <table class="table table-bordered table-sm">
                    <thead class="table-light">
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <tr>
                                <td>prod name</td>
                                <td>Rp price</td>
                                <td>qty</td>
                                <td>Rp price qty</td>
                            </tr>
                        
                    </tbody>
                </table>
            </div>

            <!-- Detail Pembayaran -->
            <div class="row bg-light p-3 rounded mb-4">
                <div class="col-md-3 mb-2">
                    <small class="text-muted">Poin Digunakan</small>
                    <div class="fw-semibold">poinsued</div>
                </div>
                <div class="col-md-3 mb-2">
                    <small class="text-muted">Tunai</small>
                    <div class="fw-semibold">Rp amount</div>
                </div>
                <div class="col-md-3 mb-2">
                    <small class="text-muted">Kembalian</small>
                    <div class="fw-semibold">Rp change</div>
                </div>
                <div class="col-md-3 mb-2">
                    <small class="text-muted">Oleh</small>
                    <div class="fw-semibold">createdby</div>
                </div>
            </div>

            <!-- Total -->
            <div class="bg-dark text-white rounded p-3 d-flex justify-content-between align-items-center">
                <div><small class="text-uppercase">TOTAL</small></div>
                
                    <div class="text-end">
                        <div class="text-decoration-line-through opacity-75">Rp subtotal</div>
                        <div class="fs-4 fw-bold">Rp total</div>
                    </div>
                @else
                    <div class="fs-4 fw-bold">Rp total</div>
                @endif
            </div>

        </div>
    </div>
@endsection