<?php

namespace App\Http\Controllers;

use App\MYCrypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Illuminate\Http\Request;
use App\art;
use App\master;
use App\User;
use DB;

class C_daftar extends Controller
{
  //register untuk admin
  public function KlikDaftar (){
    return view ('/auth.v_daftar');
  }

  public function daftarAction(Request $request){
    return $request->password;
    /* $this->validate($request,[

      'username'=>'required|min:5|unique:users|regex:/^\S*$/u',
      'email'=>'required|email',
      'password'=>'required|min:5',

    ]);
    $user = \App\User::create($request->all());
    $user->role= $request->role;
    $user->email= $request->email;
    $user->username= $request->username;
    $user->password= $request->password;
    $user->password=bcrypt($user ->password);
    $user->remember_token = str_random(60);
    $user->save();
    return redirect('/login')->with('sukses','Akun Berhasil Dibuat'); */
  }


  //register master
  public function KlikDaftarmaster (){
    return view ('/auth.v_daftar_master');
  }


  public function daftarActionnaster(Request $request){
    $hashh = MYCrypt::encrypt($request->password,'1000');
    $this->validate($request,[
      'name' => 'required|min:4|max:30',
      'nohp'=>'required|min:11|max:13|regex:/(08)[0-9]{9}/',
      'username'=>'required|min:5|max:15|unique:users|regex:/^\S*$/u',
      'email'=>'required|email|max:60',
      'password'=>'required|min:5|max:15',
      'alamat' => 'max: 60',
      'kecamatan' => 'max: 20',
      'kodepos' => 'max: 5',

    ]);
    $user = new \App\User;
    if ($request->has('submit')){
      $user->role= $request->role;
      $user->email= $request->email;
      $user->username= $request->username;
      $user->password= $request->password;
      $user ->password=MYCrypt::encrypt($user->password,'1000');
      $user->remember_token = str_random(60);
      $user->active_token=rand(100000,999999);
      $user->save();
      $request->request->add(['user_id'=> $user->id]);
      $master = \App\master::create($request->all());
      if ($request->hasFile('foto')) {
        $request->file('foto')->move('images', $request->file('foto')->getClientOriginalName());
        $master->foto = $request->file('foto')->getClientOriginalName();
        $master->save();
      }
      return redirect('/login')->with('sukses','Akun Berhasil Dibuat');
    }
  }
}
