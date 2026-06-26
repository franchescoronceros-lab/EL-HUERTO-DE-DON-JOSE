<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Verificar si el usuario ni siquiera ha iniciado sesión
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Verificar si el rol del usuario actual NO coincide con el permitido
        if (Auth::user()->role !== $role) {
            abort(403, 'Acceso no autorizado a este panel.');
        }

        return $next($request);
    }
}