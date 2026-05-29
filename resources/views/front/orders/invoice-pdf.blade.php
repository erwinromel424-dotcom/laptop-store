<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $order->order_number }}</title>
    <style>
        @page {
            margin: 40px;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #27272a;
            font-size: 12px;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }

        .invoice-container {
            width: 100%;
        }

        /* Base Table Reset */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        td,
        th {
            padding: 0;
            vertical-align: top;
        }

        /* Header Styling */
        .brand-title {
            font-size: 26px;
            font-weight: bold;
            color: #2563eb;
            letter-spacing: -0.5px;
        }

        .invoice-title {
            font-size: 24px;
            font-weight: 800;
            color: #09090b;
            margin: 0;
            text-align: right;
        }

        .meta-text {
            text-align: right;
            font-size: 11px;
            color: #71717a;
        }

        /* Divider Line */
        .divider {
            border-top: 1px solid #e4e4e7;
            margin: 15px 0 25px 0;
        }

        /* Info Section (Billing & Payment) */
        .info-heading {
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            color: #a1a1aa;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .info-body {
            font-size: 12px;
            color: #3f3f46;
        }

        /* Product Table Styling */
        .product-table {
            margin-top: 30px;
        }

        .product-table th {
            background-color: #f4f4f5;
            color: #71717a;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 10px 12px;
            border-bottom: 2px solid #e4e4e7;
        }

        .product-table td {
            padding: 12px;
            border-bottom: 1px solid #e4e4e7;
            font-size: 12px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        /* Badge Status */
        .badge {
            display: inline-block;
            padding: 2px 6px;
            font-size: 9px;
            font-weight: bold;
            border-radius: 4px;
            text-transform: uppercase;
            margin-top: 3px;
        }

        .badge-success {
            background-color: #dcfce7;
            color: #15803d;
        }

        .badge-pending {
            background-color: #fef9c3;
            color: #a16207;
        }

        .badge-failed {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        /* Calculation Section */
        .calc-container {
            width: 100%;
            margin-top: 20px;
        }

        .calc-table {
            width: 280px;
            float: right;
        }

        .calc-table td {
            padding: 6px 8px;
            font-size: 12px;
        }

        .grand-total-row td {
            font-size: 15px;
            font-weight: bold;
            color: #2563eb;
            border-top: 1px dashed #cbd5e1;
            padding-top: 10px;
        }
    </style>
</head>

<body>

    <div class="invoice-container">

        <table>
            <tr>
                <td width="50%">
                    <span class="brand-title">LaptopStore.</span><br>
                    <span style="color: #71717a; font-size: 11px;">
                        Pusat Perangkat Laptop & Aksesoris<br>
                        Jl. Kesambi No. 202, Kota Cirebon<br>
                        support@laptopstore.com
                    </span>
                </td>
                <td width="50%" class="text-right">
                    <h1 class="invoice-title">INVOICE</h1>
                    <div class="meta-text" style="margin-top: 5px;">
                        <strong>Nomor:</strong> #{{ $order->order_number }}<br>
                        <strong>Tanggal:</strong> {{ $order->created_at->format('d F Y H:i') }}
                    </div>
                </td>
            </tr>
        </table>

        <div class="divider"></div>

        <table>
            <tr>
                <td width="55%" style="padding-right: 20px;">
                    <div class="info-heading">Ditagih Kepada:</div>
                    <div class="info-body">
                        <strong
                            style="color: #09090b; font-size: 13px;">{{ $order->user->name ?? 'Pelanggan Setia' }}</strong><br>
                        <span
                            style="font-size: 11px; color: #52525b; display: block; margin-top: 4px; line-height: 1.4;">
                            {{ $order->shipping_address }}
                        </span>
                    </div>
                </td>
                <td width="45%" class="text-right">
                    <div class="info-heading">Metode Pembayaran:</div>
                    <div class="info-body" style="margin-bottom: 10px;">
                        <strong>{{ $order->payment->payment_method ?? 'Transfer Bank / Gateway' }}</strong>
                    </div>

                    <div class="info-heading">Status Transaksi:</div>
                    <div>
                        @php $pStatus = $order->payment->payment_status ?? 'pending'; @endphp
                        <span
                            class="badge {{ $pStatus == 'success' ? 'badge-success' : ($pStatus == 'failed' ? 'badge-failed' : 'badge-pending') }}">
                            {{ $pStatus == 'success' ? 'Lunas' : ($pStatus == 'failed' ? 'Gagal' : 'Menunggu Pembayaran') }}
                        </span>
                    </div>
                </td>
            </tr>
        </table>

        <table class="product-table">
            <thead>
                <tr>
                    <th class="text-center" width="8%">No</th>
                    <th width="47%">Deskripsi Item Laptop</th>
                    <th class="text-right" width="20%">Harga Satuan</th>
                    <th class="text-center" width="10%">Qty</th>
                    <th class="text-right" width="15%">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $index => $item)
                    <tr>
                        <td class="text-center" style="color: #71717a;">{{ $index + 1 }}</td>
                        <td>
                            <strong style="color: #09090b;">{{ $item->product_name }}</strong>
                        </td>
                        <td class="text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="text-center">{{ $item->quantity }}</td>
                        <td class="text-right" style="font-weight: bold; color: #09090b;">
                            Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="calc-container">
            <table class="calc-table">
                <tr>
                    <td style="color: #71717a;">Subtotal Item:</td>
                    <td class="text-right">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td style="color: #71717a;">Ongkos Kirim ({{ $order->shipping_method }}):</td>
                    <td class="text-right">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
                </tr>
                <tr class="grand-total-row">
                    <td>Total Bayar:</td>
                    <td class="text-right">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                </tr>
            </table>
            <div style="clear: both;"></div>
        </div>

    </div>

</body>

</html>
