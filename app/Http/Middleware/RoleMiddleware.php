<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Check if the user is logged in
        if (!Auth::check()) {
            // This is a backup; the 'auth' middleware should handle this.
            return redirect('login');
        }

        // 2. Get the authenticated user
        $user = Auth::user();

        // 3. Check if the user's role is in the list of allowed roles
        if (!in_array($user->role, $roles)) {
            // If not, they are not authorized. Abort with a 403 Forbidden error.
            abort(403, 'Unauthorized Action');
        }

        // 4. If the role matches, allow the request to proceed
        return $next($request);
    }
}