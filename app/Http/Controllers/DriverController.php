<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Driver;
use App\Models\Donatur;
use Illuminate\Http\Request;
use App\Models\ProgramDonasi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programDonasi=ProgramDonasi::all();
        $user=User::all();
        $driver=Driver::all();
        return view('components.drivers.index', compact('user','driver','programDonasi'));
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
            'nama_driver'=>'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        ]);


        $user= new User;
        $user->name=$request->nama_driver;
        $user->email=$request->email;
        $user->phone_number=$request->no_hp;
        $user->email_verified_at=now();
        $user->password= bcrypt('driver');
        $user->save();

        $request->request->add(['user_id'=>$user->id]);
        $driver=Driver::create($request->all());

        $user->attachRole('driver');
        return back()->With('success','Driver telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Driver $driver, $id)
    {
        $driver=Driver::find($id);
        $driver->update($request->all());
        return back()->With('update','Driver telah diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver, $id)
    {
        $driver=Driver::find($id);
        $driver->delete();
        return back()->With('delete','Driver telah dihapus');
    }
}