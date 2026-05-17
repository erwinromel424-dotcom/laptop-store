<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'recipient_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'full_address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
        ]);

        $user = Auth::user();

        // Jika ini adalah alamat pertama yang ditambahkan, otomatis jadikan alamat utama
        /** @var \App\Models\User $user */
        $isFirstAddress = $user->addresses()->count() === 0;

        Address::create([
            'user_id' => $user->id,
            'recipient_name' => $request->recipient_name,
            'phone_number' => $request->phone_number,
            'full_address' => $request->full_address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'is_primary' => $isFirstAddress,
        ]);

        return back()->with('success', 'Alamat baru berhasil ditambahkan.');
    }

    public function setPrimary(int $id)
    {
        $user = Auth::user();

        // Cari alamat dan pastikan itu milik user yang sedang login
        $address = Address::where('id', $id)->where('user_id', $user->id)->firstOrFail();

        // Ubah semua alamat user ini menjadi bukan utama
        /** @var \App\Models\User $user */
        $user->addresses()->update(['is_primary' => false]);

        // Jadikan alamat yang dipilih sebagai utama
        $address->update(['is_primary' => true]);

        return back()->with('success', 'Alamat utama berhasil diubah.');
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'recipient_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'full_address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
        ]);

        $user = Auth::user();

        // Cari alamat dan pastikan itu milik user yang sedang login
        $address = Address::where('id', $id)->where('user_id', $user->id)->firstOrFail();

        // Update data alamat
        $address->update([
            'recipient_name' => $request->recipient_name,
            'phone_number' => $request->phone_number,
            'full_address' => $request->full_address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
        ]);

        return back()->with('success', 'Data alamat berhasil diperbarui.');
    }

    public function destroy(int $id)
    {
        $user = Auth::user();
        $address = Address::where('id', $id)->where('user_id', $user->id)->firstOrFail();

        $wasPrimary = $address->is_primary;
        $address->delete();

        // Jika alamat yang dihapus adalah alamat utama, jadikan alamat lain (jika ada) sebagai utama secara otomatis
        if ($wasPrimary) {
            /** @var \App\Models\User $user */
            $nextAddress = $user->addresses()->first();
            if ($nextAddress) {
                $nextAddress->update(['is_primary' => true]);
            }
        }

        return back()->with('success', 'Alamat berhasil dihapus.');
    }
}
