<?php

namespace App\Exports;

use App\Models\Donasi;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportDonasi implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Donasi::all();
    }
}
