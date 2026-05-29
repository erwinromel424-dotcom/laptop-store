<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan Analitik Sistem</title>
    <style>
        @page {
            margin: 40px;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #1c1917;
            font-size: 11px;
            line-height: 1.4;
        }

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

        /* Header */
        .report-header {
            border-bottom: 2px solid #e7e5e4;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .company-title {
            font-size: 22px;
            font-weight: bold;
            color: #1d4ed8;
        }

        .report-title {
            font-size: 18px;
            font-weight: bold;
            text-align: right;
            color: #44403c;
            margin: 0;
        }

        /* Cards Grid */
        .card-table {
            margin-bottom: 25px;
        }

        .card-box {
            background-color: #fafaf9;
            border: 1px solid #e7e5e4;
            border-radius: 8px;
            padding: 12px;
        }

        .card-label {
            font-size: 9px;
            font-weight: bold;
            color: #78716c;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .card-value {
            font-size: 15px;
            font-weight: 800;
            color: #1c1917;
            margin-top: 4px;
        }

        .card-subtext {
            font-size: 9px;
            margin-top: 4px;
            color: #78716c;
        }

        .text-green {
            color: #15803d;
            font-weight: bold;
        }

        .text-red {
            color: #b91c1c;
            font-weight: bold;
        }

        /* Main Section Grid */
        .section-title {
            font-size: 13px;
            font-weight: bold;
            color: #1c1917;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Safe PDF horizontal Bar Chart */
        .chart-row {
            border-bottom: 1px solid #f5f5f4;
        }

        .chart-label {
            width: 25%;
            padding: 6px 0;
            font-size: 10px;
        }

        .chart-bar-container {
            width: 50%;
            padding: 6px 0;
            vertical-align: middle;
        }

        .chart-bar {
            height: 10px;
            background-color: #3b82f6;
            border-radius: 3px;
        }

        .chart-value {
            width: 25%;
            padding: 6px 0;
            text-align: right;
            font-weight: bold;
            font-size: 10px;
        }

        /* Regular Data Table styling */
        .data-table th {
            background-color: #f5f5f4;
            color: #44403c;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 8px 10px;
            border-bottom: 2px solid #e7e5e4;
            text-align: left;
        }

        .data-table td {
            padding: 8px 10px;
            border-bottom: 1px solid #e7e5e4;
            font-size: 11px;
        }

        /* Badges */
        .badge {
            display: inline-block;
            padding: 2px 5px;
            font-size: 8px;
            font-weight: bold;
            border-radius: 3px;
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

        .badge-gray {
            background-color: #f5f5f4;
            color: #57534e;
        }
    </style>
</head>

<body>

    <table class="report-header">
        <tr>
            <td>
                <div class="company-title">LaptopStore.</div>
                <div style="color: #78716c; font-size: 10px; margin-top: 2px;">Laporan Analitik Internal & Ringkasan
                    Penjualan</div>
            </td>
            <td>
                <h1 class="report-title">OVERVIEW LAPORAN</h1>
                <div style="text-align: right; font-size: 10px; color: #78716c; margin-top: 4px;">
                    Dicetak Pada: {{ now()->format('d F Y H:i') }}
                </div>
            </td>
        </tr>
    </table>

    <table class="card-table">
        <tr>
            <td width="24%" style="padding-right: 1.33%;">
                <div class="card-box">
                    <div class="card-label">Total Pendapatan</div>
                    <div class="card-value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                    <div class="card-subtext">
                        <span class="{{ $revenueTrend >= 0 ? 'text-green' : 'text-red' }}">
                            {{ $revenueTrend >= 0 ? '+' : '' }}{{ number_format($revenueTrend, 1) }}%
                        </span> vs bln lalu
                    </div>
                </div>
            </td>
            <td width="24%" style="padding-right: 1.33%;">
                <div class="card-box">
                    <div class="card-label">Total Pesanan</div>
                    <div class="card-value">{{ $totalOrders }} Unit</div>
                    <div class="card-subtext">
                        <span class="{{ $ordersTrend >= 0 ? 'text-green' : 'text-red' }}">
                            {{ $ordersTrend >= 0 ? '+' : '' }}{{ number_format($ordersTrend, 1) }}%
                        </span> vs bln lalu
                    </div>
                </div>
            </td>
            <td width="24%" style="padding-right: 1.33%;">
                <div class="card-box">
                    <div class="card-label">Katalog Produk</div>
                    <div class="card-value">{{ $totalProducts }} Item</div>
                    <div class="card-subtext">
                        @if ($lowStockProducts > 0)
                            <span class="text-red">{{ $lowStockProducts }} Butuh Restock</span>
                        @else
                            <span style="color: #16a34a;">Stok Aman</span>
                        @endif
                    </div>
                </div>
            </td>
            <td width="24%">
                <div class="card-box">
                    <div class="card-label">Total Pelanggan</div>
                    <div class="card-value">{{ $totalCustomers }} User</div>
                    <div class="card-subtext text-green">
                        +{{ $newCustomersThisWeek }} Baru mggu ini
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <table style="margin-bottom: 30px;">
        <tr>
            <td width="55%" style="padding-right: 25px;">
                <div class="section-title">Grafik Pendapatan (7 Hari Terakhir)</div>
                <table style="margin-top: 5px;">
                    @foreach ($chartData as $data)
                        @php
                            // Menghitung lebar bar horizontal
                            $widthPercent = $data['revenue'] > 0 ? ($data['revenue'] / $maxRevenue) * 100 : 2;
                        @endphp
                        <tr class="chart-row">
                            <td class="chart-label">{{ $data['day_name'] }}</td>
                            <td class="chart-bar-container">
                                <div class="chart-bar" style="width: {{ $widthPercent }}%;"></div>
                            </td>
                            <td class="chart-value">Rp {{ number_format($data['revenue'], 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </table>
            </td>

            <td width="45%">
                <div class="section-title">Top Laptop Terlaris</div>
                <table class="data-table" style="margin-top: 5px;">
                    <thead>
                        <tr>
                            <th width="10%">Rank</th>
                            <th width="65%">Nama Produk</th>
                            <th width="25%" style="text-align: right;">Terjual</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topProducts as $index => $topProduct)
                            <tr>
                                <td style="font-weight: bold; color: #1d4ed8;">#{{ $index + 1 }}</td>
                                <td><strong>{{ $topProduct->name }}</strong></td>
                                <td style="text-align: right; font-weight: bold;">{{ $topProduct->total_sold }} Unit
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="text-align: center; color: #78716c;">Belum ada data penjualan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

    <div class="section-title">Riwayat Transaksi Terbaru</div>
    <table class="data-table" style="margin-top: 5px;">
        <thead>
            <tr>
                <th width="20%">Order ID</th>
                <th width="35%">Pelanggan</th>
                <th width="15%">Tanggal</th>
                <th width="15%">Total Harga</th>
                <th width="15%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentOrders as $order)
                <tr>
                    <td><strong style="font-family: monospace; font-size: 12px;">{{ $order->order_number }}</strong>
                    </td>
                    <td>
                        <strong>{{ $order->user->name }}</strong><br>
                        <small style="color: #6b7280;">{{ $order->user->email }}</small>
                    </td>
                    <td>{{ $order->created_at->format('d M Y') }}</td>
                    <td style="font-weight: bold;">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                    <td>
                        <span
                            class="badge {{ $order->status === 'completed' ? 'badge-success' : ($order->status === 'pending' ? 'badge-pending' : 'badge-gray') }}">
                            {{ $order->status === 'completed' ? 'Selesai' : ($order->status === 'pending' ? 'Menunggu' : $order->status) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 20px; color: #78716c;">Belum ada transaksi
                        terekam.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>
