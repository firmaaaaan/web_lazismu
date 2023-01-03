<?php

namespace App\Exports;

use App\Models\Zakat;
use Maatwebsite\Excel\Concerns\FromCollection;

class ZakatExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Zakat::all();
    }
}
