@extends('layouts.main')
@section('content')

    <div class="mb-2 text-muted small">
        <span class="fw-semibold text-dark">Dashboard</span>
    </div>

    <h1 class="h4 fw-semibold mb-4">
        Selamat Datang, {{ Auth::user()->role === 'admin' ? 'Administrator' : 'Petugas' }}!
    </h1>

    @if (Auth::user()->role === 'admin')
        <div class="row g-4">
            <!-- Grafik Penjualan Harian -->
            <div class="col-12 col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-3">Grafik Penjualan Harian</h5>
                        <canvas id="salesChart" width="400" height="200" class="d-block mx-auto"></canvas>
                    </div>
                </div>
            </div>

            <!-- Grafik Penjualan Produk -->
            <div class="col-12 col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-3">Penjualan Produk</h5>
                        <canvas id="productChart" width="200" height="200" class="d-block mx-auto"></canvas>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Untuk Petugas -->
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <p class="text-muted">Total Penjualan Hari Ini</p>
                <h2 class="fw-bold text-dark my-3">
                    {{ $today_sale }}
                </h2>
                <p class="small text-muted">Jumlah total penjualan yang terjadi hari ini.</p>
            </div>
        </div>
    @endif

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const salesChart = new Chart(document.getElementById('salesChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($dates) !!},
                datasets: [{
                    label: 'Jumlah Transaksi',
                    data: {!! json_encode($totals) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false,
                scales: { y: { beginAtZero: true } }
            }
        });

        const productChart = new Chart(document.getElementById('productChart'), {
            type: 'pie',
            data: {
                labels: {!! json_encode($product_name) !!},
                datasets: [{
                    data: {!! json_encode($product_qty) !!},
                    backgroundColor: [
                        '#f87171', '#60a5fa', '#facc15', '#34d399', '#a78bfa', '#fb923c'
                    ],
                    borderColor: '#fff',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false
            }
        });
    </script>
@endsection