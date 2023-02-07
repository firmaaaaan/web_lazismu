<?php

namespace App\Http\Controllers;

use App\Models\Dokumentasi;
use Illuminate\Http\Request;
use App\Models\ProgramDonasi;
use App\Http\Controllers\Controller;

class DokumentasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programDonasi=ProgramDonasi::all();
        $doks=Dokumentasi::all();
        return view('components.dokumentasi.index', compact('doks','programDonasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programDonasi=ProgramDonasi::all();
        return view('components.dokumentasi.create', compact('programDonasi'));
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
            'judul'=>'required',
            'foto_unggulan'=>'image|required',
            'text'=>'required'
        ]);
        $input = $request->all();
        if($image=$request->file('foto_unggulan')){
            $destinationPath='images/';
            $programImage = date('YmdHis') .".". $image->getClientOriginalName();
            $image->move($destinationPath, $programImage);
            $input['foto_unggulan']="$programImage";
        }
        Dokumentasi::create($input);
        // return back();
        return redirect('/dokumentasi/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dokumentasi  $dokumentasi
     * @return \Illuminate\Http\Response
     */
    public function show(Dokumentasi $dokumentasi, $id)
    {
        $programDonasi=ProgramDonasi::all();
        $doks=Dokumentasi::find($id);
        return view('components.dokumentasi.show', compact('doks','programDonasi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dokumentasi  $dokumentasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Dokumentasi $dokumentasi, $id)
    {
        $programDonasi=ProgramDonasi::all();
        $doks=Dokumentasi::find($id);
        return view('components.dokumentasi.edit', compact('doks','programDonasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dokumentasi  $dokumentasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dokumentasi $dokumentasi, $id)
    {

        $doks=Dokumentasi::find($id);
        $doks->update($request->all());
        return redirect()->route('dokumentasi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dokumentasi  $dokumentasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dokumentasi $dokumentasi, $id)
    {
        $doks=Dokumentasi::find($id);
        $doks->delete();
        return redirect()->route('dokumentasi.index');
    }
}