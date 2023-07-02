<?php

namespace App\Http\Controllers;

use App\Models\RumahSakit;
use Illuminate\Http\Request;
use App\Models\ProgramDonasi;
use App\Models\permintaanAmbulan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RumahSakitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programDonasi=ProgramDonasi::all();
        $rumahSakit=RumahSakit::all();
        $rumahSakit=RumahSakit::simplePaginate(15);
        return view('components.rumah_sakit.index', compact('rumahSakit','programDonasi'));
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
            'nama_rs'=>'required',
            'alamat'=>'required'
        ]);
        RumahSakit::create($request->all());
        return back()->with('Success','Data rumah sakit telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RumahSakit  $rumahSakit
     * @return \Illuminate\Http\Response
     */
    public function show(RumahSakit $rumahSakit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RumahSakit  $rumahSakit
     * @return \Illuminate\Http\Response
     */
    public function edit(RumahSakit $rumahSakit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RumahSakit  $rumahSakit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RumahSakit $rumahSakit, $id)
    {
        $request->validate([
            'nama_rs',
            'alamat'
        ]);
        $rumahSakit=RumahSakit::find($id);
        $rumahSakit->update($request->all());
        return back()->with('Update','Data rumah sakit telah diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RumahSakit  $rumahSakit
     * @return \Illuminate\Http\Response
     */
    public function destroy(RumahSakit $rumahSakit, $id)
        {
            $rumahSakit = RumahSakit::find($id);
            if (!$rumahSakit) {
                return back()->withError('Rumah Sakit tidak ditemukan');
            }
            DB::beginTransaction();
            try {
                // hapus semua data yang terkait dengan Rumah Sakit yang dihapus
                permintaanAmbulan::where('rumahsakit_id', $rumahSakit->id)->delete();

                // hapus rumah sakit
                $rumahSakit->delete();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->withError('Terjadi kesalahan: ' . $e->getMessage());
            }
            return back()->with('delete','Data rumah sakit telah dihapus beserta seluruh data terkait.');
        }
}