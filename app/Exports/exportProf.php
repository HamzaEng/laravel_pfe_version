<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class exportProf implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('users')->where('isProf', '=', true)->select('name', 'prenom', 'cin', 'tel', 'email')->get();        
    }
}
