<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\VoiceCampagne;
use Illuminate\Support\Facades\Redirect;

class CampagneController extends Controller
{
    public function index(){

        

        if (in_array($_SESSION['profil'], array(1,2))) { 
            $campagne = DB::select('select a.id, a.intitule, a.created_at, b.prenom, b.nom, b.tel from voice_campagne a, ml_users b where a.user=b.id');
        }else{
            $campagne = DB::select('select a.id, a.intitule, a.created_at, b.prenom, b.nom, b.tel from voice_campagne a, ml_users b where a.user=b.id and a.user="'.$_SESSION['user'].'" ');
        }



        // $mlUser=MlUser::all();
        // $role=DB::select(' SELECT * FROM voice_profil WHERE id!=1');

        return view('admin.campagne',compact('campagne'));
    }

    public function store (Request $request){

        $campagne=new VoiceCampagne;
        
        $campagne->intitule=$request->input('intitule');
        $campagne->user=$_SESSION['user'];
        $campagne->save();

        return redirect('/admin/campagne')->with('success','Campagne ajoutée avec succès');

    }

    public function delete($id){
   
        $campagne= VoiceCampagne::findOrFail($id);
        $campagne->delete();

        return Redirect::back()->with('success','Campagne supprimée avec succès');
    }

    public function update(Request $request ,$id){
   
        $campagne = DB::select('select a.id, a.intitule, a.created_at, b.prenom, b.nom, b.tel from voice_campagne a, ml_users b where a.user=b.id and a.id="'.$id.'" ');

          //  echo "fgsdhf";
        
            return view('admin.updateCampagne',compact('campagne'));
        
    }

    public function updateSaving(Request $request ,$id){
   
        $campagne= VoiceCampagne::find($id);
        $campagne->intitule=$request->input('intitule');
        $campagne->update();

            return redirect('/admin/campagne')->with('success','Campagne modifiée avec succès');

        
    }

    public function details(Request $request ,$id){
   
        $campagne = DB::select('select a.id, a.intitule, a.created_at, b.prenom, b.nom, b.tel from voice_campagne a, ml_users b where a.user=b.id and a.id="'.$id.'" ');

          //  echo "fgsdhf";
        
            return view('admin.detailsCampagne',compact('campagne'));
    }
}
