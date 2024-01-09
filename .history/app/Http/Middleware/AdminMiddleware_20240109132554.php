<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;



class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Add your logic to check if the user is an admin (isAdmin = 1)
        if (auth()->check() && auth()->user()->isAdmin === 1) {
            return $next($request);
        }

        abort(403, 'Unauthorized action.'); // Return a forbidden response if not an admin
    }
}
