<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Zakat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{
    public function index(){
        $user=User::all();
        $role=Role::all();
        return view('components.user.index', compact('user','role'));
    }

    public function create(){
        return view('components.user.create');
    }

    public function store(Request $request ){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed'],
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role'=>$request->role
        ]);

        $user->attachRole($request->role_id);
        event(new Registered($user));


        return redirect()->route('user.index');
    }

    public function destroy($id){
        $user=User::find($id);
        $user->delete();

        return back();
    }
}