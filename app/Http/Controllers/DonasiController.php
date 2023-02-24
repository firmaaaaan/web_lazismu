<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use Carbon\Carbon;
use App\Models\Akun;
use App\Models\User;
use App\Models\Donasi;
use Illuminate\Http\Request;
use App\Exports\DonasiExport;
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
        $programDonasi=ProgramDonasi::all();
        $total_donasi = Donasi::sum('jml_donasi');
        return view('components.shodaqoh.index', compact('donasi','user','total_donasi','programDonasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user=User::all();
        $akun=Akun::all();
        $programDonasi=ProgramDonasi::all();
        $donasi=Donasi::all();
        return view('components.shodaqoh.create', compact('programDonasi', 'donasi','akun','user'));
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
            'jml_donasi'=>'required',
            'id_akun'=>'required',
            'programdonasi_id'=>'required'
        ]);

        // Mencari akun yang sesuai dengan id_akun yang diterima dari form
        $akun = Akun::find($request->id_akun);

        // Mendapatkan nilai persen_hak_amil dari akun yang ditemukan
        $persen_hak_amil = $akun->persen_hak_amil;



        // Menghitung nilai hak_amil
        $hak_amil = $request->jml_donasi * $persen_hak_amil / 100;

        $donasis = Donasi::where('programdonasi_id', $request->programdonasi_id)->get();
        $jumlah_donasi = $donasis->sum('jml_donasi');
        ProgramDonasi::where('id_akun', $request->id_akun)->where('id', $request->programdonasi_id)->update(['jumlah_donasi_program' => $jumlah_donasi]);

        // Mencari donasi yang baru saja ditambahkan ke database
        Donasi::where('programdonasi_id', $request->programdonasi_id)
            ->orderBy('created_at', 'desc')
            ->first();
        $donasi=Donasi::create([
            'jml_donasi'=>$request->jml_donasi,
            'no_rek'=>$request->no_rek,
            'keterangan'=>$request->keterangan,
            'status_id'=>'1',
            'user_id'=>$request->user_id,
            'id_akun'=>$request->id_akun,
            'programdonasi_id'=>$request->programdonasi_id,
            'hak_amil'=>$hak_amil,
            'nama_donatur'=>$request->nama_donatur
        ]);
        $programDonasi = ProgramDonasi::find($request->input('programdonasi_id'));
        $programDonasi->jumlah_donasi_program += $request->input('jml_donasi');
        $programDonasi->jumlah_donasi_program  = $programDonasi->jumlah_donasi_program  - $programDonasi->tersalurkan;
        $programDonasi->save();

        return back()->with('sukses', 'Terima kasih telah melakukan donasi');
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
        $akun=Akun::all();
        $programDonasi=ProgramDonasi::all();
        $user=User::all();
        return view('components.shodaqoh.edit', compact('programDonasi', 'donasi','akun','user'));

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
        ]);

        $donasi = Donasi::find($id);
        $programdonasi_id = $request->input('programdonasi_id');
        // $programdonasi = ProgramDonasi::find($programdonasi_id);
        $akun = Akun::find($id);
        $persen_hak_amil = $akun->persen_hak_amil;

        $donasi->update($request->all());

        // update hak_amil
        $donasi->hak_amil = ($request->jml_donasi * $persen_hak_amil)/100;
        $donasi->save();

        //update jumlah program donasi
        $jumlah_donasi = Donasi::where('programdonasi_id', $programdonasi_id)->sum('jml_donasi');
        ProgramDonasi::where('id', $programdonasi_id)->update(['jumlah_donasi_program' => $jumlah_donasi]);


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
        $donasi = Donasi::find($id);
        $programdonasi_id = $donasi->programdonasi_id;

        $donasi->delete();

        //update jumlah program donasi
        $jumlah_donasi = Donasi::where('programdonasi_id', $programdonasi_id)->sum('jml_donasi');
        ProgramDonasi::where('id', $programdonasi_id)->update(['jumlah_donasi_program' => $jumlah_donasi]);
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
    public function programIndex($id, $akun_id){
        // $donasi=Donasi::find($id);
        $programDonasi=ProgramDonasi::find($id);
        $donasi=Donasi::all();
        $donasi_validated = Donasi::where('programdonasi_id', $id)->where('status_id', 2)->get();
        $totalDonationForProgram = $donasi_validated->sum('jml_donasi');
        $donasi=Donasi::where('programdonasi_id', $id)->get();
        // $totalDonationForProgram = Donasi::where('programdonasi_id', $id)->sum('jml_donasi');
        $total_hak_amil = Donasi::where('programdonasi_id', $id)->sum('hak_amil');
        $akun = Akun::find($akun_id);
        return view('components.shodaqoh.program-index', compact('donasi','akun','total_hak_amil','programDonasi','totalDonationForProgram'));
    }

    public function salurkanProgram($id){
        $programDonasi = ProgramDonasi::find($id);
        $donasi = Donasi::where('programdonasi_id', $id)->first();
        $akun = Akun::all();
        return view('components.shodaqoh.salurkan-program', compact('programDonasi', 'donasi', 'akun'));
    }
    public function storeSalurkanProgram(Request $request, $id)
    {

        $donasi=Donasi::find($id);
        $donasi->update($request->all());

        $programDonasi = ProgramDonasi::find($id);
        $tersalurkan = $request->input('tersalurkan');
        // $tersalurkan = $request->input('desk_penyaluran');


        // Pastikan jumlah donasi yang tersedia cukup untuk disalurkan
        if ($programDonasi->jumlah_donasi_program < $request->input('tersalurkan')) {
            return redirect()->route('program.index', $id)->with('error', 'Jumlah donasi yang tersedia tidak cukup untuk disalurkan!');
        }

        // Cek apakah ada donasi yang belum tervalidasi
        $berlumTervalidasi = Donasi::where('programdonasi_id', $request->input('programdonasi_id'))
            ->where('status_id', 1)
            ->get();

        if ($berlumTervalidasi->sum('jml_donasi') >= $request->input('tersalurkan')) {
            return redirect()->route('program.index', $id)->with('belum', 'Terdapat donasi yang belum tervalidasi yang tidak bisa disalurkan!');
        }

        Donasi::where('programdonasi_id', $id)->update(['status_penyaluran' => 'Tersalurkan']);

        // Proses penyaluran donasi
        $programDonasi->jumlah_donasi_program -= $tersalurkan;
        $programDonasi->save();
        ProgramDonasi::where('id', $id)
            ->update(['tersalurkan' => DB::raw('tersalurkan + '.$tersalurkan)]);

        // // Ubah jumlah donasi tersisa pada tabel donasis
        // Donasi::where('programdonasi_id', $request->input('programdonasi_id'))
        //     ->decrement('jml_donasi', $request->input('tersalurkan'));

        return redirect()->route('program.index', $id)->with('success', 'Donasi berhasil disalurkan!');
    }

        public function cetakProgramDanAkunPertanggal( Request $request, $programId, $akunId, $tglAwal, $tglAkhir) {

            $programDonasi = ProgramDonasi::findOrFail($programId);
            $akun = Akun::findOrFail($akunId);
            $cetakProgramDanAkunPertanggal = Donasi::where('programdonasi_id', $programDonasi->id)
                ->where('id_akun', $akun->id)
                ->whereBetween('created_at', [$tglAwal, $tglAkhir])
                ->get();
            $pdf = PDF::loadView('components.pdf.donasi-program-pertanggal',[
                'cetakProgramDanAkunPertanggal' => $cetakProgramDanAkunPertanggal,
                'programDonasi' => $programDonasi,
                'akun' => $akun,
                'tglAwal'=> $tglAwal,
                'tglAkhir'=>$tglAkhir
            ]);
            return $pdf->stream('donasi-program-akun-pertanggal.pdf');
    }

    // public function cetakProgramPertanggal($id,$tglAwal, $tglAkhir){

    //     $donasi=Donasi::all();
    //     $programDonasi=ProgramDonasi::find($id);
    //     $cetakProgramPertanggal = Donasi::where('programdonasi_id', $id)
    //                     ->whereBetween('created_at',[$tglAwal, $tglAkhir])
    //                     ->get();
    //     $pdf = PDF::loadView('components.pdf.donasi-program-pertanggal',[ 'cetakProgramPertanggal'=>$cetakProgramPertanggal,'programDonasi'=>$programDonasi, 'donasi'=>$donasi]);

    //     return $pdf->stream('donasi-program-pertanggal.pdf');
    // }
}