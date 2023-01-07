<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Models\Zakat;
use App\Exports\ZakatExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ZakatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zakat=Zakat::all();
        $zakat=Zakat::simplePaginate(15);
        $user=User::all();
        return view('components.zakat.index', compact('zakat','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('components.zakat.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Zakat::create([
            'nominal'=>$request->nominal,
            'nominal_beras'=>$request->nominal_beras,
            'jenis_zakat'=>$request->jenis_zakat,
            'no_rek'=>$request->no_rek,
            'keterangan'=>$request->keterangan,
            'status_id'=>'1',
            'user_id'=>$request->user_id
        ]);
        return redirect()->route('drop.zakat.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Zakat  $zakat
     * @return \Illuminate\Http\Response
     */
    public function show(Zakat $zakat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Zakat  $zakat
     * @return \Illuminate\Http\Response
     */
    public function edit(Zakat $zakat, $id)
    {
        $zakat=Zakat::find($id);
        return view('components.zakat.edit', compact('zakat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Zakat  $zakat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Zakat $zakat, $id)
    {
        $zakat=Zakat::find($id);
        $zakat->update($request->all());

        return redirect()->route('drop.zakat.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Zakat  $zakat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zakat $zakat, $id)
    {
        $zakat=Zakat::find($id);
        $zakat->delete();
        return back();
    }

    public function salurkan($id)
        {
            $zakat = Zakat::findOrFail($id);

            return view('components.zakat.salurkan', compact('zakat'));
    }

    public function storeSalurkan(Request $request, $id)
    {
        // Mendapatkan data donasi yang akan tersalurkan
        $id = $request->input('id');
        $zakat_tersalurkan = $request->input('zakat_tersalurkan');

        // Mendapatkan donasi yang akan tersalurkan
        $zakat = Zakat::find($id);
        $zakat->update($request->all());

        // Mengurangi jumlah donasi yang tersisa
        $zakat->jumlah_tersisa -= $zakat_tersalurkan ;
        $zakat->status_penyaluran = 'Tersalurkan';

        // Menyimpan perubahan ke database
        $zakat->save();

        // Menampilkan pesan sukses atau redirect ke halaman lain
        return redirect()->route('drop.zakat.index', ['id'=>$id])->with('success', 'Donasi berhasil tersalurkan');
    }
    public function validasiZakat($id){
        $zakat= \DB::table('zakats')->where('id', $id)->first();
        $status_sekarang = $zakat->status_id;

        if ($status_sekarang ==1) {
            \DB::table('zakats')->where('id', $id)->update([
                'status_id'=>2
            ]);
        } else {
            \DB::table('zakats')->where('id', $id)->update([
                'status_id'=>1
            ]);
        }
        return redirect()->route('drop.zakat.index');
    }
    public function exportZakatPdf(){
        $zakat=Zakat::all();
        $pdf = PDF::loadView('components.pdf.zakat',[ 'zakat'=>$zakat]);
        return $pdf->stream('zakat.pdf');
        // return $pdf->stream('donasi');
    }

        public function cetakPertanggalZakat($tglAwal, $tglAkhir){
        // dd(["Tanggal Awal:".$tglAwal, "Tanggal Akhir:".$tglAkhir]);
        $cetakPertanggalZakat=Zakat::all()->whereBetween('created_at',[$tglAwal, $tglAkhir]);
        $pdf = PDF::loadView('components.pdf.zakat-pertanggal',[ 'cetakPertanggalZakat'=>$cetakPertanggalZakat]);
        return $pdf->stream('zakat-pertanggal.pdf');
        // return view('components.pdf.permintaan-ambulan-pertanggal', compact('cetakPertanggal'));
    }

    public function exportExcelZakat(){
        return Excel::download(new ZakatExport,'zakat.xlsx');
    }
        public function aktivitas( Request $request, $id){
        $zakat=Zakat::find($id);
        $zakat=Zakat::all();
        $user=User::find($id);
        $zakat= Zakat::where('user_id', $id)->get();
        // $tersalurkan = $request->input('zakat_tersalurkan');
        // $zakat->jumlah_tersisa -= $tersalurkan ;
        return view('components.user.aktivitas', compact('user','zakat'));
    }
}