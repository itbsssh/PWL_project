<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SaringMahasiswa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role  <-- Kita tambahkan parameter role di sini
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Jika user belum login, atau role user TIDAK SAMA dengan role yang diizinkan rute
        if (!auth()->check() || auth()->user()->role !== $role) {
            abort(403, 'Akses Ditolak! Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}