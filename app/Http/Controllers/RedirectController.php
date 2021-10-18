<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    //
    public function redirectUser(){
        if (in_array($_SESSION['profil'],array(1,2))){

            return redirect('/admin');

        }
        elseif($_SESSION['profil'] == 3){

            return redirect('/client');


        }
        elseif($_SESSION['profil'] == 4){

            return redirect('/personnel');


        }

    }
}
