<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Donasi;
use Illuminate\Http\Request;
use App\Models\ProgramDonasi;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programDonasi=ProgramDonasi::all();
        $donasi= Donasi::all();
        $akun=Akun::all();
        return view('components.akun.index', compact('akun','donasi','programDonasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'kode'=>'required',
            'nama_akun' => 'required',
            'persen_hak_amil'=>'required'
        ]);
        $akun=Akun::all();
        Akun::create($request->all());
        return back()->with('success', 'Data akun telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function show(Akun $akun)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function edit(Akun $akun)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Akun $akun, $id)
{
    $request->validate([
        'kode' => 'required|unique:akuns,kode,' . $id,
        'nama_akun' => 'required',
        'persen_hak_amil' => 'required'
    ]);

    $akun = Akun::findOrFail($id);
    $akun->update($request->all());

    $programDonasi = ProgramDonasi::where('id_akun', $id)->first();

    if ($programDonasi) {
        $id_akun_program_donasi = $programDonasi->id;
        $persen_hak_amil = $request->input('persen_hak_amil');

        DB::table('donasis')
            ->join('program_donasis', 'donasis.programdonasi_id', '=', 'program_donasis.id_akun')
            ->where('donasis.programdonasi_id', $id_akun_program_donasi)
            ->update(['donasis.hak_amil' => DB::raw("donasis.jml_donasi * $persen_hak_amil/100")]);

        return back()->with('info', 'Akun berhasil diperbarui');
    } else {
        // Tindakan jika entitas ProgramDonasi tidak ditemukan
        return back()->with('error', 'Tidak ada Program Donasi yang terkait dengan Akun ini');
    }
    return back()->with('info', 'Data akun telah diubah');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function destroy(Akun $akun, $id)
        {
            $akun = Akun::find($id);
            if (!$akun) {
                return back()->withError('Akun tidak ditemukan');
            }
            DB::beginTransaction();
            try {
                // hapus semua data yang terkait dengan akun yang dihapus
                ProgramDonasi::where('id_akun', $akun->id)->delete();
                Donasi::where('id_akun', $akun->id)->delete();

                // hapus akun
                $akun->delete();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->withError('Terjadi kesalahan: ' . $e->getMessage());
            }
            return back()->withSuccess('Akun berhasil dihapus beserta seluruh data terkait.');
        }

    public function programDonasi($id_akun)
    {
        $programDonasi=ProgramDonasi::all();
        $akun=Akun::all();
        $programdonasis = ProgramDonasi::where('id_akun', $id_akun)->get();
        return view('components.akun.akun-program', compact('programdonasis','akun','programDonasi'));
    }
}