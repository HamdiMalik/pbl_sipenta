<?php

namespace App\Exports;

use App\Models\dosen;
use Maatwebsite\Excel\Concerns\FromCollection;

class dosenExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return dosen::all();
    }
}