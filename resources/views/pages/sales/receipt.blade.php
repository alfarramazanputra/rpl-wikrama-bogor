@extends('layouts.main')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.index') }}">Dashboard</a>
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
                <form action="{{ route('sales.invoice', $saleData['sale_id']) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning text-white">Unduh</button>
                </form>
                <a href="{{ route('sales.index') }}" class="btn btn-secondary text-white">Kembali</a>
            </div>

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                <h5 class="mb-0">Invoice - #{{ $saleData['sale_id'] }}</h5>
                <small class="text-muted">{{ \Carbon\Carbon::parse($saleData['date'])->format('d F Y') }}</small>
            </div>

            <!-- Member Info -->
            @if ($saleData['member_id'] !== null)
                <div class="bg-light rounded p-3 mb-4">
                    <div class="row">
                        <div class="col-sm-6">
                            <strong>Member Sejak:</strong> {{ \Carbon\Carbon::parse($saleData['member_date'])->format('d F Y') }}
                        </div>
                        <div class="col-sm-6">
                            <strong>Poin Tersisa:</strong> {{ number_format($saleData['member_point'], 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            @endif

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
                        @foreach ($saleData['products'] as $item)
                            <tr>
                                <td>{{ $item['product_name'] }}</td>
                                <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                                <td>{{ $item['qty'] }}</td>
                                <td>Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Detail Pembayaran -->
            <div class="row bg-light p-3 rounded mb-4">
                <div class="col-md-3 mb-2">
                    <small class="text-muted">Poin Digunakan</small>
                    <div class="fw-semibold">{{ $saleData['point_used'] }}</div>
                </div>
                <div class="col-md-3 mb-2">
                    <small class="text-muted">Tunai</small>
                    <div class="fw-semibold">Rp {{ number_format($saleData['amount_paid'], 0, ',', '.') }}</div>
                </div>
                <div class="col-md-3 mb-2">
                    <small class="text-muted">Kembalian</small>
                    <div class="fw-semibold">Rp {{ number_format($saleData['change'], 0, ',', '.') }}</div>
                </div>
                <div class="col-md-3 mb-2">
                    <small class="text-muted">Oleh</small>
                    <div class="fw-semibold">{{ $saleData['created_by'] }}</div>
                </div>
            </div>

            <!-- Total -->
            <div class="bg-dark text-white rounded p-3 d-flex justify-content-between align-items-center">
                <div><small class="text-uppercase">TOTAL</small></div>
                @if ($saleData['point_used'] > 0)
                    <div class="text-end">
                        <div class="text-decoration-line-through opacity-75">Rp {{ number_format($saleData['sub_total'], 0, ',', '.') }}</div>
                        <div class="fs-4 fw-bold">Rp {{ number_format($saleData['total'], 0, ',', '.') }}</div>
                    </div>
                @else
                    <div class="fs-4 fw-bold">Rp {{ number_format($saleData['total'], 0, ',', '.') }}</div>
                @endif
            </div>

        </div>
    </div>
@endsection