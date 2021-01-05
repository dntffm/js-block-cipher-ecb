<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Hash;
use App\paket_pekerjaan;
class C_Paket_Pekerjaan extends Controller
{

//ADMIN :
  //lihat paket
    public function index(Request $request)
    {
      if ($request->has('cari')){
          $data_paket = \App\paket_pekerjaan::orderBy('created_at', 'DESC')->where('nama_paket', 'LIKE', '%'
          .$request->cari. '%')->paginate(5);

      }else{
        $data_paket = \App\paket_pekerjaan::orderBy('created_at', 'DESC')->paginate(5);
      }
        return view ('admin.v_paket_pekerjaan', compact('data_paket'));
    }

    //buat paket
    public function create(Request $request)
    {
      $this->validate($request,[
          'nama_paket' => 'required|min:5|max:30|unique:paket_pekerjaan',
          'harga_paket'=>'required|numeric|min:30000',
          'deskripsi_paket' => '|min:15|'
      ]);
      $data_paket = \App\paket_pekerjaan::create($request->all());
       if ($request->hasFile('foto_paket')) {
          $request->file('foto_paket')->move('images', $request->file('foto_paket')->getClientOriginalName());
          $data_paket->foto_paket = $request->file('foto_paket')->getClientOriginalName();
      }
      $data_paket ->save();
      return redirect('/data_paket_pekerjaan')->with('sukses','data berhasil ditambahkan');
    }

    //lihat detail paket
    public function show($id)
    {
        $data_paket = \App\paket_pekerjaan::find($id);
          return view ('admin.v_detailsPaket', ['data_paket' => $data_paket]);
    }

    //edit paket  
    public function edit($id)
    {
      $data_paket = \App\paket_pekerjaan::find($id);
      return view ('admin.v_editpaketpk', ['data_paket' => $data_paket]);
    }

    //update paket
    public function update(Request $request, $id)
    {
       $this->validate($request,[
          'nama_paket' => 'required|min:5|max:30',
          'harga_paket'=>'required|numeric|min:30000|max:10000000',
          'deskripsi_paket' => '|min:15|'
      ]);
      $data_paket = \App\paket_pekerjaan::find($id);
      $data_paket->update($request->all());
     if ($request->hasFile('foto_paket')) {
         $request->file('foto_paket')->move('images', $request->file('foto_paket')->getClientOriginalName());
         $data_paket->foto_paket = $request->file('foto_paket')->getClientOriginalName();
         $data_paket->save($request->all());
     }
     return redirect('/data_paket_pekerjaan')->with('sukses', 'data berhasil diubah');
    }

   //Master
     //lihat paket untuk master
  public function paket_pekerjaan ()
  {
    $paket = \App\paket_pekerjaan::paginate(6);
    return view('master.v_paket_pekerjaan',['paket' => $paket]);
  }
   public function show_paket($id)
    {
        $paket = \App\paket_pekerjaan::find($id);
          return view ('master.v_detail_paket_pekerjaan', compact('paket'));
    }

  //art
  //lihat paket untuk art
    public function paket_pekerjaan_art (){

      $paket = \App\paket_pekerjaan::paginate(6);
      return view('art.v_paket_pekerjaan', ['paket' => $paket]);

    }

    //lihat detail paket
    public function detailpaket($id)
    {
       $paket =paket_pekerjaan::find($id);
     return view('art.v_detail_paket_pekerjaan', compact('paket'));
    }
}
