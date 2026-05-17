@extends('layouts.app')
@section('title', 'Pesanan Berhasil | LaptopStore')

@section('content')
    <div class="relative pt-32 pb-24 bg-[#09090b] min-h-screen w-full overflow-hidden flex items-center justify-center">

        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[60vw] h-[60vh] bg-green-500/10 blur-[150px] rounded-full pointer-events-none">
        </div>
        <div
            class="absolute bottom-0 right-0 w-[30vw] h-[30vh] bg-blue-600/10 blur-[120px] rounded-full pointer-events-none">
        </div>

        <div class="w-full px-6 md:px-12 lg:px-24 relative z-10">

            <div class="max-w-4xl mx-auto">
                <div
                    class="bg-linear-to-br from-[#121214] to-[#0a0a0c] border border-white/5 rounded-[3rem] p-10 md:p-20 shadow-2xl text-center relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] opacity-[0.03] mix-blend-overlay pointer-events-none">
                    </div>

                    <div class="relative mb-10">
                        <div
                            class="w-24 h-24 md:w-32 md:h-32 rounded-full bg-green-500/10 border border-green-500/20 flex items-center justify-center mx-auto shadow-[0_0_50px_rgba(34,197,94,0.2)]">
                            <svg class="w-12 h-12 md:w-16 md:h-12 text-green-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </div>
                        <div
                            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-32 h-32 md:w-40 md:h-40 border-2 border-green-500/20 rounded-full animate-ping opacity-20">
                        </div>
                    </div>

                    <h1 class="text-4xl md:text-6xl font-extrabold text-white tracking-tight leading-tight mb-6">
                        Pesanan <span
                            class="text-transparent bg-clip-text bg-linear-to-r from-green-400 to-blue-400">Diterima.</span>
                    </h1>

                    <p class="text-gray-400 text-lg md:text-xl mb-12 font-light leading-relaxed max-w-2xl mx-auto">
                        Terima kasih telah mempercayakan kebutuhan teknologi Anda kepada kami. Pesanan Anda sedang kami
                        validasi dan akan segera masuk ke tahap pemrosesan.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-12 text-left">
                        <div class="bg-[#050505] border border-white/5 p-6 rounded-2xl">
                            <span class="text-xs text-gray-500 uppercase tracking-widest font-bold block mb-2">Nomor
                                Pesanan</span>
                            <span class="text-xl font-mono text-blue-400 font-bold">{{ $order->order_number }}</span>
                        </div>
                        <div class="bg-[#050505] border border-white/5 p-6 rounded-2xl">
                            <span class="text-xs text-gray-500 uppercase tracking-widest font-bold block mb-2">Total
                                Pembayaran</span>
                            <span class="text-xl text-white font-extrabold">Rp
                                {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div
                        class="bg-blue-500/5 border border-blue-500/10 p-8 rounded-3xl mb-12 text-left relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-4">
                            <svg class="w-12 h-12 text-blue-500/10" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-white font-bold mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Instruksi Pembayaran
                        </h3>
                        <p class="text-sm text-gray-400 mb-6 leading-relaxed">
                            Silakan lakukan transfer ke nomor Virtual Account berikut menggunakan metode
                            <b>{{ $order->payment->payment_method }}</b>. Pesanan akan otomatis terkonfirmasi setelah
                            pembayaran berhasil.
                        </p>
                        <div
                            class="flex items-center justify-between bg-[#050505] p-5 rounded-2xl border border-white/10 group cursor-pointer hover:border-blue-500/50 transition-colors">
                            <div>
                                <span class="text-[10px] text-gray-500 uppercase font-bold tracking-tighter">Nomor Virtual
                                    Account</span>
                                <p class="text-2xl font-mono text-white tracking-widest font-bold">8801202619451000</p>
                            </div>
                            <button
                                class="text-blue-400 text-xs font-bold uppercase tracking-widest hover:text-white transition-colors">Salin</button>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ url('/pesanan') }}"
                            class="inline-flex justify-center items-center px-10 py-4 font-bold text-[#09090b] bg-white rounded-full hover:bg-gray-200 transition-all duration-300 hover:scale-105">
                            Pantau Status Pesanan
                        </a>
                        <a href="{{ url('/katalog') }}"
                            class="inline-flex justify-center items-center px-10 py-4 font-bold text-white bg-transparent border border-white/10 rounded-full hover:bg-white/5 transition-all">
                            Lanjut Belanja
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
