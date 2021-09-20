<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\VoiceClient;
use App\Models\VoiceContact;
use App\Models\ListeContact;
use App\Models\VoiceLangue;
use App\Imports\ContactImport;
use Maatwebsite\Excel\Facades\Excel;

class ContactController extends Controller
{


    public function index(){


        $contact= DB::select('select c.*,loc.nom as nomloc ,lan.nom as nomlan ,cl.nom as nomclient from voice_contact c ,ml_localite loc , voice_langue lan , voice_clients cl where c.localite=loc.id and c.langue_reception=lan.id and c.client=cl.id');
        
        $localite=DB::select('select a.id id, a.nom nom, b.nom commune from ml_localite a, ml_commune b where a.commune=b.id order by nom');
        $client=VoiceClient::all();
        $langue=VoiceLangue::all();



        return view('admin.contact',compact('contact','client','localite','langue'));
    }




    public function store (Request $request){

        $contact=new VoiceContact;
        
        $contact->prenom=$request->input('prenom');
        $contact->nom=$request->input('nom');
        $contact->genre=$request->input('genre');
        $contact->date_naissance=$request->input('date_naissance');
        $contact->lieu_naissance=$request->input('lieu_naissance');
        $contact->adresse=$request->input('adresse');
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
}
