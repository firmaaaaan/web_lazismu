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
        $donasi = Donasi::join('program_donasis', 'donasis.programdonasi_id', '=', 'program_donasis.id')
                        ->join('akuns', 'program_donasis.id_akun', '=', 'akuns.id')
                        ->select('donasis.*', 'program_donasis.nama_program', 'akuns.nama_akun')
                        ->simplePaginate(15);
        $user = User::all();
        $programDonasi = ProgramDonasi::all();
        $total_donasi = Donasi::sum('jml_donasi');
        return view('components.shodaqoh.index', compact('donasi', 'user', 'total_donasi', 'programDonasi'));
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
        $programDonasi = ProgramDonasi::join('akuns', 'program_donasis.id_akun', '=', 'akuns.id')
                                    ->select('program_donasis.id', 'program_donasis.nama_program', 'akuns.nama_akun','akuns.persen_hak_amil')
                                    ->get();
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
            'programdonasi_id'=>'required'
        ]);

        // Join antara tabel akun dan program donasi
        $programDonasi = ProgramDonasi::join('akuns', 'program_donasis.id_akun', '=', 'akuns.id')
            ->where('program_donasis.id', $request->programdonasi_id)
            ->select('program_donasis.*', 'akuns.persen_hak_amil')
            ->first();

        // Menghitung nilai hak_amil
        $hak_amil = $request->jml_donasi * $programDonasi->persen_hak_amil / 100;

        $donasis = Donasi::where('programdonasi_id', $request->programdonasi_id)->get();
        $jumlah_donasi = $donasis->sum('jml_donasi');
        ProgramDonasi::where('id_akun', $programDonasi->id_akun)->where('id', $request->programdonasi_id)->update(['jumlah_donasi_program' => $jumlah_donasi]);

        // Mengupload gambar
        if($image=$request->file('buktiTf')){
            $destinationPath='buktitf/';
            $programImage = date('YmdHis') .".". $image->getClientOriginalName();
            $image->move($destinationPath, $programImage);
        }
        // Check if user is admin
        $donasi=Donasi::create([
            'jml_donasi'=>$request->jml_donasi,
            'no_rek'=>$request->no_rek,
            'keterangan'=>$request->keterangan,
            'status_id'=>'1',
            'user_id'=>$request->user_id,
            'programdonasi_id'=>$request->programdonasi_id,
            'hak_amil'=>$hak_amil,
            'nama_donatur'=>$request->nama_donatur,
            'buktiTf'=>$programImage
        ]);

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
        $programDonasi = ProgramDonasi::join('akuns', 'program_donasis.id_akun', '=', 'akuns.id')
                                    ->select('program_donasis.id', 'program_donasis.nama_program', 'akuns.nama_akun','akuns.persen_hak_amil')
                                    ->get();
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
        $akun = Akun::find($id);

        // Find the associated Akun
        $akun = Akun::find($donasi->programDonasi->id_akun);

        if (!$akun) {
            return back()->with('error', 'Akun tidak ditemukan');
        }
        $persen_hak_amil = $akun->persen_hak_amil;

        // Mengupload gambar baru (jika ada)
        if($image=$request->file('buktiTf')){
            $destinationPath='buktitf/';
            $programImage = date('YmdHis') .".". $image->getClientOriginalName();
            $image->move($destinationPath, $programImage);
        }

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

        // Decrement jumlah_donasi_program by 1 if it is greater than 0
    ProgramDonasi::where('id', $programdonasi_id)
        ->where('jumlah_donasi_program', '>', 0)
        ->decrement('jumlah_donasi_program', 0);

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
        // Mengambil semua data donasi dari database
        $donasi = Donasi::all();

        // Menghitung total donasi dengan menjumlahkan nilai jml_donasi dari setiap data donasi
        $total_donasi = $donasi->sum('jml_donasi');

        // Membuat objek PDF dengan view 'components.pdf.donasi' dan data $donasi dan $total_donasi
        $pdf = PDF::loadView('components.pdf.donasi', ['donasi' => $donasi, 'total_donasi' => $total_donasi]);

        // Mengembalikan objek PDF dalam bentuk stream
        return $pdf->stream('donasi.pdf');
    }


    public function cetakPertanggalDonasi($tglAwal, $tglAkhir){
        $cetakPertanggalDonasi=Donasi::all()->whereBetween('created_at',[$tglAwal, $tglAkhir]);
        $total_donasi = $cetakPertanggalDonasi->sum('jml_donasi');
        $pdf = PDF::loadView('components.pdf.donasi-pertanggal',[ 'cetakPertanggalDonasi'=>$cetakPertanggalDonasi, 'tglAwal'=>$tglAwal,'tglAkhir'=>$tglAkhir, 'total_donasi'=>$total_donasi]);
        return $pdf->stream('donasi-pertanggal.pdf');
    }
    public function exportExcel(){
        return Excel::download(new DonasiExport,'donasi.xlsx');
    }
    public function programIndex($id, $akun_id){
        $programDonasi=ProgramDonasi::find($id);
        $donasi=Donasi::all();
        $donasi_validated = Donasi::where('programdonasi_id', $id)->where('status_id', 2)->get();
        $totalDonationForProgram = $donasi_validated->sum('jml_donasi');
        $donasi=Donasi::where('programdonasi_id', $id)->get();
        $total_hak_amil = Donasi::where('programdonasi_id', $id)->sum('hak_amil');
        $akun = Akun::find($akun_id);
        return view('components.shodaqoh.program-index', compact('donasi','akun','total_hak_amil','programDonasi','totalDonationForProgram'));
    }

        public function cetakProgramDanAkunPertanggal( Request $request, $programId, $tglAwal, $tglAkhir) {

            $programDonasi = ProgramDonasi::findOrFail($programId);
            $programDonasi=ProgramDonasi::find($programId);
            $donasi=Donasi::all();
            $donasi_validated = Donasi::where('programdonasi_id', $programId)->where('status_id', 2)->get();
            $totalDonationForProgram = $donasi_validated->sum('jml_donasi');
            $donasi=Donasi::where('programdonasi_id', $programId)->get();
            $total_hak_amil = Donasi::where('programdonasi_id', $programId)->sum('hak_amil');
            $cetakProgramDanAkunPertanggal = Donasi::where('programdonasi_id', $programDonasi->id)
                ->whereBetween('created_at', [$tglAwal, $tglAkhir])
                ->get();
            $pdf = PDF::loadView('components.pdf.donasi-program-pertanggal',[
                'cetakProgramDanAkunPertanggal' => $cetakProgramDanAkunPertanggal,
                'programDonasi' => $programDonasi,
                'tglAwal'=> $tglAwal,
                'tglAkhir'=>$tglAkhir,
                'cetakProgramDanAkunPertanggal'=>$cetakProgramDanAkunPertanggal,
                'total_hak_amil'=>$total_hak_amil,
                'donasi'=>$donasi,
                'totalDonationForProgram'=>$totalDonationForProgram
            ]);
            return $pdf->stream('donasi-program-akun-pertanggal.pdf');
    }

    public function invoice($id){
        $donasi = DB::table('donasis')
            ->join('program_donasis', 'donasis.programdonasi_id', '=', 'program_donasis.id')
            ->join('users', 'donasis.user_id', '=', 'users.id')
            ->select('donasis.*', 'users.name', 'program_donasis.nama_program')
            ->where('donasis.id', $id)
            ->first();

        $donatur = DB::table('donasis')
            ->join('users', 'donasis.user_id', '=', 'users.id')
            ->select('users.*')
            ->where('donasis.id', $id)
            ->first();

        $programDonasi = ProgramDonasi::all();
        $today = Carbon::now()->format('Y-m-d');

        return view('components.shodaqoh.donasi-invoice', compact('today','donasi', 'donatur', 'programDonasi'));

    }


}