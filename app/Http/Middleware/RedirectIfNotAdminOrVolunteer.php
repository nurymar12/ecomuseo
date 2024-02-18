<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importa la fachada Auth aquí
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotAdminOrVolunteer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->hasRole('Visitor')) {
            return redirect('/');
        }


        return $next($request);
    }
}
