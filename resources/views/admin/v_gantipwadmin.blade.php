@extends('admin.layouts.master')
@section('content')
@if(session('error'))
    <div class="alert alert-warning" role="alert">
      {{session('error')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    </div>
  @endif
   <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="/dashboard">&nbsp;Home&nbsp;</a></li>
              <li>&#47;&nbsp;<i class="fa fa-user"></i><a href="#">&nbsp;Profile&nbsp;</a></li>
              <li>&#47;&nbsp;<i class="fa fa-cogs"></i>&nbsp;Setting</li>
      </ol>
<div class="card shadow">
<div class="faq padding ptb-xs-40">
  <div class="container"> <h3>Ganti Password</h3>
  <form action="/updatepassword/{id}" method="POST">
        	{{csrf_field()}}
          <div class="form-group">
        <label >Password Sekarang</label>
        <input name="current_password" type="password" class="form-control" id="Password" value="{{auth()->user()->Password}}">
        @if($errors->has('current_password'))
            <span class="help-block">{{($errors->first('current_password'))}}</span>
          @endif
      </div>
      <div class="form-group">
        <label >Password Baru</label>
        <input name="new_password" type="password" class="form-control" id="new_password">
      </div>
     <div class="form-group">
          <label >Konfirmasi Password Baru</label>
          <input name="new_password" type="password" class="form-control" id="new_password">
           @if($errors->has('new_password'))
            <span class="help-block">{{($errors->first('new_password'))}}</span>
          @endif
        </div>
     <button type="submit" class="btn btn-primary">simpan</button>
     </div>
      </form>
  </div>
   </div>
</div>
</div>
@endsection
