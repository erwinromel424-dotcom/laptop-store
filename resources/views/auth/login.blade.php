<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-white tracking-tight">Selamat Datang Kembali</h2>
        <p class="text-sm text-gray-500 mt-1">Silakan masuk ke akun Anda.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-gray-400 mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                autocomplete="username"
                class="w-full px-4 py-3 bg-[#09090b] border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all placeholder-gray-600"
                placeholder="nama@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-sm" />
        </div>

        <div>
            <div class="flex items-center justify-between mb-1">
                <label for="password" class="block text-sm font-medium text-gray-400">Password</label>

                {{-- Tautan dialihkan ke fungsi JavaScript dengan validasi pra-pengalihan --}}
                <a href="#" onclick="hubungiAdmin(event)"
                    class="text-xs font-medium text-blue-500 hover:text-blue-400 transition-colors">
                    Lupa password?
                </a>
            </div>

            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="w-full px-4 py-3 bg-[#09090b] border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all placeholder-gray-600"
                placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-sm" />
        </div>

        <div class="flex items-center">
            <input id="remember_me" type="checkbox" name="remember"
                class="w-4 h-4 rounded border-white/10 bg-[#09090b] text-blue-600 focus:ring-blue-500/50 focus:ring-offset-0">
            <label for="remember_me" class="ml-2 text-sm text-gray-400">Ingat Saya</label>
        </div>

        <div class="pt-2">
            <button type="submit"
                class="w-full py-3 px-4 bg-white text-[#09090b] font-bold rounded-xl hover:bg-gray-200 hover:scale-[1.02] transition-all duration-300 shadow-[0_0_20px_rgba(255,255,255,0.1)]">
                Masuk Sistem
            </button>
        </div>

        <p class="text-center text-sm text-gray-500 mt-6">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-bold text-white hover:text-blue-400 transition-colors">
                Daftar sekarang
            </a>
        </p>
    </form>

    <div class="mt-8 p-4 bg-blue-500/5 border border-blue-500/10 rounded-2xl">
        <p class="text-[10px] text-gray-500 text-center leading-relaxed">
            <span class="text-blue-400 font-bold text-[11px] block mb-1">INFO RESET PASSWORD</span>
            Jika lupa password, silakan isi kolom Email Anda terlebih dahulu, kemudian klik link "Lupa password?" untuk
            konfirmasi via WhatsApp Admin.
        </p>
    </div>

    {{-- Logic JavaScript yang Diperbaiki dengan Sistem Validasi Input --}}
    <script>
        function hubungiAdmin(event) {
            event.preventDefault();

            // 1. Ambil elemen input email dan bersihkan spasi
            const emailField = document.getElementById('email');
            const emailInput = emailField.value.trim();

            // 2. Validasi: Jika input email masih kosong, gagalkan proses ke WA dan beri peringatan
            if (!emailInput) {
                alert('Silakan isi kolom Email Anda terlebih dahulu sebelum meminta reset password!');
                emailField.focus(); // Arahkan kursor fokus secara otomatis ke kolom email
                return false;
            }

            // 3. Konfigurasi data API WhatsApp tujuan jika validasi lolos
            const nomorWA = "62882001969846";
            let pesan =
                "Halo%20Admin%20LaptopStore,%20saya%20lupa%20password%20akun%20saya.%20Mohon%20bantuannya%20untuk%20reset%20password.";

            // Menggabungkan pesan utama dengan variabel email yang telah diisi
            pesan += `%0A%0AAkun%20Email%20Saya%3A%20*${encodeURIComponent(emailInput)}*`;

            // 4. Buka tautan WhatsApp di tab browser baru
            window.open(`https://wa.me/${nomorWA}?text=${pesan}`, '_blank');
        }
    </script>
</x-guest-layout>
