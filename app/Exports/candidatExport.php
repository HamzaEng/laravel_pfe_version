<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
class candidatExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('candidats')->select('name','prenom','dateNs','lieuNs','tel','niveauBac','bacMoyen')->orderBy('bacMoyen','desc')->get();
    }
}
