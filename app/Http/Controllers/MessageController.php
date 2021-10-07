<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VoiceCampagne;
use App\Models\VoiceLangue;

class MessageController extends Controller
{
    
    public function index(){

        $campagne=VoiceCampagne::all();
        $langue=VoiceLangue::all();

        return view('admin.message',compact('campagne','langue'));
    }


     public function store (Request $request){

        $message=new VoiceResultat;
        //$campagne=$request->input('campagne');

        $camp = intval($request->input('prenom'));
        $req = "select b.tel from voice_contact b, voice_campagne_contact a where b.id=a.contact and a.campagne=".$camp;
        $tels = $voiceup->executerReq($req);
        
//    print_r($uploadfile);
//    exit;
//    echo $req;
//    exit;
        $contacts = array();
        foreach ($tels as $key => $value) {
            $tt = trim(str_replace(" ", "", $value['tel']));
            if(strlen($tt) == 9){
                $num = '221'.$tt;
            } elseif (strlen($tt) == 12) {
                $num = $tt;
            } else{
                $num = NULL;
            }

            $contacts[] = $num;
            $k++;
        }
    
//        print_r($contacts);
//        exit;
        $i = $j = 0;
        // echo $uploadfile;
        // exit;
        if(move_uploaded_file($_FILES['audio']['tmp_name'], $uploadfile)){
            $historique->ajouter(array("type" => 5, "user" => $_SESSION['phpCAS']['utilisateur'], "valeur" => $nomfic));
            
            
            
            
            
            
            $fields = array(
                'login' => 'MLOUMA',
                'password' => 'svdnj328FHC',
//                'filename' => new \CurlFile('/var/www/html/voice/docs/audio/mlouma.mp3','audio/mp3', 'dip.mp3') 
                'filename' => new \CurlFile($uploadfile, $type, $nomfic) 
            );

            $ch = curl_init();

//            print_r($fields);
//            exit;
            curl_setopt($ch, CURLOPT_URL, 'https://voice.lafricamobile.com/api/Upload'); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Disposition: mulipart/form-data", ));
            $result = curl_exec($ch);

        //    print_r($result);
            $res = json_decode(substr($result, 0, -1));
        //    print_r($res);
            $clientFileName = $res->clientFileName;
            $serverFileName = $res->serverFileName;
            $url = $res->url;
            $extension = $res->extension;
            $mime = $res->mimeType;
        //    print_r(json_decode($result));
        //    echo serialize($result);
        //    
            
            
//            $contacts = array("221772357546", "221775348919‬", "221773242691", "772329618");
            $fields = array("login" => "MLOUMA",
                "password" => "svdnj328FHC",
                "filename" => $clientFileName, 
                "serverfilename" => $serverFileName,
                "campagnename" => "Campagne",
                "contacts" => $contacts
            );
        //        
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://voice.lafricamobile.com/api/Message'); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, 
                array(
                    "Content-Disposition: application/json", 
                ));
        //    
            $result = curl_exec($ch);

//            print_r($result);
//            $resultat = '{"id":420,"calls":[{"id":1321,"contactId":1081,"contactName":"Contact_[2\/10\/20 12:17:40]","contactFirstname":"Contact_[2\/10\/20 12:17:40]","start":null,"called":"00221772357546","callStateId":1,"callResultId":1}],"login":null,"count":0,"processingCallCount":0,"callSuccessCount":0,"callFailedCount":0,"callIgnoredCount":0,"campaignName":"Campagne_[2\/10\/20 12:18:12]","start":"2020-10-02T14:18:13","historyStateId":2,"messageFileName":"301.mp3"}';
            $res = json_decode($result);

            $tab_res = array();

            $tab_res["id_res"] = 1;
            $tab_res["login_res"] = $res->login;
            $tab_res["count_res"] = $res->count;
            $tab_res["processingCallCount"] = $res->processingCallCount;
            $tab_res["callSuccessCount"] = $res->callSuccessCount;
            $tab_res["callFailedCount"] = $res->callFailedCount;
            $tab_res["callIgnoredCount"] = $res->callIgnoredCount;
            $tab_res["campaignName"] = $res->campaignName;
            $tab_res["start_res"] = $res->start;
            $tab_res["historyStateId"] = $res->historyStateId;
            $tab_res["messageFileName"] = $res->messageFileName;

            $tab_contacts = array();
            foreach ($res->calls as $key => $value) {
                $tab_contacts["id"] = $value->contactId;
                $tab_contacts["contactName"] = $value->contactName;
                $tab_contacts["contactFirstname"] = $value->contactFirstname;
                $tab_contacts["start"] = $value->start;
                $tab_contacts["called"] = $value->called;
                $tab_contacts["callStateId"] = $value->callStateId;
                $tab_contacts["callResultId"] = $value->callResultId;
            }
//
            $tab_res["contacts"] = json_encode($tab_contacts);
            $tab_res["campagne"] = $camp;
            
            $infos = array("campagne" => $camp, "nom" => utf8_encode(strip_tags($_POST['nom'])), "user" => $_SESSION['phpCAS']['utilisateur'], "fichier" => $nomfic);
            if($message->ajouter($infos)){
//                echo "Fihier sauvegardé avec succès! ";
//               $infos["type"] = 6;
                $historique->ajouter(array("type" => 6, "user" => $infos["user"], "valeur" => serialize($infos)));
//                echo 'ok';
//                $camp = intval($_POST['campagne']);
//                $tab_res["campagne"] = $camp;
//                print_r($lam_resulat->ajouter($tab_res));
                
            }
            
            if($lam_resulat->ajouter($tab_res)){
                $historique->ajouter(array("type" => 7, "user" => $infos["user"], "valeur" => serialize($tab_res)));
//                echo "OK2";
            }
            
            echo "Envoi effectué avec succès. <br>Veuillez vérifier l'historique pour voir l'état des envois.";

        }
    


        
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

        return redirect('/admin/message')->with('success','Message envoyé avec succès');

    }



}
