<?php

namespace App\Http\Controllers;

use App\Models\RumahSakit;
use Illuminate\Http\Request;

class RumahSakitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rumahSakit=RumahSakit::all();
        $rumahSakit=RumahSakit::simplePaginate(15);
        return view('components.rumah_sakit.index', compact('rumahSakit'));
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
            'nama_rs',
            'alamat'
        ]);
        RumahSakit::create($request->all());
        return back();
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
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RumahSakit  $rumahSakit
     * @return \Illuminate\Http\Response
     */
    public function destroy(RumahSakit $rumahSakit, $id)
    {
        $rumahSakit=RumahSakit::find($id);
        $rumahSakit->delete();
        return redirect()->route('dropdown.rumahsakit.index');

    }
}