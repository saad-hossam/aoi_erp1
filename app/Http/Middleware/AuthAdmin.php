<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthAdmin
{
    /**
     * Only administrators (EMP.ADMIN = 1, or the "admin" role) may pass.
     * A logged-in employee who is NOT an admin gets a 403 – we no longer flush
     * the session, which is what used to throw people back to the login page.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (! $user) {
            return redirect()->route('login');
        }

        if (! method_exists($user, 'isAdmin') || ! $user->isAdmin()) {
            abort(403, 'This area is for administrators only.');
        }

        return $next($request);
    }
}
