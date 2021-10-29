<?php

namespace App\Http\Middleware;

use Closure;

class ClientMiddleware
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
        if (cas()->authenticate() && in_array($_SESSION['profil'],array(3,4))) {
            return $next($request);
       }

       else{
           return redirect('/acces_refuse');
       }
    }
}
