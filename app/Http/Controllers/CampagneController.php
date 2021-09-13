<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\VoiceCampagne;

class CampagneController extends Controller
{
    public function index(){

        

        if (in_array($_SESSION['profil'], array(1))) { 
            $req = DB::select('select a.id, a.intitule, a.created_at, b.prenom, b.nom, b.tel from voice_campagne a, ml_users b where a.user=b.id');
        } else if (in_array($_SESSION['profil'], array(2))) { 
            //$req = "select a.id, a.intitule, b.prenom, b.nom, b.tel from voice_campagne a, ml_users b where a.user=b.id";
        } else{
            //$req = "select a.id, b.prenom, b.nom, b.tel from voice_campagne a, ml_users b where a.user=b.id and 0=1";
        }



        // $mlUser=MlUser::all();
        // $role=DB::select(' SELECT * FROM voice_profil WHERE id!=1');

        return view('admin.campagne',compact('req'));
    }

    public function store (Request $request){

        $campagne=new VoiceCampagne;
        
        $campagne->intitule=$request->input('intitule');
        $campagne->user=$_SESSION['user'];
        $campagne->save();

        return redirect('/admin/campagne')->with('success','Campagne ajoutée avec succès');

    }
}
