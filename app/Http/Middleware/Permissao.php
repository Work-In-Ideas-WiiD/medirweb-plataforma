<?php

namespace App\Http\Middleware;

use Closure;

class Permissao
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $tipo_usuario = 'administrador')
    {
        // if(!app('defender')->hasRoles(ucfirst($tipo_usuario)))
        //     return redirect('403');

        return $next($request);
    }
}
