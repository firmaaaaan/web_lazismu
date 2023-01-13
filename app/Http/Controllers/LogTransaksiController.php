<?php

namespace App\Http\Controllers;

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
        //
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
            return redirect()->back()->withErrors(['Jumlah donasi program program donasi asal tidak cukup']);
        }

        //validasi user yang melakukan transfer
        // $user = Auth::user();
        // if(!$user->can('transfer-jumlah_donasi_program')){
        //     return redirect()->back()->withErrors(['Anda tidak memiliki hak akses untuk melakukan transfer jumlah donasi program']);
        // }

        //transfer jumlah_donasi_program
        $programdonasi_tujuan->jumlah_donasi_program += $request->nominal;
        $programdonasi_asal->jumlah_donasi_program -= $request->nominal;
        $programdonasi_asal->save();
        $programdonasi_tujuan->save();

        //log transaksi
        $log = new LogTransaksi();
        $log ->user_id = $request->user_id;
        $log->id_programdonasi_asal = $programdonasi_asal->id;
        // $log->jenis_transaksi = 'transfer_jumlah_donasi_program';
        $log->nominal = $request->nominal;
        $log->id_programdonasi_tujuan = $programdonasi_tujuan->id;
        $log->save();

        return back()->with('success', 'Jumlah donasi program berhasil dipindahkan');
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
    public function destroy(LogTransaksi $logTransaksi)
    {
        //
    }
}
