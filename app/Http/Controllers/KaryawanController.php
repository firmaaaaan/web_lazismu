<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Models\ProgramDonasi;
use App\Http\Controllers\Controller;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programDonasi=ProgramDonasi::all();
        $karyawans=Karyawan::all();
        return view('components.pegawai.index', compact('karyawans','programDonasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('components.pegawai.create');
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
            'nama_karyawan'=>'required',
            'tmpt_lahir'=>'required',
            'tgl_lahir'=>'required',
            'no_hp'=>'required',
            'alamat'=>'required'
        ]);
        Karyawan::create($request->all());
        return back()->with('Success','Data pegawai telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function show(Karyawan $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function edit(Karyawan $karyawan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Karyawan $karyawans, $id)
    {
        $request->validate([
            'nama_karyawan'=>'required',
            'tmpt_lahir'=>'required',
            'tgl_lahir'=>'required',
            'no_hp'=>'required',
            'alamat'=>'required'
        ]);
        $karyawans=Karyawan::find($id);
        $karyawans->update($request->all());
        return back()->with('Update','Data pegawai telah diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Karyawan $karyawans, $id)
    {
        $karyawans=Karyawan::find($id);
        $karyawans->delete();
        return redirect()->route('dropdown.pegawai.index')->with('delete','Data pegawai telah dihapus');
    }
}