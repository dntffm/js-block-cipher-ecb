@extends('admin.layouts.master')
@section('content')
@if(session('sukses'))
<div class="alert alert-success" role="alert">
  {{session('sukses')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
<ol class="breadcrumb">
  <li><i class="fa fa-home"></i><a href="{{url('/dashboard')}}">&nbsp;Home&nbsp;</a></li>
  <li>&#47;&nbsp;<i class="fas fa-people-carry"></i><a href="{{url('/data_paket_pekerjaan')}}">&nbsp;Data Paket Pekerjaan&nbsp;</a></li>
  <li>&#47;&nbsp;<i class="fas fa-people-carry"></i><a href="/paket_pekerjaan/{{$data_paket->id}}">&nbsp;Detail Paket&nbsp;</a></li>
  <li>&#47;&nbsp;<i class="fa fa-cogs"></i>&nbsp;Setting</li>
</ol>
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="col-sm-12 col-md-6">
      <h6 class="m-0 font-weight-bold text-primary">EDIT Data ART</h6>
    </div>
  </div>
  <div class="card-body" style="font-size: 15px;">
    <div class="table-responsive">
        <form action="/paket_pekerjaan/update/{{$data_paket->id}}" method="POST" enctype="multipart/form-data">
          {{csrf_field()}}
          <input type="text" name="role" value="3" hidden>
          <div class="form-group">
            <label >Foto</label>
            <input name="foto_paket" type="file" class="form-control" id="foto_paket" value="{{$data_paket->foto_paket}}">
            <span>{{$data_paket->getPhoto()}}</span>
          </div>
          <div class="form-group ">
            <label >Nama</label>
            <input name="nama_paket" type="text" class="form-control" id="nama_paket" value="{{$data_paket->nama_paket}}">
            @if($errors->has('nama_paket'))
            <span class="help-block">{{($errors->first('nama_paket'))}}</span>
            @endif
          </div>
          <div class="form-group">
            <label >Harga</label>
            <input name="harga_paket" type="text" class="form-control" id="harga_paket" value="{{$data_paket->harga_paket}}">
            @if($errors->has('harga_paket'))
            <span class="help-block">{{($errors->first('harga_paket'))}}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput2" value="">Deskripsi</label>
            <textarea class="form-control" id="deskripsi_paket" rows="3" name="deskripsi_paket" >{{$data_paket->deskripsi_paket}}</textarea>
            @if($errors->has('deskripsi_paket'))
            <span class="help-block">{{($errors->first('deskripsi_paket'))}}</span>
            @endif
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary"><a href="/paket_pekerjaan/{{$data_paket->id}}" style="text-decoration: none; color: #fff">Batal</a></button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>

      </div>
    </div>

    @endsection
