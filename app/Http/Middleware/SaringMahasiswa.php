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

    
    public function handle(Request $request, Closure $next, ...$roles): Response
{
    // Cek apakah user sudah login
    if (!auth()->check()) {
        return redirect('login');
    }

    // Ubah parameter roles menjadi array jika dikirim via koma (misal: admin,dosen)
    // Jika tidak ada koma, parameter $roles tetap berupa array dengan satu elemen
    if (!in_array(auth()->user()->role, $roles)) {
        abort(403, 'Akses Ditolak! Anda tidak memiliki izin untuk mengakses halaman ini.');
    }

    return $next($request);
}
}