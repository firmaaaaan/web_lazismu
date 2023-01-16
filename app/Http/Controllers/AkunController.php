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
        $akun=Akun::all();
        return view('components.akun.index', compact('akun'));
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
        $akun=Akun::all();
        Akun::create($request->all());
        return back();
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
        $akun=Akun::find($id);
        $akun->update($request->all());
        $persen_hak_amil = $request->input('persen_hak_amil');
        Donasi::where('id_akun', $id)->update(['hak_amil' => DB::raw("jml_donasi * $persen_hak_amil/100")]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function destroy(Akun $akun, $id)
    {
        $akun=Akun::find($id);
        $akun->delete();
        return back();
    }
    public function programDonasi($id_akun)
    {
        $programDonasi=ProgramDonasi::all();
        $akun=Akun::all();
        $programdonasis = ProgramDonasi::where('id_akun', $id_akun)->get();
        return view('components.akun.akun-program', compact('programdonasis','akun','programDonasi'));
    }
}