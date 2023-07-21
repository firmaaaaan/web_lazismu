<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Models\RumahSakit;
use Illuminate\Http\Request;
use App\Models\ProgramDonasi;
use App\Models\permintaanAmbulan;
use App\Http\Controllers\Controller;

class PermintaanAmbulanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programDonasi=ProgramDonasi::all();
        $user=User::all();
        $rumahsakit=RumahSakit::all();
        // $permintaanAmbulan=permintaanAmbulan::latest()->get();
        $permintaanAmbulan=permintaanAmbulan::latest()->simplePaginate(15);
        return view('components.permintan_ambulan.index', compact('user','rumahsakit','permintaanAmbulan','programDonasi'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programDonasi=ProgramDonasi::all();
        $user=User::all();
        $rumahsakit=RumahSakit::all();
        return view('components.permintan_ambulan.create', compact('rumahsakit','user','programDonasi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'=>'required',
            'nama_pasien'=>'required',
            'jk'=>'required',
            'tanggal'=>'required',
            'titik_jemput'=>'required',
            'rumahsakit_id'=>'required',
            'keterangan'=>'required'
        ]);
        PermintaanAmbulan::create([
            'user_id'=>$request->user_id,
            'nama_pasien'=>$request->nama_pasien,
            'jk'=>$request->jk,
            'tanggal'=>$request->tanggal,
            'infaq'=>$request->infaq,
            'titik_jemput'=>$request->titik_jemput,
            'rumahsakit_id'=>$request->rumahsakit_id,
            'keterangan'=>$request->keterangan,
            'status_id'=>'3',
        ]);
        return redirect()->route('permintaan.ambulan.index')->with('Success','Permintaan anda  telah dikirim');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\permintaanAmbulan  $permintaanAmbulan
     * @return \Illuminate\Http\Response
     */
    public function show(permintaanAmbulan $permintaanAmbulan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\permintaanAmbulan  $permintaanAmbulan
     * @return \Illuminate\Http\Response
     */
    public function edit(permintaanAmbulan $permintaanAmbulan, $id)
    {
        $user=User::all();
        $rumahsakit=RumahSakit::all();
        $permintaanAmbulan=permintaanAmbulan::find($id);
        return view('components.permintan_ambulan.edit', compact('user','rumahsakit','permintaanAmbulan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\permintaanAmbulan  $permintaanAmbulan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, permintaanAmbulan $permintaanAmbulan, $id)
    {
        $request->validate([
            'user_id'=>'required',
            'tanggal'=>'required',
            'titik_jemput'=>'required',
            'rumahsakit_id'=>'required'
        ]);
        $permintaanAmbulan=permintaanAmbulan::find($id);
        $permintaanAmbulan->update($request->all());
        return redirect()->route('permintaan.ambulan.index')->with('Update','Permintaan anda telah diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\permintaanAmbulan  $permintaanAmbulan
     * @return \Illuminate\Http\Response
     */
    public function destroy(permintaanAmbulan $permintaanAmbulan, $id)
    {
        $permintaanAmbulan=permintaanAmbulan::find($id);
        $permintaanAmbulan->delete();

        return redirect()->route('permintaan.ambulan.index')->with('delete','Permintaan anda telah dihapus');
    }

        public function validasiAmbulan(Request $request, $id){
        $permintaanAmbulan= \DB::table('permintaan_ambulans')->where('id', $id)->first();
        $status_sekarang = $permintaanAmbulan->status_id;

        if ($status_sekarang ==4) {
            \DB::table('permintaan_ambulans')->where('id', $id)->update([
                'status_id'=>5
            ]);
        } else {
            \DB::table('permintaan_ambulans')->where('id', $id)->update([
                'status_id'=>4
            ]);
        }

        $status=4;
        $permintaanAmbulan = permintaanAmbulan::find($id);
        $permintaanAmbulan->status_id = 4;

        if ( $status == 4) {
            $permintaanAmbulan = permintaanAmbulan::where('id', $id)->first();
            $permintaanAmbulan->status_perjalanan = 'Diproses';
            $permintaanAmbulan->save();
        }
        return redirect()->route('permintaan.ambulan.index');
    }

    public function updateStatus(Request $request, $id)
    {
        $permintaanAmbulan = permintaanAmbulan::find($id);
        $permintaanAmbulan->status_perjalanan = $request->input('status_perjalanan');
        $permintaanAmbulan->save();
        return redirect()->back();
    }

        public function exportPermintaanAambulanPdf(){
        $permintaanAmbulan=permintaanAmbulan::all();
        $totalInfaq=$permintaanAmbulan->sum('infaq');
        $pdf = PDF::loadView('components.pdf.permintaan-ambulan',[ 'totalInfaq'=>$totalInfaq, 'permintaanAmbulan'=>$permintaanAmbulan]);
        return $pdf->stream('permintaan-ambulan.pdf');

        // return $pdf->stream('donasi');
    }

    public function cetakPertanggal($tglAwal, $tglAkhir){
        // dd(["Tanggal Awal:".$tglAwal, "Tanggal Akhir:".$tglAkhir]);
    $cetakPertanggal=permintaanAmbulan::all()->whereBetween('tanggal',[$tglAwal, $tglAkhir]);
    $totalInfaq=$cetakPertanggal->sum('infaq');
    $pdf = PDF::loadView('components.pdf.permintaan-ambulan-pertanggal',[ 'totalInfaq'=>$totalInfaq,'cetakPertanggal'=>$cetakPertanggal,'tglAwal'=> $tglAwal,
                'tglAkhir'=>$tglAkhir]);
    return $pdf->stream('permintaan-ambulan.pdf');
    // return view('components.pdf.permintaan-ambulan-pertanggal', compact('cetakPertanggal'));
    }
}