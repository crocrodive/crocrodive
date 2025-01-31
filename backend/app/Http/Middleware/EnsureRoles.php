<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Enum\Roles;

class EnsureRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $userRole = Roles::from(auth()->user()->role_id)->name;

        if (!in_array($userRole, $roles)) {
            return redirect()->route('login_get')->with('error', 'Accès non autorisé.');
        }

        return $next($request);
    }
}
