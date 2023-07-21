<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Donasi;
use App\Models\Mustahik;
use App\Models\Penyaluran;
use Illuminate\Http\Request;
use App\Models\ProgramDonasi;
use App\Http\Controllers\Controller;

class PenyaluranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mustahik=Mustahik::all();
        $programDonasi=ProgramDonasi::all();
        $penyaluran=Penyaluran::join('program_donasis', 'program_donasis.id', '=', 'penyaluran.programdonasi_id')
                    ->select('penyaluran.*', 'program_donasis.nama_program')
                    ->get();

        return view('components.penyaluran.index', compact('programDonasi','penyaluran','mustahik'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programDonasi=ProgramDonasi::all();
        $mustahik=Mustahik::all();
        $donasi=Donasi::all();
        return view('components.penyaluran.create', compact('programDonasi','donasi','mustahik'));
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
            $id_mustahik = $request->input('id_mustahik');


            // Kurangi nilai nominal_program pada tabel program_donasi
            $programDonasi = ProgramDonasi::find($programdonasi_id);

            // Pastikan jumlah donasi yang tersedia cukup untuk disalurkan
            if ($programDonasi->jumlah_donasi_program < $request->input('nominal')) {
                return back()->with('error', 'Jumlah donasi yang tersedia tidak cukup untuk disalurkan!');
            }

            //Cek apakah ada donasi yang belum tervalidasi
            $berlumTervalidasi = Donasi::where('programdonasi_id', $request->input('programdonasi_id'))
                ->where('status_id', 1)
                ->get();

            if ($berlumTervalidasi->isNotEmpty()) {
                return back()->with('belum', 'Terdapat donasi yang belum tervalidasi yang tidak bisa disalurkan!');
            }
            $programDonasi->jumlah_donasi_program -= $nominal;
            $programDonasi->save();

            // Simpan data penyaluran
            Penyaluran::create([
                'programdonasi_id' => $programdonasi_id,
                'nominal' => $nominal,
                'deskripsi_penyaluran'=>$request->deskripsi_penyaluran,
                'id_mustahik' => $id_mustahik
            ]);

            // Jumlahkan nilai nominal penyaluran untuk program_donasi yang bersangkutan
            $tersalurkan = Penyaluran::where('programdonasi_id', $programdonasi_id)->sum('nominal');

            // Update nilai tersalurkan pada tabel program_donasi
            $programDonasi = ProgramDonasi::find($programdonasi_id);
            $programDonasi->tersalurkan = $tersalurkan;
            $programDonasi->save();

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
    public function edit($id)
    {
        $programDonasi = ProgramDonasi::all();
        $penyaluran = Penyaluran::find($id);
        return view('components.penyaluran.edit', compact('programDonasi', 'penyaluran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penyaluran  $penyaluran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $penyaluran = Penyaluran::find($id);
        $penyaluran->update($request->all());

        // update jumlah_donasi_program dan tersalurkan di tabel program_donasi
        $programDonasi = ProgramDonasi::find($penyaluran->programdonasi_id);
        $programDonasi->jumlah_donasi_program -= $penyaluran->nominal;
        $programDonasi->jumlah_donasi_program += $penyaluran->nominal;
        $programDonasi->tersalurkan -= $penyaluran->nominal;
        $programDonasi->tersalurkan += $penyaluran->nominal;
        $programDonasi->update();

        return redirect()->route('index.penyaluran')->with('success', 'Data penyaluran berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penyaluran  $penyaluran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penyaluran=Penyaluran::find($id);
        // Ambil program_donasi_id sebelum dihapus
        $programdonasi_id = $penyaluran->programdonasi_id;
        $nominal = $penyaluran->nominal;

        // Hapus record penyaluran
        $penyaluran->delete();

        // Update program_donasi
        $programDonasi = ProgramDonasi::find($programdonasi_id);
        $programDonasi->jumlah_donasi_program += $nominal;
        $programDonasi->tersalurkan -= $nominal;
        $programDonasi->update();

        return back()->with('info','Penyaluran berhasil dihapus');
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