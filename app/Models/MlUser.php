<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class MlUser extends Model
{   
     use Notifiable ;
     protected $table='ml_users';
     protected $fillable = [
        'prenom','nom','tel','login','mail','mdp','ldap'
     ] ;
}
