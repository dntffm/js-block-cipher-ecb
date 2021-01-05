@extends('admin.layouts.master')
@section('content')
    <!-- <div class="col text-right"> -->
  <ol class="breadcrumb">
    <li><i class="fa fa-home"></i><a href="/dashboard">&nbsp;Home&nbsp;</a></li>
    <li>&#47;&nbsp;<i class="fa fa-users"></i>&nbsp;Data Master</li>
  </ol>
<div class="row">
</div>
<!-- Table -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="col-sm-12 col-md-6">
    <h6 class="m-0 font-weight-bold text-primary">Data Master</h6>
    </div>
  </div>
  <div class="card-body" style="font-size: 15px;">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <div class="row">
    <form  method="get" action="/datamaster" role="search">
    <div class="col-sm-12 col-md-4">
      <div id="dataTable_filter" class="dataTables_filter">
        <label>Search:<input name="cari" type="text" class="form-control form-control-sm" placeholder="" aria-describedby="basic-addon2"></label>
        <button class="btn btn-outline-info" type="submit" style="height: 2rem" >
          <i class="fas fa-search fa-sm"></i>
        </button>
      </div>
    </div>
    </form>
  </div>
          <thead style="background-color: #ddd;">
          <tr class="text-center">
              <th>Foto</th>
              <th>Nama</th>
              <th>username</th>
              <th>email</th>
              <th>No HP</th>
              <th>Kecamatan</th>
              <th>Alamat</th>
              <th>Kode Pos</th>
          </tr>
        </thead>
              @foreach($data_master as $master)
        <tbody>
          <tr class="text-center">
              <td><img src="{{$master->getPhoto()}}" style="width: 50px"></td>
              <td><a href="{{url('/master/profile/'.$master->id)}}">{{$master->name}}</a></td>
              <td>{{$master->user->username}}</td>
              <td>{{$master->user->email}}</td>
              <td>{{$master->nohp}}</td>
              <td>{{$master->kecamatan}}</td>
              <td>{{$master->alamat}}</td>
              <td>{{$master->kodepos}}</td>
          </tr>
          </tbody>
          @endforeach
      </table>
      {{$data_master->links()}}
    </div>
  </div>
</div>
@endsection