<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        if(in_array($_SESSION['profil'],array(1,2))){

            $client = DB::table('voice_clients')->selectRaw('*')->where('id',$id)->get();
            $clientProfils = DB::table('voice_uprofil')->join('ml_users','voice_uprofil.user','=','ml_users.id')->select('*','voice_uprofil.id as vpid')->where('voice_uprofil.client',$id)->get();
            $campagnes = DB::table('voice_campagne')->where('voice_campagne.client',$id)->count('*');
            return view('admin.clients.details',compact('client','clientProfils','campagnes'));
        }
        elseif ($_SESSION['profil'] == 3) {
            # code...
            $idClient = DB::table('voice_uprofil')->where('user','=',$_SESSION['user'])->value('client');
            $client = DB::table('voice_clients')->selectRaw('*')->where('id',$idClient)->get();
            $clientProfils = DB::table('voice_uprofil')->join('ml_users','voice_uprofil.user','=','ml_users.id')->select('*','voice_uprofil.id as vpid')->where('voice_uprofil.client',$idClient)->get();
            $campagnes = DB::table('voice_campagne')->where('voice_campagne.client',$idClient)->count('*');

            return view('admin.clients.details',compact('client','clientProfils','campagnes'));
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
        $profil=DB::table('voice_uprofil')->where('id',$id); 
        
        if($profil->delete()){
            return redirect("admin/client/".$id."/infos")->with('success','Profil supprimé avec succés');
        }else{
            return redirect("admin/client/".$id."/infos")->with('error','Erreur survenue lors de la suppression');

        }  
    }
}
