<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {


        if (Auth::guard($guard)->check()) {

            if (auth()->user()->rol == "alumno") {
              return redirect('alumno\index');
            }elseif (auth()->user()->rol == "admin") {
              return redirect('administrador\index');
            }elseif (auth()->user()->rol == "coordinador") {
              return redirect('coordinador\index');
            }
        }

        return $next($request);
    }
}
