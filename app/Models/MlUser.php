<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MlUser extends Model
{
     protected $table='ml_users';
     protected $fillable = [
        'prenom','nom','tel','login','mail','mdp','ldap'
     ] ;
}
