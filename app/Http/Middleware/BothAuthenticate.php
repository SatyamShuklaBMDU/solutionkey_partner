<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BothAuthenticate
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('web')->check() && !Auth::guard('admins')->check()) {
            // Neither user nor admin is authenticated
            return redirect('login');
        }
        return $next($request);
    }
}
