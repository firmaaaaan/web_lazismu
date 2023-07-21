<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Zakat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProgramDonasi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{
    public function index(){
        $programDonasi=ProgramDonasi::all();
        $user=User::all();
        $role=Role::all();
        return view('components.user.index', compact('user','role','programDonasi'));
    }

    public function create(){
        $programDonasi=ProgramDonasi::all();
        return view('components.user.create', compact('programDonasi'));
    }

    public function store(Request $request ){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone_number'=>['required','max:12','unique:'.User::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed'],
        ]);
        $user = User::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role'=>$request->role
        ]);

        $user->attachRole($request->role_id);
        event(new Registered($user));


        return back()->with('success','User baru telah ditambahkan');
    }

    public function destroy($id){
        $user=User::find($id);
        $user->delete();

        return back();
    }
}