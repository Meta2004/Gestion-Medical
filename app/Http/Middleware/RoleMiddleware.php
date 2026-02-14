<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!auth()->check()) {
        return redirect('/login');
        }
        if (auth()->user()->role !== $role) {
        abort(403);
        }

        //dd(auth()->user(), $role);

        // if (auth()->user()->role !== $role) {
        //     dd(auth()->user()->role, $role);
        //     abort(403);
        // }

        return $next($request);
    }
}