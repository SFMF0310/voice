<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaiementModel extends Model
{
    //
    protected $table = 'voice_paiement';
    protected $fillable = ['id_offre_financiere','reference','prix','id_client'];
}
