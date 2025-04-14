<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $saleData['sale_id'] }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 720px;
            margin: 30px auto;
            padding: 20px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            margin-bottom: 5px;
        }

        .header p {
            font-size: 14px;
            color: #777;
        }

        .info, .summary, .footer {
            margin-top: 20px;
            font-size: 14px;
        }

        .info p {
            margin: 4px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f7f7f7;
        }

        tfoot td {
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            font-size: 13px;
            text-align: center;
            color: #777;
        }

        .highlight {
            background-color: #f0fff0;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
        }

        .highlight p {
            margin: 5px 0;
        }

        hr {
            margin: 30px 0;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Invoice #{{ $saleData['sale_id'] }}</h1>
        <p>Tanggal: {{ \Carbon\Carbon::parse($saleData['date'])->format('d-m-Y H:i') }}</p>
    </div>

    <div class="info">
        <strong>Data Pelanggan:</strong>
        @if ($saleData['member_id'])
            <p>Nama Member: <strong>{{ $saleData['member_name'] }}</strong></p>
            <p>No. HP: {{ $saleData['member_phone'] }}</p>
            <p>Bergabung Sejak: {{ \Carbon\Carbon::parse($saleData['member_date'])->format('d-m-Y') }}</p>
            <p>Sisa Poin Saat Ini: {{ $saleData['member_point'] }}</p>
        @else
            <p><em>Pembeli bukan member.</em></p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Qty</th>
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
        <tfoot>
            <tr>
                <td colspan="3">Poin Digunakan</td>
                <td>{{ $saleData['point_used'] }}</td>
            </tr>
            <tr>
                <td colspan="3">Tunai Dibayar</td>
                <td>Rp {{ number_format($saleData['amount_paid'], 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3">Kembalian</td>
                <td>Rp {{ number_format($saleData['change'], 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3">Sub Total</td>
                <td><del>Rp {{ number_format($saleData['sub_total'], 0, ',', '.') }}</del></td>
            </tr>
            <tr>
                <td colspan="3">Total Bayar</td>
                <td><strong>Rp {{ number_format($saleData['total'], 0, ',', '.') }}</strong></td>
            </tr>
        </tfoot>
    </table>

    <div class="highlight">
        <p>Terima kasih telah berbelanja di <strong>StockX</strong>.</p>
        <p>Semoga hari Anda menyenangkan!</p>
    </div>

    <hr>

    <div class="footer">
        StockX <br>
        Jl. Raya Cisarua, Bogor <br>
        Email: <a href="#">stockx@gmail.com</a>
    </div>

</body>
</html>