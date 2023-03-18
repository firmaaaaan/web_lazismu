<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\Penyaluran;
use Illuminate\Http\Request;
use App\Models\ProgramDonasi;
use App\Http\Controllers\Controller;
use PDF;

class PenyaluranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programDonasi=ProgramDonasi::all();
        $penyaluran=Penyaluran::join('program_donasis', 'program_donasis.id', '=', 'penyaluran.programdonasi_id')
                    ->select('penyaluran.*', 'program_donasis.nama_program')
                    ->get();

        return view('components.penyaluran.index', compact('programDonasi','penyaluran'));
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
        return view('components.penyaluran.create', compact('programDonasi','donasi'));
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
                'nominal' => 'required|numeric|min:10000',
            ]);

            $programdonasi_id = $request->input('programdonasi_id');
            $nominal = $request->input('nominal');


            // Kurangi nilai nominal_program pada tabel program_donasi
            $programDonasi = ProgramDonasi::find($programdonasi_id);

            // Pastikan jumlah donasi yang tersedia cukup untuk disalurkan
            if ($programDonasi->jumlah_donasi_program < $request->input('nominal')) {
                return back()->with('error', 'Jumlah donasi yang tersedia tidak cukup untuk disalurkan!');
            }
            // Cek apakah ada donasi yang belum tervalidasi
                    $berlumTervalidasi = Donasi::where('programdonasi_id', $request->input('programdonasi_id'))
                        ->where('status_id', 1)
                        ->get();

                    if ($berlumTervalidasi->sum('jml_donasi') >= $request->input('tersalurkan')) {
                        return back()->with('belum', 'Terdapat donasi yang belum tervalidasi yang tidak bisa disalurkan!');
                    }
            $programDonasi->jumlah_donasi_program -= $nominal;
            $programDonasi->save();



            // Simpan data penyaluran
            Penyaluran::create([
                'programdonasi_id' => $programdonasi_id,
                'nominal' => $nominal,
                'deskripsi_penyaluran'=>$request->deskripsi_penyaluran
            ]);

            return back()->with('success', 'Donasi berhasil disalurkan');
        }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penyaluran  $penyaluran
     * @return \Illuminate\Http\Response
     */
    public function show(Penyaluran $penyaluran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penyaluran  $penyaluran
     * @return \Illuminate\Http\Response
     */
    public function edit(Penyaluran $penyaluran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penyaluran  $penyaluran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penyaluran $penyaluran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penyaluran  $penyaluran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penyaluran $penyaluran)
    {
        //
    }

    public function cetakPertanggalPenyaluran($tglAwal, $tglAkhir)
        {
            $programDonasi = ProgramDonasi::all();
            $penyaluran = Penyaluran::join('program_donasis', 'program_donasis.id', '=', 'penyaluran.programdonasi_id')
                                    ->select('penyaluran.*', 'program_donasis.nama_program')
                                    ->whereBetween('penyaluran.created_at', [$tglAwal, $tglAkhir])
                                    ->orderBy('penyaluran.created_at', 'asc')
                                    ->get();

            $pdf = PDF::loadView('components.pdf.cetak-penyaluran-pertanggal', [
                'penyaluran' => $penyaluran,
                'programDonasi' => $programDonasi,
                'tglAwal' => $tglAwal,
                'tglAkhir' => $tglAkhir
            ]);

            return $pdf->stream('penyaluran-pertanggal.pdf');
        }

}