<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChoixController extends Controller
{
    //  public function choixReg(Request $request ,$reg){

    //     //echo "<script>alert(\"gneuwna fii\")</script>";

    //         $reg =$reg;
            
    //        $dept=DB::select('SELECT id , nom FROM ml_departement WHERE region="'.$reg.'" order by nom' );
            
            
    //         $i = 0;
           
    //         foreach ($dept as $key=> $value) {
    //             $dept[$i]->id = $value->id;
    //             $dept[$i]->nom = $value->nom;

                
    //             $i++;
    //         }

    //         echo json_encode($dept);
        
    // }

    public function choixDept(Request $request ,$dept){

     //echo "<script>alert(\"gneuwna fii\")</script>";

        $dept =$dept;
            
           $comm=DB::select('SELECT id , nom FROM ml_commune WHERE departement="'.$dept.'" order by nom' );
            
            
            $i = 0;
           
            foreach ($comm as $key=> $value) {
                $comm[$i]->id = $value->id;
                $comm[$i]->nom = $value->nom;

                
                $i++;
            }

            echo json_encode($comm);
        
    }

    public function choixComm(Request $request ,$comm){

     //echo "<script>alert(\"gneuwna fii\")</script>";

        $comm =$comm;
            
           $localites=DB::select('SELECT id , nom FROM ml_localite WHERE commune="'.$comm.'" order by nom' );
            
            
            $i = 0;
           
            foreach ($localites as $key=> $value) {
                $localites[$i]->id = $value->id;
                $localites[$i]->nom = $value->nom;

                
                $i++;
            }

            echo json_encode($localites);
        
    }

        

        

        // if(isset($_GET['commune'])){
        //     $comm = intval($_GET['commune']);
        //     $localites = $localite->recherche(array("conditions" => "commune=".$comm, "order" => "nom", "limit" => 1000));
            
        //     $i = 0;
        //     $tab = array();
        //     foreach ($localites as $key => $value) {
        //         $tab[$i]['id'] = $value['id'];
        //         $tab[$i]['nom'] = utf8_encode($value['nom']);
        //         $i++;
        //     }
        //     echo json_encode($tab);
        // }


}
