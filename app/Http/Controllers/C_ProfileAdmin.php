<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Hash;
class C_ProfileAdmin extends Controller
{
    //liat profil
	public function profiladmin($id){
       return view('admin.v_profileadmin');
    }

    //editprofil
    public function editadmin($id){
        $users = \App\User::find($id);
        return view('admin.v_editadmin', ['users' => $users]);
    }

    //updateprofil
	public function updateadmin(Request $request, $id){
        //dd($request->all());
        $users = \App\user::find($id);
        $users->update($request->all());
        return redirect('/dataku/{id}')->with('sukses', 'data berhasil diubah');
    }

    //liatgantipass
    public function gantipw($id){
       return view('admin.v_gantipwadmin');
    }

    //updatepw
    public function updatepass(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:5'
        ]);
        if(!(Hash::check($request->get('current_password'), Auth::User()->password))){
            return redirect()->back()->with('error', 'password tidak cocok');
        }
        if(strcmp($request->get('current_password'), $request->get('new_password')) == 0){
            return redirect()->back()->with('error', 'password tidak sama dengan new password');
        }
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:5'
        ]);
        $user = Auth::User();
        $user->password = bcrypt($request->get('new_password'));
        $user->save();
        return redirect('/dataku/{id}')->with('sukses', 'password telah diperbarui');
    }
}
