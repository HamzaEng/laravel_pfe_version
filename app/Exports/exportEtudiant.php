<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class exportEtudiant implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('users')->where('cne', '!=', null)->select(['name', 'prenom', 'cne', 'cin', 'tel', 'email', 'filiere', 'annee'])->orderBy('filiere')->get();        
    }
}
