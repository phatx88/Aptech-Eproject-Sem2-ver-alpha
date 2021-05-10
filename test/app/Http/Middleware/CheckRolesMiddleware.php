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
    public function handle($request, Closure $next, ...$roles)
    {
        //not allow if not login in
        // if ( ! Auth::check()) {
        //     abort(403, 'Unauthorized action.');
        // }
        // $role shoule be staff or user only 
        //not allow if not user don't have the right credentials
            // dd($roles);
            foreach ($roles as $role) {
                if ( $request->user()->role() == $role) {
                    return $next($request);
                }
            }
        return redirect()->route('login');

    }
}
