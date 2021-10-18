<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

                                    # Admin et SuperAdmin

        if (in_array($_SESSION['profil'],array(1,2))) {
        # code...

                $clients = DB::table('voice_clients')->orderBy('id','asc')->get() ;
                $nbProfils =  DB::table('voice_uprofil')->count('*');
                $nbCampagne = DB::table('voice_campagne')->count('*');
                $message = DB::table('voice_lam_resultat')->count('*');
                $successedMessage = DB::table('voice_lam_resultat')->where('callSuccessCount','=',0)->count('*') ;

                return view('admin.dashboard',compact('clients','nbProfils','nbCampagne','successedMessage','message'));
        }
        elseif(in_array($_SESSION['profil'],array(3))){

                $clients = DB::table('voice_uprofil')->selectRaw('*')->where('user',$_SESSION['user'])->orderBy('id','asc')->get() ;
                // $nbProfils =  DB::table('voice_uprofil')->selectRaw('count(*)')->groupBy('id');
                // $nbCampagne = DB::table('voice_campagne')->selectRaw('count(*)')->groupBy('id');
                return redirect("/client/".$clients[0]->id."/dashbaord");

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
