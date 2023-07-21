<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use Carbon\Carbon;
use App\Models\Akun;
use App\Models\User;
use App\Models\Donasi;
use App\Models\Donatur;
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
        $donatur=Donatur::all();
        $akun=Akun::all();
        $programDonasi = ProgramDonasi::join('akuns', 'program_donasis.id_akun', '=', 'akuns.id')
                                        ->select('program_donasis.id', 'program_donasis.nama_program', 'akuns.nama_akun','akuns.persen_hak_amil')
                                        ->get();
        $donasi=Donasi::all();
        return view('components.shodaqoh.create', compact('programDonasi', 'donasi','akun','user','donatur'));
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
            'jml_donasi' => 'required',
            'programdonasi_id' => 'required'
        ]);

        // Join antara tabel akun dan program donasi
        $programDonasi = ProgramDonasi::join('akuns', 'program_donasis.id_akun', '=', 'akuns.id')
            ->where('program_donasis.id', $request->programdonasi_id)
            ->select('program_donasis.*', 'akuns.persen_hak_amil')
            ->first();

        // Menghitung nilai hak_amil
        $hak_amil = $request->jml_donasi * $programDonasi->persen_hak_amil / 100;

        // Mengupload gambar
        if ($image = $request->file('buktiTf')) {
            $destinationPath = 'buktitf/';
            $programImage = date('YmdHis') . "." . $image->getClientOriginalName();
            $image->move($destinationPath, $programImage);
        }
        $statusId = 1; // Mengatur status_id sebagai 1 secara default
        $donasiData = [
            'jml_donasi' => $request->jml_donasi,
            'nama_donatur' => $request->nama_donatur,
            'no_rek' => $request->no_rek,
            'keterangan' => $request->keterangan,
            'status_id' => $statusId,
            'id_donatur' => $request->id_donatur,
            'programdonasi_id' => $request->programdonasi_id,
            'hak_amil' => $hak_amil,
            'nama_donatur' => $request->nama_donatur,
            // 'buktiTf' => $programImage
        ];

        $donasi = Donasi::create($donasiData);

            $donasi->programDonasi->jumlah_donasi_program += $request->input('jml_donasi');
            $donasi->programDonasi->jumlah_donasi_program -= $donasi->programDonasi->tersalurkan;
            $donasi->programDonasi->save();
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
        $donatur=Donatur::all();
        $programDonasi = ProgramDonasi::join('akuns', 'program_donasis.id_akun', '=', 'akuns.id')
                                    ->select('program_donasis.id', 'program_donasis.nama_program', 'akuns.nama_akun','akuns.persen_hak_amil')
                                    ->get();
        $user=User::all();
        return view('components.shodaqoh.edit', compact('programDonasi', 'donasi','akun','user','donatur'));

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
            'jml_donasi' => 'required',

        ]);
    
        $donasi = Donasi::find($id);
        $programdonasi_id = $request->input('programdonasi_id');
    
        // Find the associated Akun
        $akun = Akun::find($donasi->programDonasi->id_akun);
    
        if (!$akun) {
            return back()->with('error', 'Akun tidak ditemukan');
        }
    
        $persen_hak_amil = $akun->persen_hak_amil;

        // Initialize the programImage variable
        $programImage = $donasi->buktiTf;
        // Mengupload gambar baru (jika ada)
        if($image=$request->file('buktiTf')){
            $destinationPath='buktitf/';
            $programImage = date('YmdHis') .".". $image->getClientOriginalName();
            $image->move($destinationPath, $programImage);
        }
    
        $donasi->update([
            'jml_donasi'=>$request->jml_donasi,
            'nama_donatur'=>$request->nama_donatur,
            'no_rek'=>$request->no_rek,
            'keterangan'=>$request->keterangan,
            'id_donatur'=>$request->id_donatur,
            'buktiTf'=>$programImage
        ]);
    
        // Update hak_amil
        $donasi->hak_amil = ($request->jml_donasi * $persen_hak_amil) / 100;
        $donasi->save();
    
        // Update jumlah program donasi
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
    $jml_donasi = $donasi->jml_donasi; // Nilai donasi yang akan dikurangi

    $donasi->delete();

    // Update jumlah program donasi
    $jumlah_donasi = Donasi::where('programdonasi_id', $programdonasi_id)->sum('jml_donasi');
    $programDonasi = ProgramDonasi::find($programdonasi_id);
    $programDonasi->jumlah_donasi_program = $jumlah_donasi - $jml_donasi; // Mengurangi nilai donasi yang dihapus
    $programDonasi->save();

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
    public function faktur($id) {
        $donasi = Donasi::with('programDonasi','donatur')->find($id);
        $today = Carbon::now()->format('Y-m-d');
        $thirtyDaysAhead = Carbon::now()->addDays(30)->format('Y-m-d');
        return view('components.shodaqoh.invoice-donasi', compact('donasi','today','thirtyDaysAhead','donasi'));
    }


}