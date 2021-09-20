<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoiceContact extends Model
{
    protected $table='voice_contact';
    protected $fillable = ['prenom','nom','tel','client','createur'];
}
