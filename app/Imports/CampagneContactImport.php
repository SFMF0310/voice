<?php

namespace App\Imports;

use App\Models\VoiceCampagneContact;
use Maatwebsite\Excel\Concerns\ToModel;

class CampagneContactImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {


        if (!empty($row['localite']) ) {

                $localiteid =DB::select('SELECT * FROM `ml_localite` WHERE `nom` LIKE "'.$row['localite'].'" ');

            }
           

        if (!empty($row['langue_reception']) ) {

                $langueid =DB::select('SELECT * FROM `voice_langue` WHERE `nom` LIKE "'.$row['langue_reception'].'" ');

            }

        if (!empty($row['langue_reception']) ) {

                $langueid =DB::select('SELECT * FROM `voice_langue` WHERE `nom` LIKE "'.$row['langue_reception'].'" ');

            }


        $numero =DB::select('SELECT * FROM `voice_contact` WHERE `tel` LIKE "'.$row['tel'].'" ');

        if (!empty($numero[0]->tel)) {
            
        }else{

            if (empty($row['tel'])) {
               
            }else{
                return new VoiceContact([
                    'prenom'     => isset($row['prenom']) ? $row['prenom'] : NULL,
                    'nom'    => isset($row['nom']) ? $row['nom'] : NULL,
                    'tel' => isset($row['tel']) ? $row['tel'] : NULL,
                    'client' => isset($_SESSION['client_csv']) ? $_SESSION['client_csv'] : NULL,
                    'createur' => $_SESSION['user'],
                    'date_naissance' => isset($row['date_naissance']) ? $row['date_naissance'] : NULL,
                    'lieu_naissance' => isset($row['lieu_naissance']) ? $row['lieu_naissance'] : NULL,
                    'adresse' => isset($row['adresse']) ? $row['adresse'] : NULL,
                    'localite' =>isset($localiteid[0]->id) ? $localiteid[0]->id : NULL,
                    'langue_reception' => isset($localiteid[0]->id) ? $localiteid[0]->id : NULL,
                    'genre' => isset($row['genre']) ? $row['genre'] : NULL
                    
                ]);

                
                // $campagneContact =new VoiceCampagneContact;
                // $campagneContact->campagne=$request->input('campagne');
                // $campagneContact->contact= $value;
                // //$campagne->createur=$_SESSION['user'];
                // $campagneContact->save();
            }

            
        }



       
    }
}
