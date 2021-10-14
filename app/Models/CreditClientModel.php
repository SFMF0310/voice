<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditClientModel extends Model
{
    //
    protected $table = 'voice_credit_client';
    protected $fillable = ['structure','credit_total'];
}
