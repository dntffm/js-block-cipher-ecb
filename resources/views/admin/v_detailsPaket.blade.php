@extends('admin.layouts.master')
@section('content')
 <div class="row">
  @if(session('sukses'))
    <div class="alert alert-success" role="alert">
      {{session('sukses')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    </div>
  @endif
  <div class="col-sm col-md-12">
    <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="/dashboard">&nbsp;Home&nbsp;</a></li>
              <li>&#47;&nbsp;<i class="fas fa-people-carry"></i><a href="{{url('/data_paket_pekerjaan')}}">&nbsp;Data Paket Pekerjaan&nbsp;</a></li>
              <li>&#47;&nbsp;<i class="fas fa-people-carry"></i>&nbsp;Detail Paket</li>
            </ol>
           <div class="card shadow text-primary border-bottom-info bg-gray-100">
            <div class="card-header text-center bg-gray-600"><h2 style="color:#fff"><i class="fas fa-people-carry">&nbsp;DETAIL PAKET</i></h2></div><br>
               <div class="row col-12 card-text ">
                <div class="col-xl-12 sm-2 md-2 text-center ">
                  <div class="img rounded-circle" style="text-align: center;">
                    <img src="{{$data_paket->getPhoto()}}" alt="foto" style="width: 500px;  margin-bottom: 15px;">
                  </div>
                  <h6>{{$data_paket->nama_paket}}</h6>
                  <div style=" margin-bottom: 10px">
                    <a href="/paket_pekerjaan/edit/{{$data_paket->id}}" class="btn btn-danger">Edit</a>
                  </div>
                </div>
                <div class="col-xl-12 sm-4 md-4 text-center ">
                  <p style="margin-top: 5px; margin-bottom: 1rem;">Harga: Rp {{$data_paket->harga_paket}},00</p>
                  <h6>
                   <span><i class="icon_clock_alt"></i>Deskripsi: {{$data_paket->deskripsi_paket}}</span>
                   </h6>
                </div>
                </div>
                </div>
              </div>
            </div>
@endsection
