<?php

namespace App\Http\Controllers;

use App\Models\Zakat;
use App\Models\Donasi;
use Illuminate\Http\Request;
use App\Models\ProgramDonasi;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        $donasi=Donasi::all();
        $total_donasi = Donasi::where('status_id', '2')->sum('jml_donasi');
        $programDonasi=ProgramDonasi::all();
        $totalTersalurkan=$programDonasi->sum('tersalurkan');
        $tersisa=$total_donasi - $totalTersalurkan;

        $total_donasi = Donasi::where('status_id', '2')->sum('jml_donasi');

        // Mendapatkan data jumlah donasi yang sudah divalidasi berdasarkan id program donasi tertentu
        $dataDonasi = [];
        foreach ($programDonasi as $program) {
            $donasi = Donasi::where('programdonasi_id', $program->id)
                        ->where('status_id', '2')
                        ->sum('jml_donasi');
            array_push($dataDonasi, $donasi);
        }

        $donationsPerYear = DB::table('donasis')
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('SUM(jml_donasi) as total_donations'))
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->get();

        // Calculate total donations per month
        $donationsPerMonth = DB::table('donasis')
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('SUM(jml_donasi) as total_donations'))
            ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
            ->get();
        return view('dashboard', compact('donationsPerYear','donationsPerMonth','tersisa','totalTersalurkan', 'programDonasi','total_donasi','donasi','dataDonasi'));
    }

}