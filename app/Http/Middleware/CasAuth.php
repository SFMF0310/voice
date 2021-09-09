<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CasController;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;

class CasAuth
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

        if( ! cas()->checkAuthentication() )
        {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            }

            cas()->authenticate();

        }
        $user = cas()->getUser();
        $login = DB::select("SELECT id from ml_users WHERE login='$user'");
        if(!empty($login)){

            $if_profil_exist =DB::table('voice_uprofil')
            ->join('ml_users','ml_users.id','=','voice_uprofil.user')
            ->join('voice_profil','voice_uprofil.profil','=','voice_profil.id')
            ->where('voice_uprofil.user' ,'=' ,$login[0]->id)->get();

            if(empty($if_profil_exist)){
                return response('Unauthorized', 401);

            }
            else{
                session()->put('cas_user', cas()->user() );
                $_SESSION['profil'] = $if_profil_exist[0]->profil;
                $_SESSION['role'] = $if_profil_exist[0]->intitule;
                return $next($request);
            }
        }
        else{
            return view('Unauthorized', 401);
        }
     

    }
}
