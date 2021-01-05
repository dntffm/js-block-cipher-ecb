<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use app\pembayaran;
use app\m_order_paket;
use App\master;
use App\user;
use auth;
use Session;
use Illuminate\Support\Facades\Input;
class C_transaksi_paket extends Controller
{

    // mengelola transaksi --- master
    public function bayarpaket($id)
    {
    	$data_order = DB::table('order_art as oa') 
    ->join('paket_pekerjaan as pk', 'pk.id', '=', 'oa.id_paket')
    ->select(DB::raw('pk.nama_paket as nama_paket, total, pk.harga_paket as harga_paket, oa.nomor_order as nomor_order, oa.created_at as tanggal_dibuat, oa.id_master as activeuser, oa.id as id_order, oa.id_status_penerimaan as sp, DATE_ADD(oa.created_at, INTERVAL 10 HOUR) as due_date'))->where('oa.nomor_order', $id)
     ->first();    
    	return view('master.v_upload_transaksi', compact('data_order'));
    }

public function postbayarpaket(Request $request, $id)
    {
    	$this->validate($request,[         
            'bukti_transfer'=>'required',       
        ],
        	[
            'bukti_transfer.required' => 'masukkan upload bukti transfer pembayaran anda untuk melanjutkan',
        ]
    );
    	 $transaksi = pembayaran::find($id);
      //$transaksi->bukti_transfer = $request->bukti_transfer;
      if ($request->hasFile('bukti_transfer')) {
          $request->file('bukti_transfer')->move('images', $request->file('bukti_transfer')->getClientOriginalName());
          $transaksi->bukti_transfer = $request->file('bukti_transfer')->getClientOriginalName();
      }
      $transaksi->update($request->all());
      $nomor = 1;
       DB::table('order_art')
   ->update([ 
        "mp"=>  $nomor,
        ]);
      return redirect('/myorder')->with('success', 'bukti transaski sedang diproses, mohon tunggu');
    }


//mengelola transaksi --- admin

    public function verifytrans(request $request)
    {

        if ($request->has('cari')){
         $transaksi = \App\pembayaran::orderBy('created_at', 'DESC')
    ->where('kode_pembayaran', 'LIKE', '%'
          .$request->cari. '%')->where('id_statuspembayaran','=',1)->paginate(5);
      }else{
        $transaksi = \App\pembayaran::orderBy('created_at', 'DESC')->where('id_statuspembayaran','=',1)->paginate(5);
    }
         
       return view('admin.v_verify_transaksi', compact('transaksi'));
    }


    public function lihattrans(request $request)
    {
        if ($request->has('cari')){
         $transaksi = \App\pembayaran::orderBy('created_at', 'DESC')
    ->where('kode_pembayaran', 'LIKE', '%'
          .$request->cari. '%')->where('id_statuspembayaran','=',2)->paginate(5);
      }else{
        $transaksi = \App\pembayaran::orderBy('created_at', 'DESC')->where('id_statuspembayaran','=',2)->paginate(5);
    }
       return view('admin.v_transaksi_paket', compact('transaksi'));
    }

    public function failedtrans(request $request)
    {
        if ($request->has('cari')){
         $transaksi = \App\pembayaran::orderBy('created_at', 'DESC')
    ->where('kode_pembayaran', 'LIKE', '%'
          .$request->cari. '%')->where('id_statuspembayaran','=',4)->paginate(5);
      }else{
        $transaksi = \App\pembayaran::orderBy('created_at', 'DESC')->where('id_statuspembayaran','=',4)->paginate(5);
    }
       return view('admin.v_transaksigagal_paket', compact('transaksi'));
    }
       
    public function konfirmasi(request $request, $id)
    {
         DB::table('pembayaran')->where('id',$id)
   ->update([ 
        "id_statuspembayaran" => $request['statuspembayaran'],
      ]);
   return redirect('/datatransaksi')->with('success', 'pembayaran berhasil diverifikasi');
    }

    public function ditolak(request $request, $id)
    {
        DB::table('pembayaran as pb')->join('status_pembayaran as sp', 'sp.id', '=', 'pb.id_statuspembayaran')->where('pb.id', $id)
   ->update([ 
        "id_statuspembayaran" => $request['id_statuspembayaran'],
      ]);
   return redirect('/faileddatatransaksi')->with('gagal', 'pembayaran ditolak');
    }

    public function tolak_verif(request $request, $id)
    {     
      \App\m_order_paket::where('id',$id)->delete();
       return redirect('/data_order')->with('gagal', 'pembayaran ditolak');
    }

    public function selesai(request $request)
    {
        $id=$request->id;
         DB::table('order_art as oa')->join('art as ar', 'ar.user_id','=','id_art')->where('oa.id',$id)
   ->update([ 
        "mp" => $request['mp'],
        "status" => $request['status'],
      ]);
   return redirect('/myorder')->with('success', 'orderan berhasil diselesaikan');
    }
    

    ///art lihat riwayat order
    public function riwayatart(request $request)
   {
     $user = \Auth::user()->id;
      $data_order = DB::table('order_art as oa')
    ->join('master as ms', 'ms.user_id', '=', 'oa.id_master')
    ->join('users as us', 'us.id', '=', 'ms.user_id')
    ->join('art as ar', 'ar.user_id', '=', 'oa.id_art')
    ->join('paket_pekerjaan as pk', 'pk.id', '=', 'oa.id_paket')
    ->join('status_penerimaan as sp', 'sp.id', '=', 'oa.id_status_penerimaan')
    ->join('pembayaran as pb', 'pb.id_order', '=', 'oa.id')
    ->join('status_pembayaran as spp', 'spp.id', '=', 'pb.id_statuspembayaran')
    ->select(DB::raw('oa.id as id, oa.nomor_order as nomor_order, oa.id_master as master, ms.name as nama_master, ar.name as nama_art, pk.nama_paket as paket, pk.harga_paket as harga, sp.status_penerimaan as status_penerimaan, oa.created_at as tanggal_dibuat, us.username as username, oa.id_master as activeuser, oa.id_status_penerimaan as sp, DATE_ADD(oa.created_at, INTERVAL 10 HOUR) as due_date, spp.statuspembayaran as spp, pb.created_at as buat, pb.id_statuspembayaran as id_statuspembayaran, oa.waktu_kerja as waktu_kerja'))->where('oa.id_art', $user)->where('sp.status_penerimaan','=',1)->whereIN('oa.mp', [3, 5])->where('pb.id_statuspembayaran','=',2)->whereNull('oa.deleted_at')->orderBy('oa.created_at', 'desc')
     ->get(); 
    
    return view('art.v_riwayat_order', compact('data_order'));
   
   }
}
