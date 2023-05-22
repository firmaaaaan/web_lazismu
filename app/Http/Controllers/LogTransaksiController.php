<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Akun;
use App\Models\Donasi;
use App\Models\LogTransaksi;
use Illuminate\Http\Request;
use App\Models\ProgramDonasi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programDonasi=ProgramDonasi::all();
        $logTransaksi=LogTransaksi::all();
        return view('components.logtransaction.index', compact('logTransaksi','programDonasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programDonasi=ProgramDonasi::all();
        return view('components.logtransaction.create',compact('programDonasi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function transferSaldo(Request $request)
    {
        //validasi input
        $request->validate([
            'id_programdonasi_asal' => 'required|exists:program_donasis,id',
            'id_programdonasi_tujuan' => 'required|exists:program_donasis,id',
            'nominal' => 'required|numeric|min:1',
        ]);

        $programdonasi_asal = ProgramDonasi::find($request->id_programdonasi_asal);
        $programdonasi_tujuan = ProgramDonasi::find($request->id_programdonasi_tujuan);

        //validasi jumlah_donasi_program program donasi asal cukup atau tidak
        if($programdonasi_asal->jumlah_donasi_program < $request->nominal) {
            return back()->with('error','Jumlah saldo program donasi asal tidak cukup');
        }

        //validasi apakah donasi sudah tervalidasi
        $donasi = Donasi::where('programdonasi_id', $programdonasi_asal->id)->first();
        if (!$donasi || $donasi->status_id == 1) {
            return back()->with('error', 'Program donasi asal belum tervalidasi, tidak bisa melakukan transfer saldo');
        }

        $donasi = Donasi::where('programdonasi_id', $programdonasi_tujuan->id)->first();
        if (!$donasi || $donasi->status_id == 1) {
            return back()->with('error', 'Program donasi tujuan belum tervalidasi, tidak bisa melakukan transfer saldo');
        }


        //transfer jumlah_donasi_program
        $programdonasi_tujuan->jumlah_donasi_program += $request->nominal;
        $programdonasi_asal->jumlah_donasi_program -= $request->nominal;
        $programdonasi_asal->save();
        $programdonasi_tujuan->save();

        //log transaksi
        $log = new LogTransaksi();
        $log ->user_id = $request->user_id;
        $log->id_programdonasi_asal = $programdonasi_asal->id;
        $log->nominal = $request->nominal;
        $log->id_programdonasi_tujuan = $programdonasi_tujuan->id;
        $log->keterangan=$request->keterangan;
        $log->save();

        return back()->with('success', 'Jumlah saldo program berhasil dipindahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LogTransaksi  $logTransaksi
     * @return \Illuminate\Http\Response
     */
    public function show(LogTransaksi $logTransaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LogTransaksi  $logTransaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(LogTransaksi $logTransaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LogTransaksi  $logTransaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LogTransaksi $logTransaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LogTransaksi  $logTransaksi
     * @return \Illuminate\Http\Response
     */
public function destroy($id)
{
    $logTransaksi = LogTransaksi::findOrFail($id);
    $nominal = $logTransaksi->nominal; // Simpan jumlah transaksi awal

    $programDonasiAwal = $logTransaksi->id_programdonasi_asal;
    if ($programDonasiAwal) {
        $programDonasiAwalModel = ProgramDonasi::findOrFail($programDonasiAwal);
        $programDonasiAwalModel->jumlah_donasi_program += $nominal;
        $programDonasiAwalModel->save();
    }

    $programDonasiAkhir = $logTransaksi->id_programdonasi_tujuan;
    if ($programDonasiAkhir) {
        $programDonasiAkhirModel = ProgramDonasi::findOrFail($programDonasiAkhir);
        $programDonasiAkhirModel->jumlah_donasi_program -= $nominal;
        $programDonasiAkhirModel->save();
    }

    $logTransaksi->delete();

    return back();
}


    public function cetakPertanggalTransaksi($tglAwal, $tglAkhir){
        // dd(["Tanggal Awal:".$tglAwal, "Tanggal Akhir:".$tglAkhir]);
        $programDonasi=ProgramDonasi::all();
        $cetakPertanggalTransaksi=LogTransaksi::all()->whereBetween('created_at',[$tglAwal, $tglAkhir]);
        $pdf = PDF::loadView('components.pdf.transaksi-pertanggal',[ 'cetakPertanggalTransaksi'=>$cetakPertanggalTransaksi,'programDonasi'=>$programDonasi,'tglAwal'=> $tglAwal,
                'tglAkhir'=>$tglAkhir]);
        return $pdf->stream('transaksi-pertanggal.pdf');
        // return view('components.pdf.permintaan-ambulan-pertanggal', compact('cetakPertanggal'));
    }
}