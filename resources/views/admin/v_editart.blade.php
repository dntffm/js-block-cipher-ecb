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
              <li><i class="fa fa-home"></i><a href="/dashboard">&nbsp;Home&nbsp;</a></li>
              <li>&#47;&nbsp;<i class="fa fa-users"></i><a href="/dataart">&nbsp;Data ART&nbsp;</a></li>
               <li>&#47;&nbsp;<i class="fa fa-user"></i><a href="/art/profile/{{$art->id}}">&nbsp;Profile&nbsp;</a></li>
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
<form action="/art/{{$art->id}}/update" method="POST" enctype="multipart/form-data" >
        	{{csrf_field()}}
  <div class="form-group">
    <label >Foto</label>
    <input name="foto" type="file" class="form-control" id="foto"  value="{{$art->foto}}" >
    <i>{{$art->getPhoto()}}</i>
  </div>
  <div class="form-group">
    <label >Nama</label>
    <input name="name" type="text" class="form-control" id="name" value="{{$art->name}}" >
    @if($errors->has('name'))
            <span class="help-block">{{($errors->first('name'))}}</span>
    @endif
  </div>
  <div class="form-group">
          <label >No Hp</label>
          <input name="nohp" type="text" class="form-control" id="nohp" value="{{$art->nohp}}">
          @if($errors->has('nohp'))
            <span class="help-block">{{($errors->first('nohp'))}}</span>
          @endif
        </div>
        <div class="form-group">
          <label >Tanggal Lahir</label>
          <input type="date" class="form-control" id="tanggallahir" name="tanggallahir" value="{{$art->tanggallahir}}">
          @if($errors->has('tanggallahir'))
            <span class="help-block">{{($errors->first('tanggallahir'))}}</span>
          @endif
        </div>
        <div class="form-group">
          <label >Kecamatan</label>
          <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="{{$art->kecamatan}}">
          @if($errors->has('kecamatan'))
            <span class="help-block">{{($errors->first('kecamatan'))}}</span>
          @endif
        </div>
        <div class="form-group">
          <label >Alamat</label>
          <input type="text" class="form-control" id="alamat" name="alamat" value="{{$art->alamat}}">
          @if($errors->has('alamat'))
            <span class="help-block">{{($errors->first('alamat'))}}</span>
          @endif
        </div>
        <div class="form-group">
          <label >kode Pos</label>
          <input type="text" class="form-control" id="kodepos" name="kodepos" value="{{$art->kodepos}}">
          @if($errors->has('kodepos'))
            <span class="help-block">{{($errors->first('kodepos'))}}</span>
          @endif
        </div>
        <div class="form-group">
          <label >status</label>
        <select class="form-control" id="status" name="status">
        <option value="Available" @if($art->status == 'Availabe') selected @endif>Availabe</option>
        <option value="Hired" @if($art->status == 'Hired') selected @endif>Hired</option>
        </select>
        </div>
        <div class="form-group">
          <label for="formGroupExampleInput2">Deskripsi</label>
          <textarea class="form-control" id="deskripsi" rows="3" name="deskripsi" >{{$art->deskripsi}}</textarea>
        </div>
   <button type="button" class="btn btn-secondary"><a href="/art/profile/{{$art->id}}" style="text-decoration: none; color: #fff">Batal</a></button>
  <button type="submit" class="btn btn-primary">simpan</button>
  </div>
      </form>
      </div>
      </div>

@endsection
