<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use App\Models\MlUser;
use App\Models\VoiceProfil;
use App\Models\VoiceUprofil;
use Illuminate\Http\Request;
use Adldap\Laravel\Facades\Adldap;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        $utilisateur = $request->input('utilisateur');
        if(is_null($utilisateur)){
            $user=new VoiceUprofil;
            $user->user=$utilisateur;
            $user->profil=$request->input('role');
            $user->save();
        }
        else{
            $personnelUser =  new MlUser([
                'prenom' => $request->input('prenom'),
                'nom' => $request->input('nom'),
                'tel' => $request->input('tel'),
                'login'=> $request->input('login'),
                'mdp' => md5($request->input('mdp')),
                'ldap' => 1
            ]);
            $conn = ldap_connect("51.83.69.193",389);
            $dn ='cn=admin,dc=mlouma,dc=com';
            $mdp = '9aeM%k*F7{3H';
            ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3);
            $bind = ldap_bind($conn, $dn, $mdp);
            if ($bind)
            {

                $entries = array();
                $entries['uid'] = $request->input('login');
                $entries['cn'] = $request->input('nom');
                $entries['sn'] = $request->input('prenom');
                $entries['userPassword'] = $request->input('mdp');
                $entries['objectclass'][1] = "top";
                $entries['objectclass'][0] = "person";
                $entries['objectclass'][2] = "inetOrgPerson";
                $req = ldap_add($conn,"uid=".$request->input('login').",ou=people,dc=mlouma,dc=com",$entries);
                if ($req) {
                    # code...
                    $res = $personnelUser->save();
                    if ($res) {
                        $newUser = new MlUser;
                        $req = $newUser::where('tel',$request->input('tel'))->get();
                        if (!empty($req)){
                            # code...
                            foreach ($req as $u) {
                                $user=new VoiceUprofil;
                                $user->user=$u->id;
                                $user->profil=4;
                                $user->save();
                                return redirect('/admin/utilisateur')->with('success','Profil ajouté avec succès');

                            }
                        }
                        else{
                            return redirect('/admin/utilisateur')->with('error','Profil non creer');

                        }
                        return redirect('/admin/utilisateur')->with('success','Utilisateur ajouté avec succès');



            }       else{
                    return redirect('/admin/utilisateur')->with('error','Utilisateur non creer');
                  }


            }

            }
        }

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

