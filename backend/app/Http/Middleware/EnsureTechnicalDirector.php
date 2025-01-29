<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Enum\Roles;

class EnsureTechnicalDirector
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {

        if (!auth()->check() || auth()->user()->role_id !== Roles::TECHNICAL_DIRECTOR->value) { // = Directeur technique
            return redirect()->route('login_get')->with('error', 'Accès non autorisé.');
        }

        return $next($request);
    }
}
