<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        // Menampilkan user terbaru, bisa customer atau admin
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:admin,customer',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna baru berhasil ditambahkan!');
    }

    public function show(User $user)
    {
        // Load relasi addresses dan orders untuk ditampilkan di halaman detail
        $user->load(['addresses', 'orders' => function ($query) {
            $query->latest()->take(5); // Ambil 5 transaksi terakhir saja
        }]);

        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:admin,customer',
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        // Siapkan data yang akan diupdate
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
        ];

        // Jika password diisi, maka ikut diupdate
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Data pengguna berhasil diperbarui!');
    }

    public function resetPassword(Request $request, string $id)
    {
        // 1. Cari data user berdasarkan ID
        $user = User::findOrFail($id);

        // 2. Tentukan password baru secara ACAK (misal: 8 karakter kombinasi huruf & angka)
        // Ini jauh lebih aman daripada 'password123' yang seragam untuk semua orang
        $defaultPassword = Str::random(8);

        // 3. Update password user di database dengan enkripsi Hash (Aman di DB)
        $user->update([
            'password' => Hash::make($defaultPassword)
        ]);

        // 4. Bersihkan nomor HP agar siap digunakan di link WhatsApp API
        $hp = $user->phone; // Sesuaikan dengan nama kolom di tabel kamu
        if (str_starts_with($hp, '0')) {
            $hp = '62' . substr($hp, 1);
        }
        $hp = str_replace([' ', '-', '+'], '', $hp);

        // 5. Kembalikan ke halaman sebelumnya dengan membawa data session sukses
        // Nilai $defaultPassword yang belum di-hash dikirim ke session agar Admin bisa meneruskannya ke WA Customer
        return redirect()->back()->with([
            'success' => "Password untuk {$user->name} berhasil di-reset menjadi: {$defaultPassword}",
            'new_password' => $defaultPassword,
            'customer_name' => $user->name,
            'customer_phone' => $hp
        ]);
    }

    public function destroy(User $user)
    {
        // 1. Mencegah admin menghapus dirinya sendiri
        if (Auth::id() === $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'Akses ditolak! Anda tidak dapat menghapus akun Anda sendiri.');
        }

        // 2. Mencegah hapus akun yang punya riwayat transaksi (untuk menjaga integritas database)
        if ($user->orders()->count() > 0) {
            return redirect()->route('admin.users.index')->with('error', 'Gagal dihapus! Pengguna ini memiliki riwayat transaksi.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus!');
    }
}
