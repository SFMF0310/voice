<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\VoiceClient;
use App\Models\ListeContact;
use Illuminate\Support\Facades\Redirect;

class ListeController extends Controller
{


     public function index(){


        $liste= DB::select('select l.id,l.nom as nomliste ,l.created_at, c.nom as nomclient from voice_clients c , voice_liste_contact l where c.id=l.client');
        $client=VoiceClient::all();

        return view('admin.listeContact',compact('client','liste'));
    }

    public function store (Request $request){

        $liste=new ListeContact;
        
      
        $liste->nom=$request->input('nom');
        $liste->client=$request->input('client');
    
        $liste->save();

        return redirect('/admin/liste')->with('success','Liste ajouté avec succès');

    }

    public function delete($id){
   
        $liste= ListeContact::findOrFail($id);
        $liste->delete();

        return Redirect::back()->with('success','Liste supprimée avec succès');
    }

    public function update(Request $request ,$id){
   
        $liste= DB::select('select l.id,l.nom as nomliste ,l.client,l.created_at, c.nom as nomclient from voice_clients c , voice_liste_contact l where c.id=l.client and  l.id="'.$id.'"' );

        $client=VoiceClient::all();

        
            return view('admin.updateListeContact',compact('liste','client'));
        
    }


         public function updateSaving(Request $request ,$id){
   
        $liste= ListeContact::find($id);
       
        $liste->nom=$request->input('nom');
        $liste->client=$request->input('client');

        $liste->update();

        return redirect('/admin/liste')->with('success','Liste modifiée avec succès');

        
    }



}


