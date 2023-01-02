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


        $total_zakat=Zakat::all();
        // Menghitung jumlah zakat
        $total_zakat = Zakat::sum('nominal');

        // Menghitung jumlah zakat yang tersalurkan
        $zakat_tersalurkan = Zakat::sum('jumlah_tersisa');

        // Menghitung jumlah zakat yang masih tersisa
        $total_zakat_tersisa = $total_zakat + $zakat_tersalurkan ;
        $total_zakat = Zakat::where('status_id', '2')->sum('nominal');
// ---------------------------------------------------------------------------
// ---------------------------------------------------------------------------
        // Menghitung jumlah donasi
        $total_donasi = Donasi::sum('jml_donasi');

        // Menghitung jumlah donasi yang tersalurkan
        $total_tersalurkan = Donasi::sum('jumlah_tersisa');

        // Menghitung jumlah donasi yang masih tersisa
        $total_tersisa = $total_donasi + $total_tersalurkan;
        $total_donasi = Donasi::where('status_id', '2')->sum('jml_donasi');
        // $total_tersisa = Donasi::where('status_id', '1')->sum('jumlah_tersisa');
        $programDonasi=ProgramDonasi::all();
        return view('dashboard', compact('programDonasi','total_donasi', 'total_tersalurkan', 'total_tersisa','total_zakat','zakat_tersalurkan','total_zakat_tersisa'));
    }

}