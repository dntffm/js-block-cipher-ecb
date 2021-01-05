<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Hash;
use App\User;
use App\master;
use App\art;
use DB;
class MasterController extends Controller
{
    //midleware
    public function __construct()
    {
    	$this->middleware('auth');
    }

    //error
    public function error()
    {
    	return view('master.404');
    }

    //about
    public function about()
    {
        return view('master.aboutus');
    }

    //contact
    public function contact()
    {
        return view('master.contactus');
    }

    //profil
    public function profilku($id)
    {
       $master = auth()->user()->masters;
        return view('master.v_profil', compact(['master']));
    }

    //edit profil
    public function setting($id){
        $users = \App\User::find($id);
        return view('master.edit', ['users' => $users]);
    }

    //update profil bug bosss
    // public function update(Request $request, $id){
    //     $users = \App\user::find($id);
    //      $users->update($request->all());
    //     $master = \App\master::find($id);
    //     $master->update($request->all());
    //     if ($request->hasFile('foto')) {
    //         $request->file('foto')->move('images/', $request->file('foto')->getClientOriginalName());
    //         $master->foto = $request->file('foto')->getClientOriginalName();
    //         $master->save($request->all());}
    //     return redirect('/myprofil/{id}')->with('success', 'data berhasil diubah');
    //     }
    //versi 2 update 
    public function update(Request $request, $id){
        
    $user = \Auth::user()->id;
    if ($request->hasFile('foto')) {
            $request->file('foto')->move('images', $request->file('foto')->getClientOriginalName());
           DB::table('users as u')
   ->join('master as m', 'u.id', '=', 'm.user_id')->where('u.id', $user)
   ->update([ 
        "username" => $request->username,
        "email" => $request->email,
        "name" => $request->name,
        "nohp"=>  $request->nohp,
        "kecamatan"=>  $request->kecamatan,
        "alamat" => $request->alamat,
        "kodepos" => $request->kodepos,
        "foto" => $request->file('foto')->getClientOriginalName(),
    ]);
}
        
   else
    {
           DB::table('users as u')
   ->join('master as m', 'u.id', '=', 'm.user_id')->where('u.id', $user )
   ->update([ 
        "username" => $request->username,
        "email" => $request->email,
        "name" => $request->name,
        "nohp"=>  $request->nohp,
        "kecamatan"=>  $request->kecamatan,
        "alamat" => $request->alamat,
        "kodepos" => $request->kodepos, ]);
    }
        return redirect(url('/myprofil/{id}'))->with('success', 'data berhasil diubah');
        }

    //ganti password
    public function changepass($id)
    {
        return view('master.changepw');
    }

    //update ganti password
    public function postpass(Request $request)
    {
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
        return redirect(url('/myprofil/'.$id))->with('success', 'password telah berganti');
    }

    public function detailart($id)
    {
        $art = \App\art::find($id);
        // $nomor = \App\art::find($id)->pluck('user_id');
        $review = DB::table('review as rw')
    ->join('order_art as oa', 'oa.id', '=', 'rw.order_id')
    ->join('master as ms', 'ms.user_id', '=', 'oa.id_master')
    ->join('users as us', 'us.id', '=', 'ms.user_id')
     ->select(DB::raw('rating, review, us.username as username, rw.created_at as buat, rw.foto as fotos'))
    ->where('oa.id_art',$art->user->id)->get();
    $foto = \App\m_review::all();
      $count = DB::table('review  as rw')->join('order_art as oa', 'oa.id', '=', 'rw.order_id')
     ->select(DB::raw('AVG(rating) as nilai, oa.id_art'))
                     ->groupBy('oa.id_art')
                     ->first();

        return view('master.v_detail_art', compact('art','review','count', 'foto'));
    }
}
