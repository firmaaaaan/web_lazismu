<?php

namespace App\Http\Controllers;

use App\Models\Mustahik;
use Illuminate\Http\Request;

class MustahikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mustahik=Mustahik::all();
        return view('components.mustahik.index', compact('mustahik'));
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
            'nama'=>'required',
        ]);
        Mustahik::create($request->all());
        return back()->with('success','Data mustahik telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mustahik  $mustahik
     * @return \Illuminate\Http\Response
     */
    public function show(Mustahik $mustahik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mustahik  $mustahik
     * @return \Illuminate\Http\Response
     */
    public function edit(Mustahik $mustahik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mustahik  $mustahik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mustahik=Mustahik::find($id);
        $mustahik->update($request->all());

        return back()->with('info','Data mustahik telah diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mustahik  $mustahik
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nustahik=Mustahik::find($id);
        $nustahik->delete();
        return back()->with('delete','Data mustahik telah dihapus');
    }
}