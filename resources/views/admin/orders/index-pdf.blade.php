<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Rekapitulasi Transaksi</title>
    <style>
        @page {
            margin: 35px;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #1c1917;
            font-size: 10px;
            line-height: 1.4;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        td,
        th {
            vertical-align: top;
        }

        /* Header Laporan */
        .header-table {
            border-bottom: 2px solid #e7e5e4;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }

        .brand-name {
            font-size: 20px;
            font-weight: bold;
            color: #1d4ed8;
        }

        .doc-title {
            font-size: 16px;
            font-weight: bold;
            text-align: right;
            color: #44403c;
            margin: 0;
        }

        /* Summary Boxes (Ringkasan Status) */
        .summary-table {
            margin-bottom: 20px;
        }

        .summary-box {
            background-color: #fafaf9;
            border: 1px solid #e7e5e4;
            border-radius: 6px;
            padding: 8px 12px;
            text-align: center;
        }

        .summary-label {
            font-size: 8px;
            font-weight: bold;
            color: #78716c;
            text-transform: uppercase;
        }

        .summary-value {
            font-size: 13px;
            font-weight: bold;
            color: #1c1917;
            margin-top: 2px;
        }

        /* Style Utama Tabel Pesanan */
        .data-table th {
            background-color: #f5f5f4;
            color: #44403c;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 8px 10px;
            border-bottom: 2px solid #e7e5e4;
            border-top: 1px solid #e7e5e4;
            text-align: left;
        }

        .data-table td {
            padding: 8px 10px;
            border-bottom: 1px solid #e7e5e4;
            font-size: 10px;
        }

        .order-number {
            font-family: monospace;
            font-size: 11px;
            font-weight: bold;
            color: #1c1917;
        }

        .customer-email {
            color: #78716c;
            font-size: 9px;
        }

        /* Badge Status */
        .badge {
            display: inline-block;
            padding: 2px 6px;
            font-size: 8px;
            font-weight: bold;
            border-radius: 4px;
            text-transform: uppercase;
            text-align: center;
        }

        .badge-pending {
            background-color: #fef9c3;
            color: #a16207;
        }

        .badge-processing {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .badge-shipped {
            background-color: #f3e8ff;
            color: #6b21a8;
        }

        .badge-completed {
            background-color: #dcfce7;
            color: #15803d;
        }

        .badge-cancelled {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .text-right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }
    </style>
</head>

<body>

    <table class="header-table">
        <tr>
            <td>
                <div class="brand-name">LaptopStore.</div>
                <div style="color: #78716c; font-size: 9px; margin-top: 2px;">Data Rekapitulasi Seluruh Transaksi Masuk
                </div>
            </td>
            <td>
                <h1 class="doc-title">LAPORAN TRANSAKSI</h1>
                <div style="text-align: right; font-size: 9px; color: #78716c; margin-top: 4px;">
                    Tanggal Cetak: {{ now()->format('d F Y H:i') }}
                </div>
            </td>
        </tr>
    </table>

    <table class="summary-table">
        <tr>
            <td width="32%" style="padding-right: 2%;">
                <div class="summary-box" style="border-left: 3px solid #16a34a;">
                    <div class="summary-label">Pendapatan Bersih (Selesai)</div>
                    <div class="summary-value" style="color: #15803d;">Rp {{ number_format($totalSales, 0, ',', '.') }}
                    </div>
                </div>
            </td>
            <td width="32%" style="padding-right: 2%;">
                <div class="summary-box" style="border-left: 3px solid #ca8a04;">
                    <div class="summary-label">Omset Tertunda (Pending)</div>
                    <div class="summary-value" style="color: #a16207;">Rp
                        {{ number_format($pendingSales, 0, ',', '.') }}</div>
                </div>
            </td>
            <td width="36%">
                <div class="summary-box">
                    <div class="summary-label">Rincian Volume Status Pesanan</div>
                    <div class="summary-value" style="font-size: 10px; margin-top: 4px; color: #44403c;">
                        {{ $countCompleted }} Selesai &bull;
                        {{ $countProcessing }} Proses &bull;
                        {{ $countPending }} Menunggu &bull;
                        {{ $countCancelled }} Batal
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <table class="data-table">
        <thead>
            <tr>
                <th width="20%">Order ID</th>
                <th width="20%">Tanggal Masuk</th>
                <th width="30%">Nama Pelanggan / Email</th>
                <th width="15%" class="text-right">Total Nilai</th>
                <th width="15%" style="text-align: center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                @php
                    // Mapping class badge status
                    $badges = [
                        'pending' => 'badge-pending',
                        'processing' => 'badge-processing',
                        'shipped' => 'badge-shipped',
                        'completed' => 'badge-completed',
                        'cancelled' => 'badge-cancelled',
                    ];
                    // Mapping label bahasa Indonesia
                    $labels = [
                        'pending' => 'Menunggu',
                        'processing' => 'Diproses',
                        'shipped' => 'Dikirim',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                    ];

                    $currentBadge = $badges[$order->status] ?? 'badge-pending';
                    $currentLabel = $labels[$order->status] ?? $order->status;
                @endphp
                <tr>
                    <td><span class="order-number">{{ $order->order_number }}</span></td>
                    <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                    <td>
                        <div class="bold">{{ $order->user->name }}</div>
                        <div class="customer-email">{{ $order->user->email }}</div>
                    </td>
                    <td class="text-right bold">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                    <td style="text-align: center;">
                        <span class="badge {{ $currentBadge }}">{{ $currentLabel }}</span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 30px; color: #78716c;">
                        Belum ada data pesanan tercatat di dalam sistem.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>
