<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $expectedRole)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $nimLength = strlen($user->nim);

        $actualRole = match ($nimLength) {
            18 => 'dosenpa',
            10 => 'mahasiswa',
            5  => 'adminprodi',
            default => null,
        };

        if ($actualRole !== $expectedRole) {
            abort(403, 'Akses ditolak: Anda tidak punya izin.');
        }

        return $next($request);
    }
}