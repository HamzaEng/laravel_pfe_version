<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class exportNotes implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $notes; 
    public function __construct($collection)
    {
        $this->notes = $collection;
    }
    public function collection()
    {
        return $this->notes;  
    }
}
