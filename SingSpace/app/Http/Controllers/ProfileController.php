<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage; // Penting untuk upload file
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information, foto profil, dan password.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        // Validasi input form (Nama, Email, Password, dan Aturan Foto)
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'confirmed', 'min:8'],
            'foto_profil' => ['nullable', 'image', 'mimes:jpg,png', 'max:2048'], // Sesuai syarat: JPG/PNG, Maks 2MB
        ]);

        // Update Nama dan Email
        $user->name = $request->name;
        $user->email = $request->email;

        // Jika form password diisi, update password-nya (Enkripsi)
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Proses Logika Upload Foto Profil
        if ($request->hasFile('foto_profil')) {
            // Hapus foto lama dari storage jika sebelumnya sudah punya foto
            if ($user->foto_profil && Storage::disk('public')->exists($user->foto_profil)) {
                Storage::disk('public')->delete($user->foto_profil);
            }

            // Simpan foto baru ke folder storage/app/public/profile_photos
            $path = $request->file('foto_profil')->store('profile_photos', 'public');
            $user->foto_profil = $path;
        }

        $user->save();

        // Redirect dengan membawa pesan sukses untuk Ultimate Toast kita
        return Redirect::route('profile.edit')->with('success', 'Data personal SingSpace kamu berhasil diperbarui!');
    }

    /**
     * Delete the user's account. (Dibiarkan jika suatu saat dibutuhkan)
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
