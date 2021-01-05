<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\master;
use auth;
use App\paket_pekerjaan;
use Session;
use Illuminate\Support\Facades\Input;
use DB;
use App\art;
use App\m_bank;
use App\m_order_paket;
use App\status_penerimaan;
use App\pembayaran;
use App\pajak;
use App\kecamatan;
use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;
class c_order_paket extends Controller
{


  //untuk master
  //buat order
   public function klikorder($id)
   {
    $kecamatan = kecamatan::all();
    $pajaks = '1';
    $total = 0;
    $master = auth()->user()->masters;
		$art = art::where('status', '=', 1)->get();
		$bank =m_bank::all();
		$status = status_penerimaan::all();
		$data_paket = \App\paket_pekerjaan::find($id);
    $pajak = pajak::find($pajaks);
    $total = $data_paket->harga_paket + $pajak->pajak;
    // $total = DB::table('data_paket')->select(DB::raw('SUM(harga_paket', $pajak) as 'total'))->get();
		return view ('master.v_order_paket', compact('data_paket', 'art', 'bank', 'status', 'master','pajak','total','kecamatan'));
   }

   //simpan order
   public function postorder(Request $request){
   	 $this->validate($request,[         
            'kecamatan'=>'required|min:4|max:20',
            'kodepos'=>'required|min:4|max:5',
            'alamat'=>'required|min:4|max:60',
            'waktu_kerja' => 'required|after:23 hours|before: 168 Hours',         
        ],
        	[
            'kecamatan.required' => 'masukkan kecamatan anda untuk melanjutkan',
             'kodepos.required' => 'masukkan kodepos anda untuk melanjutkan',
              'alamat.required' => 'masukkan alamat anda untuk melanjutkan',
              'waktu_kerja.required' => 'tentukan waktu kerja',
              'waktu_kerja.after' => 'pilihan waktu kerja harus diset setelah hari ini / 24 jam kedepan',
              'waktu_kerja.before' => 'pilihan waktu kerja harus diset kurang dari 7 hari kedepan ',
              'waktu_kerja.between' => 'pilihan waktu kerja harus diset antara jam 8 hingga 20'
        ]
    );
     $user =  \Auth::user()->id;
   	   $order = new m_order_paket;
       $pin = mt_rand(1000000, 9999999);
       $nomor = 1;
        $nomor_pb = str_shuffle($pin);
        $order->id_art = $request->art_id;
        $order->id_master = $request->master_id;
       	$order->id_paket = $request->paket_id;
        $order->id_bank = $request->bank_id;
        $order->id_status_penerimaan =$request->status_id;
         $order->waktu_kerja = $request->waktu_kerja;
          $order->nomor_order = $nomor_pb;
          $order->mp = $nomor;
          $order->total = $request->total;
        $order->save();
        //tambahan dulu
         // $request->request->add(['order_id'=> $order->id]);
         //  $pembayaran = new pembayaran;
         //  $pembayaran->save();
         //  $pembayaran->save();

          ///end
        DB::table('master')
   ->where('user_id', $user )
   ->update([ 
        "kecamatan"=>  $request->kecamatan,
        "alamat" => $request->alamat,
        "kodepos" => $request->kodepos, ]);
        return redirect(url("/orderproses/".$order->nomor_order))->with('success', 'pesanan berhasil dibuat');
        
   }

   //tagihan order
   public function checkout($id)
   {
     $data_order = DB::table('order_art as oa')->join('bank as bn', 'bn.id', '=', 'oa.id_bank')->select(DB::raw('oa.id as id, bn.no_rekening as no_rekening, bn.nama as nama, bn.bank as bank, oa.nomor_order as nomor_order, oa.created_at as created_at'))->where('oa.nomor_order', $id)->first();
     // dd($data_order);
   	return view('master.v_checkout_paket', compact('data_order'));
   }
   
public function cekproses($id)
   {
     $data_order = DB::table('order_art as oa')->join('bank as bn', 'bn.id', '=', 'oa.id_bank')->select(DB::raw('oa.id as id, bn.no_rekening as no_rekening, bn.nama as nama, bn.bank as bank, oa.nomor_order as nomor_order, oa.created_at as created_at'))->where('oa.nomor_order', $id)->first();
     // dd($data_order);
    return view('master.v_edit_checkout_paket', compact('data_order'));
   }
   //lihat order
   public function myorder(request $request)
   {
     $user = \Auth::user()->id;

     $data_order = DB::table('order_art as oa')
    ->join('master as ms', 'ms.user_id', '=', 'oa.id_master')
    ->join('users as us', 'us.id', '=', 'ms.user_id')
    ->join('art as ar', 'ar.user_id', '=', 'oa.id_art')
    ->join('paket_pekerjaan as pk', 'pk.id', '=', 'oa.id_paket')
    ->join('bank as b', 'b.id', '=', 'oa.id_bank')
    ->join('status_penerimaan as sp', 'sp.id', '=', 'oa.id_status_penerimaan')
    ->select(DB::raw('oa.id as id, oa.nomor_order as nomor_order, oa.id_master as master, ms.name as nama_master, ar.name as nama_art, pk.nama_paket as paket, total, pk.harga_paket as harga, b.bank as bank, sp.status_penerimaan as status_penerimaan, oa.created_at as tanggal_dibuat, us.username as username, oa.id_master as activeuser, oa.id_status_penerimaan as sp, DATE_ADD(oa.created_at, INTERVAL 10 HOUR) as due_date'))->where('oa.id_master', $user)->where('sp.status_penerimaan','=',3)->whereNull('oa.deleted_at')->orderBy('oa.created_at', 'desc')
     ->get();    

     
     $order_acc = DB::table('order_art as oa')
    ->join('master as ms', 'ms.user_id', '=', 'oa.id_master')
    ->join('users as us', 'us.id', '=', 'ms.user_id')
    ->join('art as ar', 'ar.user_id', '=', 'oa.id_art')
    ->join('paket_pekerjaan as pk', 'pk.id', '=', 'oa.id_paket')
    ->join('bank as b', 'b.id', '=', 'oa.id_bank')
    ->join('status_penerimaan as sp', 'sp.id', '=', 'oa.id_status_penerimaan')
    ->select(DB::raw('oa.id as id, oa.nomor_order as nomor_order, oa.id_master as master, ms.name as nama_master, ar.name as nama_art, pk.nama_paket as paket, pk.harga_paket as harga, b.bank as bank, sp.status_penerimaan as status_penerimaan, oa.created_at as tanggal_dibuat, us.username as username, oa.id_master as activeuser, oa.id_status_penerimaan as sp, DATE_ADD(oa.created_at, INTERVAL 1 Minute) as due_date'))->where('oa.id_master', $user)->where('sp.status_penerimaan','=',1)->where('oa.mp', '=', 1)->whereNull('oa.deleted_at')->orderBy('oa.created_at', 'desc')
     ->get(); 

     $order_ver = DB::table('order_art as oa')
    ->join('master as ms', 'ms.user_id', '=', 'oa.id_master')
    ->join('users as us', 'us.id', '=', 'ms.user_id')
    ->join('art as ar', 'ar.user_id', '=', 'oa.id_art')
    ->join('paket_pekerjaan as pk', 'pk.id', '=', 'oa.id_paket')
    ->join('status_penerimaan as sp', 'sp.id', '=', 'oa.id_status_penerimaan')
    ->join('pembayaran as pb', 'pb.id_order', '=', 'oa.id')
    ->join('status_pembayaran as spp', 'spp.id', '=', 'pb.id_statuspembayaran')
    ->select(DB::raw('oa.id as id, oa.nomor_order as nomor_order, oa.id_master as master, ms.name as nama_master, ar.name as nama_art, pk.nama_paket as paket, pk.harga_paket as harga, sp.status_penerimaan as status_penerimaan, oa.created_at as tanggal_dibuat, us.username as username, oa.id_master as activeuser, oa.id_status_penerimaan as sp, DATE_ADD(oa.created_at, INTERVAL 10 HOUR) as due_date, spp.statuspembayaran as spp, pb.created_at as buat, pb.id_statuspembayaran as id_statuspembayaran'))->where('oa.id_master', $user)->where('sp.status_penerimaan','=',1)->where('oa.mp', '=', 2)->where('pb.id_statuspembayaran','=',1)->whereNull('oa.deleted_at')->orderBy('oa.created_at', 'desc')
     ->get(); 

     $trans_acc = DB::table('order_art as oa')
    ->join('master as ms', 'ms.user_id', '=', 'oa.id_master')
    ->join('users as us', 'us.id', '=', 'ms.user_id')
    ->join('art as ar', 'ar.user_id', '=', 'oa.id_art')
    ->join('paket_pekerjaan as pk', 'pk.id', '=', 'oa.id_paket')
    ->join('status_penerimaan as sp', 'sp.id', '=', 'oa.id_status_penerimaan')
    ->join('pembayaran as pb', 'pb.id_order', '=', 'oa.id')
    ->join('status_pembayaran as spp', 'spp.id', '=', 'pb.id_statuspembayaran')
    ->select(DB::raw('oa.id as id, oa.waktu_kerja as waktukerja, oa.nomor_order as nomor_order, oa.id_master as master, ms.name as nama_master, ar.name as nama_art, pk.nama_paket as paket, pk.harga_paket as harga, sp.status_penerimaan as status_penerimaan, oa.created_at as tanggal_dibuat, us.username as username, oa.id_master as activeuser, oa.id_status_penerimaan as sp, DATE_ADD(oa.created_at, INTERVAL 10 HOUR) as due_date, spp.statuspembayaran as spp, pb.created_at as buat, pb.id_statuspembayaran as id_statuspembayaran'))->where('oa.id_master', $user)->where('sp.status_penerimaan','=',1)->where('oa.mp', '=', 2)->where('pb.id_statuspembayaran','=',2)->whereNull('oa.deleted_at')->orderBy('oa.created_at', 'desc')
     ->get(); 

     $done_order = DB::table('order_art as oa')
    ->join('master as ms', 'ms.user_id', '=', 'oa.id_master')
    ->join('users as us', 'us.id', '=', 'ms.user_id')
    ->join('art as ar', 'ar.user_id', '=', 'oa.id_art')
    ->join('users as use', 'use.id', '=', 'ar.user_id')
    ->join('paket_pekerjaan as pk', 'pk.id', '=', 'oa.id_paket')
    ->join('status_penerimaan as sp', 'sp.id', '=', 'oa.id_status_penerimaan')
    ->join('pembayaran as pb', 'pb.id_order', '=', 'oa.id')
    ->join('status_pembayaran as spp', 'spp.id', '=', 'pb.id_statuspembayaran')
    ->select(DB::raw('oa.id as id, oa.mp as mp,oa.nomor_order as nomor_order, oa.id_master as master, ms.name as nama_master, ar.name as nama_art, use.username as us_art, pk.nama_paket as paket, pk.harga_paket as harga, sp.status_penerimaan as status_penerimaan, oa.created_at as tanggal_dibuat, us.username as username, oa.id_master as activeuser, oa.id_status_penerimaan as sp, DATE_ADD(oa.created_at, INTERVAL 10 HOUR) as due_date, spp.statuspembayaran as spp, pb.created_at as buat, pb.id_statuspembayaran as id_statuspembayaran'))->where('oa.id_master', $user)->where('sp.status_penerimaan','=',1)->whereIN('oa.mp', [3, 5])->where('pb.id_statuspembayaran','=',2)->whereNull('oa.deleted_at')->orderBy('oa.created_at', 'desc')
     ->get(); 

     $batal_order = DB::table('order_art as oa')
    ->join('master as ms', 'ms.user_id', '=', 'oa.id_master')
    ->join('users as us', 'us.id', '=', 'ms.user_id')
    ->join('art as ar', 'ar.user_id', '=', 'oa.id_art')
    ->join('paket_pekerjaan as pk', 'pk.id', '=', 'oa.id_paket')
    ->join('bank as b', 'b.id', '=', 'oa.id_bank')
    ->join('status_penerimaan as sp', 'sp.id', '=', 'oa.id_status_penerimaan')
    ->select(DB::raw('oa.id as id, ms.name as nama_master, ar.name as nama_art, pk.nama_paket as paket, pk.harga_paket as harga, b.bank as bank, sp.status_penerimaan as status_penerimaan, oa.created_at as tanggal_dibuat, us.username as username, oa.id_master as activeuser, oa.id_status_penerimaan as sp, oa.nomor_order as nomor_order'))->where('oa.id_master', $user)->whereOr('sp.status_penerimaan','=',2)->wherenotNull('oa.deleted_at')
     ->orderBy('oa.created_at', 'desc')->get();
   
    $batalinorder = m_order_paket::where('mp','=',1)->where('updated_at', '<', Carbon::now()->subDays(1))->get();
      $status = 1;
      $mp = 4;
    if($batalinorder){
    foreach ($batalinorder as $orderbodong) {
        DB::table('order_art as oa')->join('art as ar', 'ar.user_id', '=', 'oa.id_art')->whereIn('oa.mp',[1, 2])->where('oa.updated_at', '<', Carbon::now()->subDays(1))
   ->update([ 
        "status" => $status,
        "mp" => $mp,
      ]);
        $orderbodong->delete();
    }}

     $autoselesai = m_order_paket::where('mp','=',2)->where('waktu_kerja', '<', Carbon::now()->subDays(1))->get();
      $mp = 3;
    if($autoselesai){
    foreach ($autoselesai as $autoselesai) {
        DB::table('order_art')->where('mp','=',2)->where('waktu_kerja', '<', Carbon::now()->subDays(1))
   ->update([ 
        "mp" => $mp,
      ]);
    }}

    return view('master.v_orderan_master', compact('data_order','batal_order', 'order_acc', 'order_ver', 'trans_acc','done_order', 'batalinorder'));

   }

//batalkan pesan
     public function batal_order(request $request, $id)
     {
     
      
       // $order = DB::table('order_art')->where('id',$id);
       // $order->delete();
      \App\m_order_paket::where('id',$id)->delete();
    
       return redirect('/myorder')->with('success', 'pesanan telah dibatalkan');
     }


   //untuk admin
   public function lihatorder(request $request)
   {
     if ($request->has('cari')){
          $data_order = DB::table('order_art as oa')
    ->leftjoin('master as ms', 'ms.user_id', '=', 'oa.id_master')
    ->leftjoin('users as us', 'us.id', '=', 'ms.user_id')
    ->leftjoin('art as ar', 'ar.user_id', '=', 'oa.id_art')
    ->leftjoin('paket_pekerjaan as pk', 'pk.id', '=', 'oa.id_paket')
    ->leftjoin('bank as b', 'b.id', '=', 'oa.id_bank')
    ->leftjoin('status_penerimaan as sp', 'sp.id', '=', 'oa.id_status_penerimaan')
    ->select(DB::raw('oa.id as nomor, total, mp, oa.nomor_order as nomor_order, us.username as username,ms.name as nama_master, ar.name as nama_art, pk.nama_paket as paket, pk.harga_paket as harga, b.bank as bank, sp.status_penerimaan as status_penerimaan, oa.created_at as tanggal_dibuat'))
    ->where('nomor_order', 'LIKE', '%'
          .$request->cari. '%')->orderBy('tanggal_dibuat', 'desc')->get();
    
      }else{
    $data_order = DB::table('order_art')
    ->leftjoin('master', 'order_art.id_master', '=', 'master.user_id')
    ->leftjoin('users', 'users.id', '=', 'master.user_id')
    ->leftjoin('art', 'order_art.id_art', '=', 'art.user_id')
    ->leftjoin('paket_pekerjaan', 'order_art.id_paket', '=', 'paket_pekerjaan.id')
    ->leftjoin('bank', 'order_art.id_bank', '=', 'bank.id')
    ->leftjoin('status_penerimaan', 'order_art.id_status_penerimaan', '=', 'status_penerimaan.id')
    ->select(DB::raw('order_art.id as nomor, total, order_art.nomor_order as nomor_order,users.username as username, master.name as nama_master, art.name as nama_art, paket_pekerjaan.nama_paket as paket, paket_pekerjaan.harga_paket as harga, bank.bank as bank, status_penerimaan.status_penerimaan as status_penerimaan, order_art.created_at as tanggal_dibuat, mp'))->whereNull('order_art.deleted_at')->orderBy('tanggal_dibuat', 'desc')
    ->get();
     
    }
    return view('admin.v_order_paket', compact('data_order'));
   
   }

  public function lihatriwayat()
     {

      return redirect(url('/notfound'));
     
     }
     public function myorderhistory()
     {

      return redirect(url('/error'));
     
     }

     
     //art lihat order
     public function pesananku(request $request)
   {
     $user = \Auth::user()->id;
     $data_order = DB::table('order_art as oa')
    ->join('master as ms', 'ms.user_id', '=', 'oa.id_master')
    ->join('users as us', 'us.id', '=', 'ms.user_id')
    ->join('art as ar', 'ar.user_id', '=', 'oa.id_art')
    ->join('paket_pekerjaan as pk', 'pk.id', '=', 'oa.id_paket')
    ->join('bank as b', 'b.id', '=', 'oa.id_bank')
    ->join('status_penerimaan as sp', 'sp.id', '=', 'oa.id_status_penerimaan')
    ->select(DB::raw('oa.id as id,total, ms.name as nama_master, ar.name as nama_art, pk.nama_paket as paket, pk.harga_paket as harga, b.bank as bank, sp.status_penerimaan as status_penerimaan, oa.created_at as tanggal_dibuat, us.username as username, oa.id_master as activeuser, oa.id_status_penerimaan as sp, DATE_ADD(oa.created_at, INTERVAL 10 HOUR) as due_date, waktu_kerja'))->where('oa.id_art', $user)->where('oa.updated_at', '>', Carbon::now()->subDays(1))->whereNull('oa.deleted_at')->orderBy('tanggal_dibuat', 'desc')
    ->get();
    
    return view('art.v_orderan_art', compact('data_order'));
   
   }
   public function terima(request $request, $id)
   {
    
     DB::table('order_art as oa')->join('art as ar', 'ar.user_id', '=', 'oa.id_art')->where('oa.id', $id)
   ->update([ 
        "id_status_penerimaan" => $request['id_status_penerimaan'],
        "status" => $request['status_kerja'],
      ]);
     $transaksi = \App\pembayaran::create($request->all());
      $transaksi->save();
  
   return redirect()->back()->with('success', 'order berhasil diterima');
   }

   public function tolak(request $request, $id)
   {
     DB::table('order_art as oa')->join('art as ar', 'ar.user_id', '=', 'oa.id_art')->where('oa.id', $id)
   ->update([ 
        "id_status_penerimaan" => $request['id_status_penerimaan'],
          "status" => $request['status_kerja'],
      ]);
   return redirect()->back()->with('gagal', 'order telah ditolak');
   }

   public function posttransaksi(Request $request)
    {
      $this->validate($request,[         
            'bukti_transfer'=>'required',       
        ],
          [
            'bukti_transfer.required' => 'masukkan upload bukti transfer pembayaran anda untuk melanjutkan',
        ]
    );
      $transaksi = pembayaran::create($request->all());
      $transaksi->id_statuspembayaran  = $request->id_statuspembayaran;
      $pin = mt_rand(1100000000111, 9999999999999);
        $kode_pembayaran = str_shuffle($pin);
        $transaksi->kode_pembayaran = $kode_pembayaran;
      $transaksi->id_order  = $request->id_order;
      $transaksi->day_start = $request->day_start;
      $transaksi->day_over = $request->day_over;
      if ($request->hasFile('bukti_transfer')) {
          $request->file('bukti_transfer')->move('images', $request->file('bukti_transfer')->getClientOriginalName());
          $transaksi->bukti_transfer = $request->file('bukti_transfer')->getClientOriginalName();
      }
      $transaksi->save();
      $nomor = 2;
      $id = $request->id_order;
       DB::table('order_art')->where('id',$id)
   ->update([ 
        "mp"=>  $nomor,
        ]);
      return redirect('/myorder')->with('success', 'bukti transaski sedang diproses, mohon tunggu');
    }
}
