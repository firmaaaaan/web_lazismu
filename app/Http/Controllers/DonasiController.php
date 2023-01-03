<?php

namespace App\Http\Controllers;

use App\Exports\DonasiExport;
use DB;
use PDF;
use App\Models\User;
use App\Models\Donasi;
use Illuminate\Http\Request;
use App\Models\ProgramDonasi;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class DonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donasi=Donasi::all();
        $donasi=Donasi::simplePaginate(15);
        $user=User::all();
        $total_donasi = Donasi::sum('jml_donasi');
        return view('components.shodaqoh.index', compact('donasi','user','total_donasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programDonasi=ProgramDonasi::all();
        $donasi=Donasi::all();
        return view('components.shodaqoh.create', compact('programDonasi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Donasi::create($request->all());
        $request->validate([
            'jml_donasi'=>'required',
            'no_rek'=>'required',
            'keterangan'=>'required',
            'user_id'=>'required'
        ]);
        Donasi::create([
            'jml_donasi'=>$request->jml_donasi,
            'no_rek'=>$request->no_rek,
            'keterangan'=>$request->keterangan,
            'status_id'=>'1',
            'user_id'=>$request->user_id
        ]);
        return redirect()->route('drop.donasi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Donasi  $donasi
     * @return \Illuminate\Http\Response
     */
    public function show(Donasi $donasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Donasi  $donasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Donasi $donasi, $id)
    {
        $donasi=Donasi::find($id);
        $programDonasi=programDonasi::all();
        $user=User::all();
        return view('components.shodaqoh.edit', compact('donasi','user','programDonasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Donasi  $donasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donasi $donasi, $id)
    {
        $request->validate([
            'jml_donasi'=>'required',
            'no_rek'=>'required',
            'keterangan'=>'required',
            'user_id'=>'required'
        ]);
        $donasi=Donasi::find($id);
        $donasi->update($request->all());
        return redirect()->route('drop.donasi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Donasi  $donasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donasi $donasi, $id)
    {
        $donasi=Donasi::find($id);
        $donasi->delete();
        return redirect()->route('drop.donasi.index');
    }

    public function salurkan($id)
        {
            $donasi = Donasi::findOrFail($id);

            return view('components.shodaqoh.salurkan', compact('donasi'));
    }

    public function storeSalurkan(Request $request, $id)
    {
        // Mendapatkan data donasi yang akan tersalurkan
        $id = $request->input('id');
        $donasi_tersalurkan = $request->input('donasi_tersalurkan');


        // Mendapatkan donasi yang akan tersalurkan
        $donasi = Donasi::find($id);
        $donasi->update($request->all());

        // Mengurangi jumlah donasi yang tersisa
        $donasi->jumlah_tersisa -= $donasi_tersalurkan;
        $donasi->status_penyaluran = 'Tersalurkan';

        // Menyimpan perubahan ke database
        $donasi->save();

        // Menampilkan pesan sukses atau redirect ke halaman lain
        return redirect()->route('drop.donasi.index', ['id'=>$id])->with('success', 'Donasi berhasil tersalurkan');
    }

        public function validasiDonasi($id){
        $donasi= \DB::table('donasis')->where('id', $id)->first();
        $status_sekarang = $donasi->status_id;

        if ($status_sekarang ==1) {
            \DB::table('donasis')->where('id', $id)->update([
                'status_id'=>2
            ]);
        } else {
            \DB::table('donasis')->where('id', $id)->update([
                'status_id'=>1
            ]);
        }

        return redirect()->route('drop.donasi.index');
    }

    public function exportPdf(){
        $donasi=Donasi::all();
        $pdf = PDF::loadView('components.pdf.donasi',[ 'donasi'=>$donasi]);
        return $pdf->stream('donasi.pdf');

        // return $pdf->stream('donasi');
    }
    public function cetakPertanggalDonasi($tglAwal, $tglAkhir){
        // dd(["Tanggal Awal:".$tglAwal, "Tanggal Akhir:".$tglAkhir]);
        $cetakPertanggalDonasi=Donasi::all()->whereBetween('created_at',[$tglAwal, $tglAkhir]);
        $pdf = PDF::loadView('components.pdf.donasi-pertanggal',[ 'cetakPertanggalDonasi'=>$cetakPertanggalDonasi]);
        return $pdf->stream('donasi-pertanggal.pdf');
        // return view('components.pdf.permintaan-ambulan-pertanggal', compact('cetakPertanggal'));
    }
    public function exportExcel(){
        return Excel::download(new DonasiExport,'donasi.xlsx');
    }

}