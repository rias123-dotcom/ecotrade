<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        // Simple check: admin email match. Replace with role checks in real app.
        if (!$user || $user->email !== 'admin@ecotrade.test') {
            abort(403, 'Unauthorized');
        }
        return $next($request);
    }
}
