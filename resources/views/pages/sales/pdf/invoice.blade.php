<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #saleid</title>
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
        <h1>Invoice #datasaleid</h1>
        <p>Tanggal: date</p>
    </div>

    <div class="info">
        <strong>Data Pelanggan:</strong>
        
            <p>Nama Member: <strong>membername</strong></p>
            <p>No. HP: memberphone</p>
            <p>Bergabung Sejak: date</p>
            <p>Sisa Poin Saat Ini: poin</p>
        
            <p><em>Pembeli bukan member.</em></p>
        
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
            
                <tr>
                    <td>productname</td>
                    <td>Rp price</td>
                    <td>qty</td>
                    <td>Rp priceqty</td>
                </tr>
            
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">Poin Digunakan</td>
                <td>pointused</td>
            </tr>
            <tr>
                <td colspan="3">Tunai Dibayar</td>
                <td>Rp amountpaid</td>
            </tr>
            <tr>
                <td colspan="3">Kembalian</td>
                <td>Rp change</td>
            </tr>
            <tr>
                <td colspan="3">Sub Total</td>
                <td><del>Rp subtotal</del></td>
            </tr>
            <tr>
                <td colspan="3">Total Bayar</td>
                <td><strong>Rp total</strong></td>
            </tr>
        </tfoot>
    </table>

    <div class="highlight">
        <p>Terima kasih telah berbelanja di <strong>rjmNms</strong>.</p>
        <p>Semoga hari Anda menyenangkan!</p>
    </div>

    <hr>

    <div class="footer">
        rjmNms <br>
        Jl. Raya Cisarua, Bogor <br>
        Email: <a href="mailto:rjmnms@gmail.com">rjmnms@gmail.com</a>
    </div>

</body>
</html>