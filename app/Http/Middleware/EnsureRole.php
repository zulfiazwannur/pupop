<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Membatasi halaman berdasarkan role. Pemakaian di route: ->middleware('role:mitra')
 * Jika role tidak cocok, pengguna dialihkan ke beranda role miliknya sendiri.
 */
class EnsureRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if ($request->user()->role !== $role) {
            return redirect()->route($request->user()->role === 'mitra' ? 'mitra.home' : 'home');
        }

        return $next($request);
    }
}
