<?php

namespace App\Http\Middleware;

use Closure;

class Sindico
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
        if(!app('defender')->hasRoles('Sindico'))
            return redirect('403');

        return $next($request);
    }
}
