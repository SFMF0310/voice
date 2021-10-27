<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\VoiceCampagne;
use Illuminate\Support\Facades\Redirect;
use App\Models\VoiceClient;
use App\Models\VoiceCampagneContact;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ContactImport;

class CampagneController extends Controller
{
    public function index(){

        

        if (in_array($_SESSION['profil'], array(1,2))) { 
            $campagne = DB::select('select a.id, a.intitule, a.created_at, b.prenom, b.nom, b.tel,c.nom as nomclient from voice_campagne a, ml_users b ,voice_clients c where a.createur=b.id and c.id=a.client ');
        }

        if($_SESSION['profil']==3 || $_SESSION['profil'] == 4){

            $client=DB::select('select client from voice_uprofil where user="'.$_SESSION['user'].'" ');

           // $contact=VoiceContact::where('client', $client[0]->client)->get();

            //$campagne = DB::select('select a.id, a.intitule, a.created_at, b.prenom, b.nom, b.tel from voice_campagne a, ml_usersvoice  b where a.client=b.id and a.user="'.$_SESSION['user'].'" ');

            //var_dump($contact);

            $campagne=VoiceCampagne::where('client', $client[0]->client)->get();
            
        }


        $client=VoiceClient::all();


        // $mlUser=MlUser::all();
        // $role=DB::select(' SELECT * FROM voice_profil WHERE id!=1');

        return view('admin.campagne',compact('campagne','client'));
    }

    public function store (Request $request){

        $campagne=new VoiceCampagne;
        
        $campagne->intitule=$request->input('intitule');

        if ($_SESSION['profil']==3 || $_SESSION['profil'] == 4) {

            $client=DB::select('select client from voice_uprofil where user="'.$_SESSION['user'].'" ');
            $campagne->client=$client[0]->client;

        }elseif ($_SESSION['profil']==1 || $_SESSION['profil'] == 2) {

            $campagne->client=$request->input('client');

        }

       // $campagne->client=$request->input('client');
        $campagne->createur=$_SESSION['user'];
        $campagne->save();

        if ($_SESSION['profil']==1 || $_SESSION['profil'] == 2) {
            return redirect('/admin/campagne')->with('success','Campagne ajoutée avec succès');
        }elseif ($_SESSION['profil']==3 || $_SESSION['profil'] == 4) {
            return redirect('/client/campagne')->with('success','Campagne ajoutée avec succès');
        }

        

    }

    public function delete($id){
   
        $campagne= VoiceCampagne::findOrFail($id);
        $campagne->delete();

        return Redirect::back()->with('success','Campagne supprimée avec succès');
    }


    public function deleteContact($id){
   
        $contact= VoiceCampagneContact::findOrFail($id);
        $contact->delete();

        return Redirect::back()->with('success','Contact supprimé de la campagne avec succès');
    }

    public function update(Request $request ,$id){
   
        $campagne = DB::select('select a.id, a.intitule,a.client, a.created_at, b.prenom, b.nom, b.tel from voice_campagne a, ml_users b where  a.id="'.$id.'" ');

        $client=VoiceClient::all();

          //  echo "fgsdhf";
        
            return view('admin.updateCampagne',compact('campagne','client'));
        
    }

    public function updateSaving(Request $request ,$id){
   
        $campagne= VoiceCampagne::find($id);
        $campagne->intitule=$request->input('intitule');
        if (null !== $request->input('client')) {
            $campagne->client=$request->input('client');
        }
        // $campagne->client=$request->input('client');
        $campagne->update();

        if ($_SESSION['profil']==1 || $_SESSION['profil'] == 2) {
            return redirect('/admin/campagne')->with('success','Campagne modifiée avec succès');
        }elseif ($_SESSION['profil']==3 || $_SESSION['profil'] == 4) {
            return redirect('/client/campagne')->with('success','Campagne modifiée avec succès');
        }

            

        
    }

    public function details(Request $request ,$id){
   
        $campagne = DB::select('select a.id, a.intitule, a.client ,a.created_at, b.prenom, b.nom, b.tel,c.nom as nomclient , c.id as idclient from voice_campagne a, ml_users b , voice_clients  c where a.createur=b.id and a.id="'.$id.'" and a.client = c.id ');

        $contact=DB::select('select * from voice_contact where client = "'.$campagne[0]->client.'"');

        $idCampagne=$id;

        $contactCampagne=DB::select('select con.prenom,con.nom,con.id,con.tel,cam.id as idcam from voice_contact con , voice_campagne_contact cam where cam.contact=con.id and con.client = "'.$campagne[0]->client.'" and cam.campagne="'.$id.'"');


          //  echo "fgsdhf";
        
            return view('admin.detailsCampagne',compact('campagne','contact','contactCampagne','idCampagne'));
    }

     public function storeContact (Request $request){

        

        foreach ($request->input('contact') as $value) {

            $contact=DB::select('select * from voice_campagne_contact where contact = "'.$value.'" and campagne="'.$request->input('campagne').'"');

            if (empty($contact)) {
                

                $campagneContact =new VoiceCampagneContact;
                $campagneContact->campagne=$request->input('campagne');
                $campagneContact->contact= $value;
                //$campagne->createur=$_SESSION['user'];
               $campagneContact->save();

            }

        }
        

        return Redirect::back()->with('success','Liste contact mise à jour avec succès');


    }

    public function import(Request $request) 
    {

        $_SESSION['client_csv']=$request->input('client');
        $_SESSION['campagne_csv']=$request->input('campagne');

      //  var_dump(request()->file('csv_file'));

        Excel::import(new ContactImport,request()->file('csv_file'));

        // if (isset($_SESSION['numVerif'])) {

        //     $contact=DB::select('select * from voice_contact  where tel = "'.$_SESSION['numVerif'].'"');
        //     $campagneContact =new VoiceCampagneContact;
        //     $campagneContact->campagne=$_SESSION['campagne_csv'];
        //     $campagneContact->contact= $contact[0]->id;
        //     //$campagne->createur=$_SESSION['user'];
        //    $campagneContact->save();

        //    // echo $_SESSION['numVerif'];
        // }

    
            if (($open = fopen(request()->file('csv_file'), "r")) !== FALSE) 
              {
              
                $row=0;
                while (($data = fgetcsv($open, 1000, ",")) !== FALSE) 
                {
                    //$row++;
                  $array[] = $data; 
                }
              
                fclose($open);
              }
             // echo "<pre>";
              //To display array data
                //echo $row;

              foreach ($array as $key => $value) {
                  
                  if ($key>0) {
                    if (!empty($value[2])) {

                        $contact=DB::select('select * from voice_contact  where tel = "'.$value[2].'"');

                        if (!empty($contact)) {

                            $campagneContact =new VoiceCampagneContact;
                            $campagneContact->campagne=$_SESSION['campagne_csv'];
                            $campagneContact->contact= $contact[0]->id;
                            //$campagne->createur=$_SESSION['user'];
                            $campagneContact->save();
                          
                        }
                    }
            //  echo $value[2] ."<br>";
                  }
                  
              }

              //var_dump();
        //      echo "</pre>";
        
        //var_dump(new ContactImport,request()->file('csv_file')));
        return back()->with('success','Liste ajoutée avec succès');
    }
}
