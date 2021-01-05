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
      <li>&#47;&nbsp;<i class="fa fa-user"></i><a href="/dataku/{{$users->id}}/">&nbsp;Profile&nbsp;</a></li>
      <li>&#47;&nbsp;<i class="fa fa-cogs"></i>&nbsp;Setting</li>
   </ol>
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="col-sm-12 col-md-6">
    <h6 class="m-0 font-weight-bold text-primary">EDIT Data ADMIN</h6>
    </div>
  </div>
  <div class="card-body" style="font-size: 15px;">
      <div class="table-responsive">
<form action="/admin/{{$users->id}}/update" method="POST" >
        	{{csrf_field()}}
       <div class="form-group">
          <label >username</label>
          <input type="text" class="form-control" id="username" name="username" value="{{$users->username}}">
          @if($errors->has('username'))
            <span class="help-block">{{($errors->first('username'))}}</span>
          @endif
        </div>
     <div class="form-group">
          <label >Email</label>
          <input name="email" type="email" class="form-control" id="email" value="{{$users->email}}">
          @if($errors->has('email'))
            <span class="help-block">{{($errors->first('email'))}}</span>
          @endif
        </div>
        <div class="form-group">
          <label><a href="/dataku/edit/gantipassword/{{auth()->user()->id}}">Ganti Password</a></label>
        </div>
          <button type="button" class="btn btn-secondary"><a href="/dataku/{{$users->id}}/" style="text-decoration: none; color: #fff">Batal</a></button>
        <button type="submit" class="btn btn-primary">Simpan</button>
     </div>
      </form>
      </div>
      </div>
      
@endsection

