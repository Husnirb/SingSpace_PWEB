<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // LOGIKA PENGECEKAN ROLE
        if ($request->user()->role === 'admin') {
            // Jika Admin, masuk ke Dashboard Panel
            return redirect()->intended(route('dashboard', absolute: false));
        }

        // Jika Customer biasa, arahkan kembali ke Katalog Ruangan
        // (Bisa juga diarahkan ke route('/') jika ingin ke Landing Page)
        return redirect()->intended(route('ruangan.catalog', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
