<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRolesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        //not allow if not login in
        // if ( ! Auth::check()) {
        //     abort(403, 'Unauthorized action.');
        // }

        //not allow if not user don't have the right credentials
        if ( ! $request->user()->hasRole($role)) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
