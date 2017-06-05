<?php

namespace App\Http\Middleware;

use Closure;

use App\User;

use Illuminate\Support\Facades\Auth;

class ValidateIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $rol = Auth::user()->rol();
        if ($rol != 'administrador') 
            return redirect('/')->with('notice', 'Lo sentimos, pero no tienes privilegios para realizar esta acción');
        return $next($request);
    }
}
