<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $user = User::find(session('user_id'));

        if (!$user) {
            return redirect('/login');
        }

        if (strtolower($user->role) !== 'admin') {
            return redirect('/dashboard')->with('error', 'Acceso denegado');
        }

        return $next($request);
    }
}