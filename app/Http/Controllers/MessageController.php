<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VoiceCampagne;
use App\Models\VoiceLangue;
use App\Models\VoiceResultat;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    
    public function index(){

        $campagne=VoiceCampagne::all();
        $langue=VoiceLangue::all();

        return view('admin.message',compact('campagne','langue'));
    }


     public function store (Request $request){

        
        //$campagne=$request->input('campagne');

        $campagne = $request->input('campagne');

        $telCampagne=DB::select('select con.tel from voice_contact con , voice_campagne_contact cam where cam.contact=con.id and cam.campagne = "'.$request->input('campagne').'" and langue_reception = "'.$request->input('langue').'" ');


        $contacts = array();
        $j = $k = 0;
        foreach ($telCampagne as $datatel) {
           // var_dump ( $datatel->tel);
            $tt = trim(str_replace(" ", "", $datatel->tel));
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
    

        $i = $j = 0;
        
            
		//$user->update(); 
        //echo $request->file('audio');
        
// exit;
        if (!empty($request->file('audio'))) {
           // echo "<br>". $request->file('audio');
            // $i = 0;
            foreach($request->file('audio') as $file){
              //  echo "<br>". $request->input('langue');
                $audioName = time() . $i . '.' . $file->getClientOriginalExtension();
             // echo $audioName;
             // exit;
               $fichier=public_path('/assets/audio');
                $path = $file->move($fichier, $audioName); 
                $data[] = $audioName; 
                $i++;
           }
    
        }
           // exit;
            
            
            
            $fields = array(
                'login' => 'MLOUMA',
                'password' => 'svdnj328FHC',
//                'filename' => new \CurlFile('/var/www/html/voice/docs/audio/mlouma.mp3','audio/mp3', 'dip.mp3') 
                'filename' => new \CurlFile(public_path('/assets/audio/'.$audioName),'audio/mp3', 'dip.mp3'),
            );

            $ch = curl_init();

//            print_r($fields);
            //echo $audioName;
           //exit;
            curl_setopt($ch, CURLOPT_URL, 'https://voice.lafricamobile.com/api/Upload'); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Disposition: mulipart/form-data", ));
            $result = curl_exec($ch);

        //print_r($result);
        //exit;
            $res = json_decode(substr($result, 0, -1));
          //print_r($res);
          //exit;
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
                 $tab_res["contacts"] = json_encode($tab_contacts);

            $message=new VoiceResultat;
            $message->id_res=$tab_res["id_res"];
            $message->campagne=$request->input('campagne');
            $message->login_res=$tab_res["login_res"];
            $message->count_res=$tab_res["count_res"];
            $message->processingCallCount=$tab_res["processingCallCount"];
            $message->callSuccessCount=$tab_res["callSuccessCount"];
            $message->callFailedCount=$tab_res["callFailedCount"];
            $message->callIgnoredCount=$tab_res["callIgnoredCount"];
            $message->campaignName=$tab_res["campaignName"];
            $message->historyStateId=$tab_res["historyStateId"];
            $message->messageFileName=$tab_res["messageFileName"];
            $message->contacts=$tab_res["contacts"];
            $message->fichier=$audioName;

            $message->save();
            
            }
//


            echo "Envoi effectué avec succès. <br>Veuillez vérifier l'historique pour voir l'état des envois.";

    //    }


        return redirect('/admin/message')->with('success','Message envoyé avec succès');

    }



}
