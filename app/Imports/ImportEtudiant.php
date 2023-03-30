<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
class ImportEtudiant implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
    }
}

/*

select = tous les filiers -> quel filiere && quel anne 
name, prenom, email, password, ... + current year + filiere,  


*/
