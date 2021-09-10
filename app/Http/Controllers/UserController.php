<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\VoiceProfil;
use App\Models\VoiceUprofil;
use App\Models\MlUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class Usercontroller extends Controller
{


    public function index(){

        $user=DB::select('select u.nom,u.prenom,u.mail,u.login,u.tel,d.id,p.intitule from ml_users u , voice_uprofil d ,voice_profil p  WHERE 1 AND u.id=d.user AND p.id = d.profil' );



        $mlUser=MlUser::all();
        $role=DB::select(' SELECT * FROM voice_profil WHERE id!=1');

        return view('admin.utilisateur',compact('user','mlUser','role'));
    }

    

     public function store (Request $request){

        $user=new VoiceUprofil;
        
        $user->user=$request->input('utilisateur');
        $user->profil=$request->input('role');
        $user->save();

            return redirect('/admin/utilisateur')->with('success','Utilisateur ajouté avec succès');

     }

    

    public function update(Request $request ,$id){
   
        $user= DB::select('select u.nom,u.prenom,u.login,d.id,d.profil from ml_users u , voice_uprofil d   WHERE 1 AND u.id=d.user AND d.id="'.$id.'"' );

        $role=DB::select(' SELECT * FROM voice_profil WHERE id!=1');

        
            return view('admin.updateUtilisateur',compact('user','role'));
        
    }

     public function updateSaving(Request $request ,$id){
   
        $user= VoiceUprofil::find($id);
        //$user->cni=$request->input('cni');
        // $user->prenom=$request->input('prenom');
        // $user->name=$request->input('name');
        // $user->email=$request->input('email');
        // $user->tel=$request->input('tel');
        //$user->numero_compte=$request->input('numero_compte');
        $user->profil=$request->input('profil');
        $user->update();

            return redirect('/admin/utilisateur')->with('success','Utilisateur modifié avec succès');

        
    }

    public function delete($id){
   
        $user= VoiceUprofil::findOrFail($id);
        $user->delete();

        return Redirect::back()->with('success','Utilisateur supprimé avec succès');
    }
}

