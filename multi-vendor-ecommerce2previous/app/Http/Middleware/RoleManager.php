<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleManager
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $authUserRole = Auth::user()->role_id;

        // Role checking
        switch ($role) {
            case 'admin':
                if ($authUserRole == 1) { // admin id = 1
                    return $next($request);
                }
                break;
            case 'vendor':
                if ($authUserRole == 2) {
                    return $next($request);
                }
                break;
            case 'customer':
                if ($authUserRole == 3) {
                    return $next($request);
                }
                break;
        }

        // Redirect based on role
        switch ($authUserRole) {
            case 1: return redirect()->route('admin');
            case 2: return redirect()->route('vendor');
            case 3: return redirect()->route('dashboard');
        }

        return redirect()->route('login');
    }
}
