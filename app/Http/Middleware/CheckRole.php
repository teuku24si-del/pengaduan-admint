<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('Auth.index');
        }

        // 2. Ambil role user yang sedang login
        $userRole = Auth::user()->role;

        // 3. Cek apakah role user ada di dalam daftar role yang diizinkan route ini
        // in_array mengecek apakah 'admin' ada di dalam array ['admin', 'staff'] misalnya.
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // 4. Jika role tidak sesuai, lempar ke halaman 403 atau Dashboard
        return abort(403, 'Akses Ditolak: Anda tidak memiliki izin untuk halaman ini.');
    }
}
