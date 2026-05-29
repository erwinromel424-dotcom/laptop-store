<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Nota Penjualan #{{ $order->order_number }}</title>
    <style>
        @page {
            margin: 40px;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #1c1917;
            font-size: 11px;
            line-height: 1.5;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        td,
        th {
            vertical-align: top;
            padding: 0;
        }

        /* Company Header */
        .header-box {
            border-b: 2px solid #2563eb;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .brand-logo {
            font-size: 24px;
            font-weight: bold;
            color: #2563eb;
        }

        .doc-meta {
            text-align: right;
        }

        .doc-title {
            font-size: 20px;
            font-weight: 800;
            color: #09090b;
            margin: 0;
        }

        /* Info Area */
        .info-title {
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            color: #78716c;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .info-content {
            font-size: 11px;
            color: #27272a;
            line-height: 1.4;
        }

        /* Item Table Styles */
        .table-items {
            margin-top: 25px;
        }

        .table-items th {
            background-color: #f5f5f4;
            color: #44403c;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 10px;
            border-top: 1px solid #e7e5e4;
            border-bottom: 2px solid #e7e5e4;
            text-align: left;
        }

        .table-items td {
            padding: 10px;
            border-bottom: 1px solid #e7e5e4;
            font-size: 11px;
        }

        /* Status Badges */
        .badge {
            display: inline-block;
            padding: 2px 6px;
            font-size: 8px;
            font-weight: bold;
            border-radius: 4px;
            text-transform: uppercase;
        }

        .badge-success {
            background-color: #dcfce7;
            color: #15803d;
        }

        .badge-pending {
            background-color: #fef9c3;
            color: #a16207;
        }

        .badge-info {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .badge-purple {
            background-color: #f3e8ff;
            color: #6b21a8;
        }

        .badge-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }

        /* Calculation block */
        .calc-wrapper {
            width: 100%;
            margin-top: 15px;
        }

        .calc-table {
            width: 260px;
            float: right;
        }

        .calc-table td {
            padding: 5px 8px;
        }

        .total-row td {
            font-size: 14px;
            font-weight: bold;
            color: #2563eb;
            border-top: 1px dashed #cbd5e1;
            padding-top: 8px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .font-mono {
            font-family: monospace;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <table style="border-bottom: 2px solid #e7e5e4; padding-bottom: 15px; margin-bottom: 20px;">
        <tr>
            <td width="50%">
                <div class="brand-logo">LaptopStore.</div>
                <div style="color: #78716c; font-size: 10px; margin-top: 3px;">
                    Official Sales & Distribution Center<br>
                    Jl. Kesambi No. 202, Kota Cirebon<br>
                    Sistem Invoice Manajemen Internal
                </div>
            </td>
            <td width="50%" class="text-right">
                <h1 class="doc-title">NOTA PENJUALAN</h1>
                <div class="doc-meta" style="margin-top: 5px; color: #44403c;">
                    <strong>No Invoice:</strong> <span class="font-mono">#{{ $order->order_number }}</span><br>
                    <strong>Waktu Transaksi:</strong> {{ $order->created_at->format('d M Y H:i') }}
                </div>
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td width="50%" style="padding-right: 15px;">
                <div class="info-title">Detail Tujuan Pengiriman:</div>
                <div class="info-content">
                    <strong style="font-size: 12px; color: #09090b;">{{ $order->user->name }}</strong><br>
                    Email: {{ $order->user->email }}<br>
                    <span style="color: #52525b; display: block; margin-top: 4px;">
                        Alamat: {{ $order->shipping_address }}
                    </span>
                </div>
            </td>
            <td width="50%" class="text-right">
                <div class="info-title">Informasi Logistik & Pembayaran:</div>
                <div class="info-content" style="margin-bottom: 8px;">
                    Metode Kirim: <strong>{{ $order->shipping_method }}</strong><br>
                    No. Resi Kurir: <span class="font-mono"
                        style="font-size:11px;">{{ $order->tracking_number ?? 'Belum Diinput' }}</span><br>
                    Sistem Bayar: <strong>{{ $order->payment->payment_method ?? 'Transfer' }}</strong>
                </div>

                <div class="info-title" style="margin-top: 10px;">Status Alur Kerja:</div>
                <div>
                    @php
                        $statusLabels = [
                            'pending' => ['txt' => 'Menunggu', 'clss' => 'badge-pending'],
                            'processing' => ['txt' => 'Diproses', 'clss' => 'badge-info'],
                            'shipped' => ['txt' => 'Dikirim', 'clss' => 'badge-purple'],
                            'completed' => ['txt' => 'Selesai', 'clss' => 'badge-success'],
                            'cancelled' => ['txt' => 'Batal', 'clss' => 'badge-danger'],
                        ];
                        $currOrder = $statusLabels[$order->status] ?? [
                            'txt' => $order->status,
                            'clss' => 'badge-pending',
                        ];
                        $pStatus = $order->payment->payment_status ?? 'pending';
                    @endphp
                    <span class="badge {{ $currOrder['clss'] }}">{{ $currOrder['txt'] }}</span>
                    <span class="badge {{ $pStatus == 'success' ? 'badge-success' : 'badge-pending' }}">
                        {{ $pStatus == 'success' ? 'Lunas' : 'Belum Lunas' }}
                    </span>
                </div>
            </td>
        </tr>
    </table>

    <table class="table-items">
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="55%">Deskripsi Komoditas / Produk</th>
                <th width="15%" class="text-right">Harga Satuan</th>
                <th width="10%" class="text-center">Qty</th>
                <th width="15%" class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $idx => $item)
                <tr>
                    <td class="text-center" style="color: #78716c;">{{ $idx + 1 }}</td>
                    <td>
                        <strong style="color: #09090b;">{{ $item->product_name }}</strong>
                    </td>
                    <td class="text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right" style="font-weight: bold;">Rp
                        {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="calc-wrapper">
        <table class="calc-table">
            <tr>
                <td style="color: #71717a;">Subtotal Nilai Barang:</td>
                <td class="text-right">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="color: #71717a;">Ongkos Kirim Kurir:</td>
                <td class="text-right">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
            </tr>
            <tr class="total-row">
                <td>Total Tagihan:</td>
                <td class="text-right">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</td>
            </tr>
        </table>
        <div style="clear: both;"></div>
    </div>

</body>

</html>
