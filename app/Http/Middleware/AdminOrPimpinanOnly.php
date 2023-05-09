<?php

namespace App\Http\Middleware;

use Closure;
use Laratrust\Laratrust;
use Illuminate\Http\Request;

class AdminOrPimpinanOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!($user && ($user->hasRole('administrator') || $user->hasRole('pimpinan')))) {
            abort(403, 'MAAF, ANDA TIDAK MEMILIKI AKSES UNTUK MASUK KE HALAMAN ADMIN.');
        }
        return $next($request);
    }
}