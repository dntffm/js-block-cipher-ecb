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
class C_ART extends Controller
{
	//lihat semua art
	public function dataart(Request $request){

		if ($request->has('cari')){
			$data_art = \App\art::orderBy('created_at', 'DESC')->where('name', 'LIKE', '%'
			.$request->cari. '%')->paginate(10);
		}else{
			$data_art = \App\art::orderBy('created_at', 'DESC')->paginate(10);
		}
		return view('admin.v_art',['data_art' => $data_art]);
	}

	//buat data art
	public function create(Request $request){
		$this->validate($request,[
			'name' => 'required|min:4|max: 30',
			'username'=>'required|min:5|max:15|unique:users|regex:/^\S*$/u',
			'email'=>'required|email',
			'password'=>'required|min:5|max:15',
			'foto' => 'mimes:jpg,png,jpeg',
			'tanggallahir' => 'date|after:1960-12-12|before:2001-12-12|nullable',
			'nohp'=>'required|min:11|max:13|regex:/(0)[0-9]{10}/',

			'alamat' => 'min:5|max:60|nullable',
			'kecamatan' => 'min:4|max:20|nullable',
		]);
		$user = \App\user::create($request->all());
		$user->password = bcrypt($user->password);
		$user->remember_token = str_random(60);
		$user->save();
		$request->request->add(['user_id'=> $user->id]);
		$art = \App\art::create($request->all());
		if ($request->hasFile('foto')) {
			$request->file('foto')->move('images', $request->file('foto')->getClientOriginalName());
			$art->foto = $request->file('foto')->getClientOriginalName();
			$art->save();
		}
		return redirect(url('/dataart'))->with('sukses','data berhasil ditambahkan');
	}

	//edit data art
	public function edit($id){
		$art = \App\art::find($id);
		return view('admin.v_editart', ['art' => $art]);
	}

	//update dataart
	public function update(Request $request, $id){
		$this->validate($request,[
			'name' => 'required|min:4|max: 30',
			'foto' => 'mimes:jpg,png,jpeg',
			'tanggallahir' => 'date|after:1960-12-12|before:2001-12-12|nullable',
			'nohp'=>'required|min:11|max:13|regex:/(0)[0-9]{10}/',
			'kodepos' => 'numeric|min:4|max:5|nullable',
			'alamat' => 'min:5|max:60|nullable',
			'kecamatan' => 'min:4|max:20|nullable',
		]);
		$art = \App\art::find($id);
		$art->update($request->all());
		if ($request->hasFile('foto')) {
			$request->file('foto')->move('images', $request->file('foto')->getClientOriginalName());
			$art->foto = $request->file('foto')->getClientOriginalName();
			$art->save($request->all());
		}
		if ( $art )
		return redirect(url('/dataart'))->with('sukses', 'data berhasil diubah');
	}

	//liat profil data art
	public function profilart(Request $request, $id){
		$art = \App\art::find($id);
		$user = $request->user_id;
		$order = \App\m_order_paket::where('id_art', $art->user->id)->first();

		$review = DB::table('review as rw')
    ->join('order_art as oa', 'oa.id', '=', 'rw.order_id')
     ->select(DB::raw('rating'))
    ->where('oa.id_art','=',$art->user->id)->get();

      $count = DB::table('review  as rw')->join('order_art as oa', 'oa.id', '=', 'rw.order_id')
     ->select(DB::raw('AVG(rating) as nilai, oa.id_art'))
                     ->groupBy('oa.id_art')
                     ->first(); 
		return view('admin.v_profileart', compact('art','review','count','order'));
	}



}
