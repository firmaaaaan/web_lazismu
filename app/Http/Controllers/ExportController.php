<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Zakat;
use App\Models\Donasi;
use App\Models\RumahSakit;
use App\Models\permintaanAmbulan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExportController extends Controller
{
    public function exportDonasi()
    {
        $donasi=Donasi::all();
        $donasi=Donasi::simplePaginate(15);
        $user=User::all();
        $total_donasi = Donasi::sum('jml_donasi');
        return view('components.exports.donasi', compact('donasi','user','total_donasi'));
    }
    public function exportZakat()
    {
        $zakat=Zakat::all();
        $zakat=Zakat::simplePaginate(15);
        $user=User::all();
        return view('components.exports.zakat', compact('zakat','user'));
    }
    public function exportPermintaanAmbulan()
    {
        $user=User::all();
        $rumahsakit=RumahSakit::all();
        $permintaanAmbulan=permintaanAmbulan::latest()->simplePaginate(15);
        return view('components.exports.permintaan-ambulan', compact('user','rumahsakit','permintaanAmbulan'))->with('i');
    }
}
