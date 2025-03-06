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
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        $user = Auth::user();

        // If the user is not authenticated, send them to login
        if (!$user) {
            return redirect()->route('account.login');
        }

        // If the user does not have the required role, redirect to a Forbidden page or dashboard
        if (strtolower(trim($user->role->description)) !== strtolower(trim($role))) {
            abort(403, 'Unauthorized access'); // OR Redirect to a specific route
            // return redirect()->route('dashboard')->withErrors(['error' => 'Unauthorized Access']);
        }

        return $next($request);
    }
}
