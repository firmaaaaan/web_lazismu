<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Donatur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class DonaturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('components.donatur.index');
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
        // $user->role_id='5';
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


        Auth::login($user);
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
    public function edit(Donatur $donatur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Donatur  $donatur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donatur $donatur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Donatur  $donatur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donatur $donatur)
    {
        //
    }
}
