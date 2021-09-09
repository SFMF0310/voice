<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        if (cas()->authenticate() && in_array($_SESSION['profil'],array(1,2))) {
            return $next($request);
       }

       else{
           return redirect('/acces_refuse');
       }
    }
}
