<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class VoiceUprofil extends Model
{
    use Notifiable ;
    protected $table='voice_uprofil';
    // protected $fillables = [
    //     'profil','user'
    // ] ;
}
