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
              <li>&#47;&nbsp;<i class="fa fa-user"></i>&nbsp;Profile</li>
            </ol>
           <div class="card shadow text-primary border-left-primary">
            <div class="card-header text-center"><h2><i class="fa fa-user">&nbsp;PROFIL ADMIN</i></h2></div><br>
               <div class="row col-12 card-text">
                <div class="col-xl-3 sm-2 md-2 text-center ">
                  <div class="img" style="text-align: center;">
                    <img class="img-profile" src="https://source.unsplash.com/QAB-WJcbgJk/60x60" alt="foto" style="width: 100px;  margin-bottom: 15px;">
                  </div>
                  <h6>{{auth()->user()->role}}</h6>
                  <div style=" margin-bottom: 10px">
                    <a href="/dataku/edit/{{auth()->user()->id}}" class="btn btn-danger">Edit</a>
                  </div>
                </div>
                <div class="col-xl-7 sm-4 md-4 text-info">
                  <p style="margin-top: 5px; margin-bottom: 1rem;" class="text-justify">Email: {{auth()->user()->email}}</p>
                  <p>username: @<span></span>{{auth()->user()->username}}</p>
                  <h6>
                   <span><i class="icon_clock_alt"></i>Akun Dibuat: {{auth()->user()->created_at}}</span>
                   </h6>
                </div>
                </div>
                </div>
              </div>
            </div>
@endsection
