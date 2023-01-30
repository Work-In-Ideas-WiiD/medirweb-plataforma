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
        foreach (explode('|', $tipo_usuario) as $role) {
            
            if(!app('defender')->hasRoles(ucfirst($role) and empty($redirect)))
                $redirect = true;            
        }
        
        if (!empty($redirect))
            return redirect('403');

        return $next($request);
    }
}
