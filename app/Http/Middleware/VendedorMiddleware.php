<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VendedorMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->hasRole('vendedor')) {
            return $next($request);
        }

        abort(403, 'No tienes permiso para acceder a esta sección');
    }
}
