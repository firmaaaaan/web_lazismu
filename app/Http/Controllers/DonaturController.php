<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Donatur;
use Illuminate\Http\Request;
use App\Models\ProgramDonasi;
use App\Http\Controllers\Controller;
use App\Models\Donasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Models\Role;


class DonaturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programDonasi=ProgramDonasi::all();
        $donatur=Donatur::all();
        $user=User::all();
        return view('components.donatur.index', compact('donatur','user','programDonasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('components.donatur.create');
    }

    public function tambah()
    {
        return view('components.donatur.tambah');
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
            'nama_donatur'=>'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        ]);


        $user= new User;
        $user->name=$request->nama_donatur;
        $user->email=$request->email;
        $user->email_verified_at=now();
        $user->password= bcrypt($request->password);
        // $user->remember_token=Str(50);
        $user->save();

        $request->request->add(['user_id'=>$user->id]);
        $donatur=Donatur::create($request->all());

        $user->attachRole('customer');

        event(new Registered($user));

        // event(new Registered($user));


        // Auth::login($user);
        return redirect()->route('login');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Donatur  $donatur
     * @return \Illuminate\Http\Response
     */
    public function show(Donatur $donatur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Donatur  $donatur
     * @return \Illuminate\Http\Response
     */
    public function edit(Donatur $donatur, $id)
    {
        $donatur=Donatur::find($id);
        return view('components.donatur.edit', compact('donatur'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Donatur  $donatur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donatur $donatur, $id)
    {
        $donatur=Donatur::find($id);
        $donatur->update($request->all());
        return redirect()->route('donatur.index')->with('update','Donatur telah diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Donatur  $donatur
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $donatur=Donatur::find($id);
        $donatur->delete();

        return back()->with('delete','Donatur telah dihapus');
    }
}