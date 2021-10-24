<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$auth)
    {
        $auth = empty($auth) ? [null] : $auth;

        foreach ($auth as $autth) {
            if (Auth::Auth($autth)->check()) {
                return redirect(url('/'));
            }
        }

        return $next($request);
    }
}
