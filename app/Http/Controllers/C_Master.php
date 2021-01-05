<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Session;
use Hash;
use App\User;
use App\master;
use App\art;
class C_master extends Controller
{

    //midleware
    public function __construct()
    {
        $this->middleware('auth');
    }

    //liat data master
    public function datamaster(Request $request){
         if ($request->has('cari')){
            $data_master = \App\master::orderBy('created_at', 'DESC')->where('name', 'LIKE', '%'
            .$request->cari. '%')->paginate(10);
        }else{
            $data_master = \App\master::orderBy('created_at', 'DESC')->paginate(10);
        }
        return view('admin.v_master',['data_master' => $data_master]);
    }

    //liat profil data master
     public function profilmaster($id){
        $master = \App\master::find($id);
        return view('admin.v_profilemaster', ['master' => $master]);

    }

    // //lom fungsi
    // public function decrypt()
    // {
    //     $decrypt = crypt::decryptString($user->password);
    // }

}
