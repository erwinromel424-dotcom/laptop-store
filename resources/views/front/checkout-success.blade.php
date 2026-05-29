@extends('layouts.app')
@section('title', 'Order Success | LaptopStore')

@section('content')
    <div class="relative min-h-screen bg-[#09090b] flex items-center justify-center py-20">
        <div class="container max-w-2xl mx-auto px-6 relative z-10">
            <div class="bg-[#121214] border border-white/5 rounded-[2.5rem] p-8 md:p-12 shadow-2xl text-center">
                @if (session('success'))
                    <div
                        class="mb-6 rounded-2xl border border-green-500/20 bg-green-500/10 p-4 text-left text-sm text-green-100">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Header Sukses -->
                <div
                    class="w-20 h-20 bg-green-500/10 border border-green-500/20 rounded-3xl flex items-center justify-center mb-6 mx-auto">
                    <svg class="w-10 h-10 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">Sip, Pesanan Masuk!</h1>
                <p class="text-gray-500 mb-8 font-mono">#{{ $order->order_number }}</p>

                <!-- Box Info -->
                <div class="grid grid-cols-2 gap-4 mb-8 text-left">
                    <div class="bg-white/5 rounded-2xl p-4 border border-white/5">
                        <p class="text-[10px] uppercase text-gray-500 mb-1 font-bold">Total Bayar</p>
                        <p class="text-lg font-bold text-white">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-white/5 rounded-2xl p-4 border border-white/5">
                        <p class="text-[10px] uppercase text-gray-500 mb-1 font-bold">Metode</p>
                        <p class="text-lg font-bold text-white">{{ $order->payment->payment_method }}</p>
                    </div>
                </div>

                <!-- Logika Instruksi -->
                <div class="bg-black/40 rounded-3xl border border-white/5 p-6 mb-8 text-left">
                    @if ($order->payment->payment_method == 'COD')
                        <h4 class="text-white font-bold mb-1">Siapkan Uang Tunai</h4>
                        <p class="text-sm text-gray-500 italic">Bayar ke kurir pas barang sampai di rumah kamu ya.</p>
                    @else
                        <div class="mb-4">
                            <h4 class="text-white font-bold mb-1 text-lg">Transfer Ke VA</h4>
                            <p class="text-xs text-gray-500">Salin nomor di bawah & upload bukti fotonya.</p>
                        </div>

                        <!-- VA Box -->
                        <div
                            class="flex items-center justify-between bg-white/5 rounded-2xl p-4 mb-6 border border-white/10 group">
                            <p id="vaNumber" class="text-xl font-mono text-white font-bold tracking-widest leading-none">
                                8801202619451000</p>
                            <button type="button" onclick="copyToClipboard()" id="copyBtn"
                                class="bg-white text-black px-4 py-2 rounded-xl font-bold text-xs active:scale-95 transition-transform">
                                Salin
                            </button>
                        </div>

                        @if ($order->payment->payment_proof)
                            <div
                                class="rounded-2xl border border-green-500/20 bg-green-500/10 p-4 mb-6 text-sm text-green-100">
                                Bukti pembayaran sudah terkirim. Terima kasih, pesanannya segera diverifikasi.
                            </div>
                        @else
                            <!-- Form Upload Bukti -->
                            <form action="{{ route('checkout.uploadProof', $order->id) }}" method="POST"
                                enctype="multipart/form-data" class="space-y-4">
                                @csrf
                                <div
                                    class="relative border-2 border-dashed border-white/10 rounded-2xl p-4 hover:border-blue-500/50 transition-all">
                                    <input type="file" name="payment_proof"
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                        onchange="previewImage(this)">

                                    <div id="preview-container" class="hidden mb-2 text-center">
                                        <img id="image-preview" src="#" class="mx-auto max-h-32 rounded-lg">
                                    </div>

                                    <div id="upload-placeholder" class="text-center">
                                        <p class="text-xs text-gray-500">Klik untuk upload foto bukti transfer</p>
                                    </div>
                                </div>
                                <button type="submit"
                                    class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold text-sm transition-all shadow-lg">
                                    Kirim Bukti Pembayaran
                                </button>
                            </form>
                        @endif
                    @endif
                </div>

                <div class="mt-6 flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('customer.orders.show', $order->order_number) }}"
                        class="inline-flex items-center justify-center px-6 py-3 bg-white text-[#09090b] rounded-full font-bold hover:bg-gray-200 transition-all">
                        Pantau Pesanan
                    </a>
                    <a href="{{ url('/katalog') }}"
                        class="inline-flex items-center justify-center px-6 py-3 text-sm text-gray-500 hover:text-white transition-all underline">
                        Kembali Belanja
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyToClipboard() {
            // Gunakan trim() untuk hapus spasi tak terlihat
            const vaText = document.getElementById('vaNumber').innerText.trim();
            const btn = document.getElementById('copyBtn');

            // Cara cadangan jika navigator.clipboard gagal
            const textArea = document.createElement("textarea");
            textArea.value = vaText;
            document.body.appendChild(textArea);
            textArea.select();

            try {
                document.execCommand('copy');
                btn.innerText = 'Copied!';
                btn.classList.replace('bg-white', 'bg-green-500');
                btn.classList.add('text-white');
            } catch (err) {
                console.error('Fallback: Gagal menyalin', err);
            }

            document.body.removeChild(textArea);

            setTimeout(() => {
                btn.innerText = 'Salin';
                btn.classList.replace('bg-green-500', 'bg-white');
                btn.classList.remove('text-white');
            }, 2000);
        }

        // Fungsi Preview Foto
        function previewImage(input) {
            const preview = document.getElementById('image-preview');
            const container = document.getElementById('preview-container');
            const placeholder = document.getElementById('upload-placeholder');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    preview.src = e.target.result;
                    container.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
