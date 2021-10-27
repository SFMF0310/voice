<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(in_array($_SESSION['profil'],array(1,2))){
            $hists = DB::table('voice_historique')->join('voice_type_histo','voice_historique.type','=','voice_type_histo.id')->join('ml_users','voice_historique.user','=','ml_users.id')->get();
            return view('admin.historique',compact('hists')) ;
        }
        elseif ($_SESSION['profil'] == 3) {

            # code...
            $hists = DB::table('voice_historique')->join('voice_type_histo','voice_historique.type','=','voice_type_histo.id')->join('ml_users','voice_historique.user','=','ml_users.id')->where('voice_historique.user','=',$_SESSION['user'])->get();
            return view('admin.historique',compact('hists')) ;
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
