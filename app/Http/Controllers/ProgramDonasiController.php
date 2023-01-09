<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ProgramDonasi;
use App\Http\Controllers\Controller;

class ProgramDonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programDonasi=ProgramDonasi::all();
        $programDonasi=ProgramDonasi::simplePaginate(15);
        return view('components.program_donasi.index', compact('programDonasi'));
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
        // $request->validate([
        //     'nama_program'=>'required',
        //     'no.rek'=>'required',
        //     'deskripsi'=>'required'
        // ]);

        $input = $request->all();
        if($image=$request->file('foto')){
            $destinationPath='images/';
            $programImage = date('YmdHis') .".". $image->getClientOriginalName();
            $image->move($destinationPath, $programImage);
            $input['foto']="$programImage";
        }
        ProgramDonasi::create($input);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProgramDonasi  $programDonasi
     * @return \Illuminate\Http\Response
     */
    public function show(ProgramDonasi $programDonasi, $id)
    {
        $user=User::all();
        $programDonasi=ProgramDonasi::find($id);
        return view('components.program_donasi.show', compact('programDonasi','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProgramDonasi  $programDonasi
     * @return \Illuminate\Http\Response
     */
    public function edit(ProgramDonasi $programDonasi, $id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProgramDonasi  $programDonasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProgramDonasi $programDonasi, $id )
    {
        $request->validate([
            'nama_program'=>'required',
            'no.rek'=>'required',
            'deskripsi'=>'required'
        ]);
        $programDonasi=ProgramDonasi::find($id);
        $input = $request->all();
        if($image=$request->file('foto')){
            $destinationPath='images/';
            $programImage = date('YmdHis') .".". $image->getClientOriginalName();
            $image->move($destinationPath, $programImage);
            $input['foto']="$programImage";
        }else{
            unset($input['foto']);
        }
        $programDonasi->update($input);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProgramDonasi  $programDonasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProgramDonasi $programDonasi, $id)
    {
        $programDonasi=ProgramDonasi::find($id);
        $programDonasi->delete();
        return back();
    }

}