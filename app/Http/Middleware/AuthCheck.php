<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Verificar si el usuario está autenticado
         if (Auth::check()) {
            // Si el usuario está autenticado, continuar con la solicitud
            return $next($request);
        }

        // Si el usuario no está autenticado, redirigirlo al formulario de inicio de sesión
        return redirect()->route('login');
    }
    
}
