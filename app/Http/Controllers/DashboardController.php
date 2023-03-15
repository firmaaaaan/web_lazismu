<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use Illuminate\Http\Request;
use App\Models\ProgramDonasi;
use App\Http\Controllers\Controller;
use App\Models\Zakat;

class DashboardController extends Controller
{
    public function index(){
        $donasi=Donasi::all();
// ---------------------------------------------------------------------------
// ---------------------------------------------------------------------------
        $total_donasi = Donasi::sum('jml_donasi');
        $programDonasi=ProgramDonasi::all();
        $totalTersalurkan=$programDonasi->sum('tersalurkan');
        $tersisa=$programDonasi->sum('jumlah_donasi_program');

        $total_donasi = Donasi::where('status_id', '2')->sum('jml_donasi');

        // Mendapatkan data jumlah donasi yang sudah divalidasi berdasarkan id program donasi tertentu
        $dataDonasi = [];
        foreach ($programDonasi as $program) {
            $donasi = Donasi::where('programdonasi_id', $program->id)
                        ->where('status_id', '2')
                        ->sum('jml_donasi');
            array_push($dataDonasi, $donasi);
        }
        return view('dashboard', compact('tersisa','totalTersalurkan', 'programDonasi','total_donasi','donasi','dataDonasi'));
    }

}
