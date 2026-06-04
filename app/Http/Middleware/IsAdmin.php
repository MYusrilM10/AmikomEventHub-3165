<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and has admin role
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        // Redirect non-admin users to login
        return redirect()->route('admin.login')->with('error', 'Akses ditolak. Anda tidak memiliki hak akses sebagai admin.');
    }
}
