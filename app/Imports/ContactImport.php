<?php

namespace App\Imports;

use App\Models\VoiceContact;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ContactImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new VoiceContact([
            'prenom'     => $row['prenom'],
            'nom'    => $row['nom'], 
            'tel' => $row['tel'],
            'client' => $_SESSION['client_csv'],
            'createur' => $_SESSION['user'],
        ]);
    }
}

