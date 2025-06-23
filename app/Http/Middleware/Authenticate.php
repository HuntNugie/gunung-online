<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Tentukan ke mana pengguna akan diarahkan jika mereka tidak terautentikasi.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            // Cek apakah URL-nya mengarah ke area admin
            if ($request->is('admin/*')) {
                return route('admin.login');
            }
            // Default redirect untuk user biasa
            return route('login');
        }

        return null;
    }
}
