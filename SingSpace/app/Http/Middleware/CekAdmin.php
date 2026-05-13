<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // gunakan $request->user() sebagai pengganti auth()
        if ($request->user() && $request->user()->role === 'admin') {
            return $next($request);
        }

        // Jika bukan admin, kembalikan ke beranda dengan pesan peringatan
        return redirect('/dashboard')->with('error', 'Akses ditolak! Halaman ini khusus Administrator SingSpace.');
    }
}
