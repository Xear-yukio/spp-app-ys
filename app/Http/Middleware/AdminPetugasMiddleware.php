<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminPetugasMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && in_array(auth()->user()->level, ['admin', 'petugas'], true)) {
            return $next($request);
        }

        abort(403, 'Akses ditolak. Hanya Admin dan Petugas yang dapat mengakses halaman ini.');
    }
}