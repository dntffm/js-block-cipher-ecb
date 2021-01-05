<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\m_review;
use DB;
class C_Review extends Controller
{
    public function simpanreview(Request $request, $id)
    {
      $this->validate($request,[
      'rating' => 'required',
      'review'=>'nullable',
      'foto' => 'mimes:jpg,png,jpeg|nullable',
    ]);
    	$review = m_review::create($request->all());
    	 if ($request->hasFile('foto')) {
          $request->file('foto')->move('images', $request->file('foto')->getClientOriginalName());
          $review->foto = $request->file('foto')->getClientOriginalName();
      }
      	$review->save();
      	$nomor = 5;
      	
       DB::table('order_art')->where('id',$id)
   		->update([ 
        "mp"=>  $nomor,
        ]);
    	return redirect('/myorder')->with('success', 'berhasil membuat review untuk ART');
    }

    public function review(Request $request)
    {
     if ($request->has('cari')){
      $review = \App\m_review::orderBy('created_at', 'DESC')->paginate(10);
    }else{
      $review = \App\m_review::orderBy('created_at', 'DESC')->paginate(10);
    }
    return view('admin.v_review',compact('review'));
    }
}
