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

        if (in_array($_SESSION['profil'],array(1,2))) {

            $user=DB::select('select u.nom,u.prenom,u.mail,u.login,u.tel,d.id,p.intitule from ml_users u , voice_uprofil d ,voice_profil p  WHERE 1 AND u.id=d.user AND p.id = d.profil' );
            $mlUser=MlUser::all();
            $role=DB::select(' SELECT * FROM voice_profil WHERE id!=1');
            $clients = DB::table('voice_clients')->get();


            return view('admin.utilisateur',compact('user','mlUser','role','clients'));

        }
        elseif (in_array($_SESSION['profil'],array(3,4))) {

            $clients = DB::table('voice_clients')->get();
            $clientConnectes =DB::table('voice_uprofil')->where('user','=',$_SESSION['user'])->get();
            // $user = DB::table('voice_uprofil')->join('ml_users','voice_uprofil.user','=','ml_users.id')
            // ->join('voice_profil','voice_uprofil.profil','=','voice_profil.id')
            // ->where('voice_uprofil.id','=',$clientConnectes[0]->id)->get();
            $user=DB::select('select u.nom,u.prenom,u.mail,u.login,u.tel,d.id,p.intitule from ml_users u , voice_uprofil d ,voice_profil p WHERE  u.id=d.user AND p.id = d.profil AND d.client =32');
            $mlUser=MlUser::all();
            $role=DB::select(' SELECT * FROM voice_profil WHERE id != 1');

            return view('admin.utilisateur',compact('user','mlUser','role','clients'));


        }
}



    public function store (Request $request){
        $conn = ldap_connect("51.83.69.193", 389);
        $dn ='cn=admin,dc=mlouma,dc=com';
        $mdp = '9aeM%k*F7{3H';
        ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3);
        $bind = ldap_bind($conn, $dn, $mdp);
        $infos = array();
        // $infos['utilisateur'] =  $request->input('utilisateur');
        $infos['intitule'] =  $request->input('nom');
        $infos['prenom'] =  $request->input('prenom');
        $infos['role'] =  $request->input('role');
        $infos['email'] =  $request->input('email');
        $infos['tel'] =  $request->input('tel');
        $infos['login'] =  $request->input('login');
        $infos['mdp'] =  $request->input('mdp');
        $infos['client'] =  $request->input('client');
        // if(is_null($infos['utilisateur'])){
        if ($infos['role'] == 3) {
            $u = DB::table('ml_users')->where('tel', $infos['tel'])->value('id');
            $u = DB::table('ml_users')->selectRaw('*')->where('tel', $infos['tel'])->get();
            if (!empty($u[0])) {
                $newClient = DB::insert('insert into voice_clients (nom) values (?)', [$u[0]->nom]);
                if ($newClient) {
                    $ifProfilExist = DB::table('voice_uprofil')->where('user', $u[0]->id)->value('id');
                    if (!is_null($ifProfilExist)) {
                        if (in_array($_SESSION['profil'], array(1,2))) {
                            return redirect('/admin/utilisateur')->with('warning', 'Ce profil existe déja');
                        } else {
                            return redirect('/client/utilisateur')->with('warning', 'Ce profil existe déja');
                        }
                    } else {
                        $client=  DB::table('voice_clients')->where('nom', $u[0]->nom)->value('id');
                        $user=new VoiceUprofil;
                        $user->user=$u[0]->id;
                        $user->profil=3;
                        $user->client = $client;
                        $user->save();
                        if (in_array($_SESSION['profil'], array(1,2))) {
                            return redirect('/admin/utilisateur')->with('success', 'Profil ajouté avec succés');
                        } else {
                            return redirect('/cient/utilisateur')->with('success', 'Profil ajouté avec succés');
                        }
                    }
                } else {
                    if (in_array($_SESSION['profil'], array(1,2))) {
                        return redirect('/admin/utilisateur')->with('erreur', 'Profil non ajouté');
                    } else {
                        return redirect('/client/utilisateur')->with('erreur', 'Profil non ajouté');
                    }
                }
            } else {
                $newClient = DB::insert('insert into voice_clients (nom) values (?)', [$infos['intitule']]);
                if ($newClient) {
                    $user = new MlUser([
                        'prenom' => $infos['intitule'],
                        'nom' => $infos['intitule'],
                        'login' => $infos['login'],
                        'mdp' => md5($infos['mdp']),
                        'mail'=> $infos['email'],
                        'tel' => $infos['tel'],
                        'ldap' => 1
                    ]);
                    if ($user->save()) {
                        if ($bind) {
                            $entries['uid'] = $infos['login'];
                            $entries['cn'] =  $infos['intitule'];
                            $entries['sn'] = $infos['intitule'] ;
                            $entries['userPassword'] = $infos['mdp'] ;
                            $entries['objectclass'][1] = "top";
                            $entries['objectclass'][0] = "person";
                            $entries['objectclass'][2] = "inetOrgPerson";
                            $req = ldap_add($conn, "uid=".$infos['login'].",ou=people,dc=mlouma,dc=com", $entries);
                            if ($req) {
                                ldap_close($conn);
                                $u = DB::table('ml_users')->where('tel', $infos['tel'])->value('id');
                                $ifProfilExist = DB::table('voice_uprofil')->where('user', $u[0]->id)->value('id');
                                if (!is_null($ifProfilExist)) {
                                    if (in_array($_SESSION['profil'], array(1,2))) {
                                        return redirect('/admin/utilisateur')->with('warning', 'Ce profil existe déja');
                                    } else {
                                        return redirect('/client/utilisateur')->with('warning', 'Ce profil existe déja');
                                    }
                                } else {
                                    $user=new VoiceUprofil;
                                    $user->user=$u;
                                    $user->profil=3;
                                    $user->client = $infos['client'];
                                    $user->save();
                                    if (in_array($_SESSION['profil'], array(1,2))) {
                                        return redirect('/admin/utilisateur')->with('success', 'Profil ajouté avec succés');
                                    } else {
                                        return redirect('/client/utilisateur')->with('success', 'Profil ajouté avec succés');
                                    }
                                }
                            } else {
                                if (in_array($_SESSION['profil'], array(1,2))) {
                                    return redirect('/admin/utilisateur')->with('success', 'Profil ajouté avec succés');
                                } else {
                                    return redirect('/client/utilisateur')->with('erreur', 'Profil non ajouté');
                                }
                            }
                        } else {
                            // A continuer
                            if (in_array($_SESSION['profil'], array(1,2))) {
                                return redirect('/admin/utilisateur')->with('error', "Erreur survenue lors de l'ajout dans l'annuaire");
                            } else {
                                return redirect('/client/utilisateur')->with('error', "Erreur survenue lors de l'ajout dans l'annuaire");
                            }
                        }
                    } else {
                        if (in_array($_SESSION['profil'], array(1,2))) {

                            return redirect('/admin/utilisateur')->with('error', "Erreur survenue lors de la création de l'utilisateur");
                        } else {

                            return redirect('/client/utilisateur')->with('error', "Erreur survenue lors de la création de l'utilisateur");
                        }
                    }
                } else {
                    if (in_array($_SESSION['profil'], array(1,2))) {

                        return redirect('/admin/utilisateur')->with('error', "Erreur survenue lors de l'initialisation de la structure");
                    } else {

                        return redirect('/client/utilisateur')->with('error', "Erreur survenue lors de l'initialisation de la structure");
                    }
                }
            }
        } else {
            if (in_array($infos['role'], array(1,2,4))) {               /* ajout d'un administrateur ou de personnel */
                # code...
                $u = DB::table('ml_users')->where('tel', $infos['tel'])->value('id');
                if (!is_null($u)) {
                    $ifProfilExist = DB::table('voice_uprofil')->where('user', $u)->value('id');
                    if (!is_null($ifProfilExist)) {
                        if (in_array($_SESSION['profil'], array(1,2))) {

                            return redirect('/admin/utilisateur')->with('warning', 'Ce profil existe déja');

                        } else {

                            return redirect('/client/utilisateur')->with('warning', 'Ce profil existe déja');
                        }
                    } else {
                        $user=new VoiceUprofil;
                        $user->user=$u;
                        $user->profil=2;
                        if ($user->save()) {
                            if (in_array($_SESSION['profil'], array(1,2))) {
                                return redirect('/admin/utilisateur')->with('success', 'Profil ajouté avec succès');
                            } else {
                                return redirect('/client/utilisateur')->with('success', 'Profil ajouté avec succès');
                            }
                        } else {
                            if (in_array($_SESSION['profil'], array(1,2))) {
                                return redirect('/admin/utilisateur')->with('success', 'Profil non créé');
                            } else {
                                return redirect('/client/utilisateur')->with('success', 'Profil non créé');
                            }
                        }
                    }
                } else {
                    $user = new MlUser([
                            'prenom' => $infos['prenom'],
                            'nom' => $infos['intitule'],
                            'login' => $infos['login'],
                            'mdp' => md5($infos['mdp']),
                            'mail'=> $infos['email'],
                            'tel' => $infos['tel'],
                            'ldap' => 1
                        ]);
                    if ($user->save()) {
                        if ($bind) {
                            $entries['uid'] = $infos['login'];
                            $entries['cn'] =  $infos['intitule'];
                            $entries['sn'] = $infos['intitule'] ;
                            $entries['userPassword'] = $infos['mdp'] ;
                            // $entries['userPassword'] = $infos['email'] ;
                            $entries['objectclass'][1] = "top";
                            $entries['objectclass'][0] = "person";
                            $entries['objectclass'][2] = "inetOrgPerson";
                            $req = ldap_add($conn, "uid=".$infos['login'].",ou=people,dc=mlouma,dc=com", $entries);
                            if ($req) {
                                ldap_close($conn);
                                $u = DB::table('ml_users')->where('tel', $infos['tel'])->value('id');
                                $user=new VoiceUprofil;
                                $user->user=$u;
                                $user->profil=$infos['role'];
                                $user->client =($infos['role'] == 4) ? $infos['client'] : null;
                                $user->save();
                                if (in_array($_SESSION['profil'], array(1,2))) {
                                    return redirect('/admin/utilisateur')->with('success', 'Profil ajouté avec succès');
                                } else {
                                    return redirect('/client/utilisateur')->with('success', 'Profil ajouté avec succès');
                                }
                            } else {
                                if (in_array($_SESSION['profil'], array(1,2))) {
                                    return redirect('/admin/utilisateur')->with('error', "Profil non créé");
                                } else {
                                    return redirect('/client/utilisateur')->with('error', "Profil non créé");
                                }
                            }
                        } else {
                            if (in_array($_SESSION['profil'], array(1,2))) {
                                return redirect('/admin/utilisateur')->with('error', "Erreur survenue lors de l'ajout dans l'annuaire");
                            } else {
                                return redirect('/client/utilisateur')->with('error', "Erreur survenue lors de l'ajout dans l'annuaire");
                            }
                        }
                    } else {
                        if (in_array($_SESSION['profil'], array(1,2))) {
                            return redirect('/admin/utilisateur')->with('error', "Erreur survenue lors de la création de l'utilisateur");
                        } else {
                            return redirect('/client/utilisateur')->with('error', "Erreur survenue lors de la création de l'utilisateur");
                        }
                    }
                }
            }
        }
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
        if(in_array($_SESSION['profil'],array(1,2))){
            return redirect('/admin/utilisateur')->with('success','Utilisateur modifié avec succès');
        }
        elseif(in_array($_SESSION['profil'],array(3,4))){
            return redirect('/client/utilisateur')->with('success','Utilisateur modifié avec succès');
        }

    }

    public function delete($id){

        $user= VoiceUprofil::findOrFail($id);
        $user->delete();

        return Redirect::back()->with('success','Utilisateur supprimé avec succès');
    }
}

