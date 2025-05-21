<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Controleer of gebruiker is ingelogd en admin is
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403, 'Alleen beheerders hebben toegang tot deze pagina.');
        }

        return $next($request);
    }
}