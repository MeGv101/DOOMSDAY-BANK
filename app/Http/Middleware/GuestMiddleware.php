<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {

            return redirect('/dashboard')
                ->with(
                    'info',
                    'Ya tienes una sesión iniciada'
                );
        }

        return $next($request);
    }
}