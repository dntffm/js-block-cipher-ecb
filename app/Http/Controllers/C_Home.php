<?php

namespace App\Http\Controllers;
use App\Art;
use App\User;
use DB;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;
class c_Home extends Controller
{


  public function homeall(Request $request)
  {
    if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
               return $this->setviewhome();
            }elseif(Auth::user()->role == 'master'){
               return $this->setviewhomemaster($request);
            }else{
               return $this->setviewhomeart();
            }
        }else{
            return view('index');
        }
  }
  //homenya admin
  public function setviewhome (){
    $dataorder = \App\m_order_paket::selectRaw("DATE_FORMAT(created_at,'%M') date")
    ->groupBy('date')->orderby('date', 'desc')->whereIn('mp', [3, 5])->distinct('date')->get();

    $count_art = DB::table('art')->count();
    $count_mast = DB::table('master')->count();
    $count_paket = DB::table('paket_pekerjaan')->count();
    $count_order = DB::table('order_art')->count();

    $count_transaksi = DB::table('order_art')->whereIN('mp', [3, 5])->where('created_at', '<', Carbon::now()->startOfMonth()->subMonth()->endOfMonth()->toDateTimeString())->count();

    $yy = DB::table('order_art')->whereIN('mp', [3, 5])->where('created_at', '>', Carbon::now()->startOfMonth()->subMonth()->endOfMonth()->toDateTimeString())->sum('total');

     $zz = DB::table('order_art')->whereIN('mp', [3, 5])->where('created_at', '>', Carbon::now()->startOfMonth()->subMonth()->endOfMonth()->toDateTimeString())->sum('total');

     $c_trans = DB::table('order_art')->whereIN('mp', [3, 5])->where('created_at', '<', Carbon::now()->startOfMonth()->subMonth()->endOfMonth()->toDateTimeString())->sum('total');

     $bulan =  DB::table('order_art')->select(DB::raw("DATE_FORMAT(created_at,'%M') as months"))->groupBy('months')->get();
      $bulans=[];
     $pajak =  5000 * $count_transaksi;
     $hasil_bersih = $c_trans - $pajak;
     $pajaks=[];
     $bersih=[];

     // \App\m_order_paket::select(DB::raw('DATE_PART(\'MONTH\', created_at) AS MONTH'))->whereIn('mp', [3, 5])->groupBy('MONTH')->distinct()->pluck('MONTH');
     foreach ($dataorder as $order) {
       $bulans[]=$order->date;

     }

    //dd($bulans);
     
    return view ('admin.v_home', ['count' => $count_art,'counts' => $count_mast, 'paket' => $count_paket,'order' => $count_order], compact('c_trans', 'count_transaksi', 'pajak', 'hasil_bersih','dataorder','bulans','yy', 'zz'));
    
  }

  //homenya master
  public function setviewhomemaster (Request $request)
  {
    $id = $request->user_id;
   // $review = \App\m_review::inRandomOrder()->take(3)->get();
    $crev = \App\m_review::all(); 
     $review = DB::table('review as rw')
    ->join('order_art as oa', 'oa.id', '=', 'rw.order_id')
    ->join('master as ms', 'ms.user_id', '=', 'oa.id_master')
    ->join('users as us', 'us.id', '=', 'ms.user_id')
   ->get();
    $data_art = \App\art::paginate(4);
     $count = DB::table('review  as rw')->join('order_art as oa', 'oa.id', '=', 'rw.order_id')
     ->select(DB::raw('AVG(rating) as nilai, oa.id_art'))
                     ->groupBy('oa.id_art', $id)
                     ->first();

    // $paket = \App\paket_pekerjaan::paginate(3);
    $paket = \App\paket_pekerjaan::inRandomOrder()->take(3)->get();
    return view('master.v_home_master',['data_art' => $data_art, 'paket' => $paket, 'count' => $count, 'review' => $review, 'crev'=>$crev]);

  }

  //homenya art
  public function setviewhomeart (){
    $paket = \App\paket_pekerjaan::paginate(3);
    return view ('art.v_home_art', [ 'paket' => $paket]);
  }
}
