<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\VoiceClient;
use App\Models\VoiceContact;
use App\Models\ListeContact;
use App\Models\VoiceLangue;
use App\Models\VoiceLocalite;
use App\Models\VoiceCommune;
use App\Models\VoiceDepartement;
use App\Imports\ContactImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;

class ContactController extends Controller
{


    public function index(){


        //$contact= DB::select('select c.*,loc.nom as nomloc ,lan.nom as nomlan ,cl.nom as nomclient from voice_contact c ,ml_localite loc , voice_langue lan , voice_clients cl where c.localite=loc.id and c.langue_reception=lan.id and c.client=cl.id');

        $contact=VoiceContact::all();

        if($_SESSION['profil']==3 || $_SESSION['profil'] == 4){

            $client=DB::select('select client from voice_uprofil where user="'.$_SESSION['user'].'" ');

            $contact=VoiceContact::where('client', $client[0]->client)->get();
            //var_dump($contact);
            
        }

        $localite=DB::select('select a.id id, a.nom nom, b.nom commune from ml_localite a, ml_commune b where a.commune=b.id order by nom');
        $departement=DB::select('select * from ml_departement');
        $client=VoiceClient::all();
        $langue=VoiceLangue::all();

        


        return view('admin.contact',compact('contact','client','localite','langue','departement'));
    }




    public function store (Request $request){

        $contact=new VoiceContact;
        
        $contact->prenom=$request->input('prenom');
        $contact->nom=$request->input('nom');
        $contact->genre=$request->input('genre');
        $contact->date_naissance=$request->input('date_naissance');
        $contact->lieu_naissance=$request->input('lieu_naissance');
        $contact->adresse=$request->input('adresse');
        $contact->departement=$request->input('departement');
        $contact->commune=$request->input('commune');
        $contact->localite=$request->input('localite');
        $contact->langue_reception=$request->input('langue_reception');
        $contact->tel=$request->input('tel');
        $contact->client=$request->input('client');
        $contact->createur=$_SESSION['user'];
        $contact->save();

        return redirect('/admin/contact')->with('success','Contact ajouté avec succès');

    }

    public function import(Request $request) 
    {

        $_SESSION['client_csv']=$request->input('client');

        Excel::import(new ContactImport,request()->file('csv_file'));
           
        return back()->with('success','Liste ajoutée avec succès');
    }

    public function update(Request $request ,$id){
   
        $liste= /*DB::select('select l.id,l.nom as nomliste ,l.client,l.created_at, c.nom as nomclient from voice_clients c , voice_liste_contact l where c.id=l.client and  l.id="'.$id.'"' )*/'';

        $contact=VoiceContact::findOrFail($id);
        $client=VoiceClient::all();
        $langue=VoiceLangue::all();
        $localite=VoiceLocalite::all();
        $departement=VoiceDepartement::all();
        $commune=VoiceCommune::all();

        
        return view('admin.updateContact',compact('liste','contact','client','langue','localite','departement','commune'));
        
    }

    public function updateSaving(Request $request ,$id){
   
        $contact=VoiceContact::findOrFail($id);
        $contact->prenom=$request->input('prenom');
        $contact->nom=$request->input('nom');
        $contact->genre=$request->input('genre');
        $contact->date_naissance=$request->input('date_naissance');
        $contact->lieu_naissance=$request->input('lieu_naissance');
        $contact->adresse=$request->input('adresse');
        $contact->departement=$request->input('departement');
        $contact->commune=$request->input('commune');
        $contact->localite=$request->input('localite');
        $contact->langue_reception=$request->input('langue_reception');
        $contact->tel=$request->input('tel');
        $contact->client=$request->input('client');
        $contact->update();
       

        return redirect('/admin/contact')->with('success','Contact modifié avec succès');

        
    }

    public function details(Request $request ,$id){
   
        $liste= /*DB::select('select l.id,l.nom as nomliste ,l.client,l.created_at, c.nom as nomclient from voice_clients c , voice_liste_contact l where c.id=l.client and  l.id="'.$id.'"' )*/'';

        //$campagneContact=DB::select('select con.nom ,con.prenom ,con ="'.$id.'"' );

        $contact=VoiceContact::findOrFail($id);
        $client=VoiceClient::all();
        $langue=VoiceLangue::all();
        $localite=VoiceLocalite::all();
        $departement=VoiceDepartement::all();
        $commune=VoiceCommune::all();
        return view('admin.detailsContact',compact('liste','contact','client','langue','localite','commune','departement'));
    }

    public function delete($id){
   
        $contact= VoiceContact::findOrFail($id);
        $contact->delete();

        return Redirect::back()->with('success','Contact supprimé avec succès');
    }

}
