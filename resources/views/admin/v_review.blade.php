@extends('admin.layouts.master')
@section('content')
@if(session('success'))
<!-- Modal -->
<div class="alert alert-success" role="alert">
  {{session('success')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
@if(session('gagal'))
<!-- Modal -->
<div class="alert alert-warning" role="alert">
  {{session('gagal')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
  <ol class="breadcrumb">
    <li><i class="fa fa-home"></i><a href="{{url('/dashboard')}}">&nbsp;Home&nbsp;</a></li>
    <li>&#47;&nbsp;<i class="fa fa-users"></i>&nbsp;Data Review ART</li>
  </ol>
<div class="row">
</div>
<!-- Table -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="col-sm-12 col-md-6"> 
    <h6 class="m-0 font-weight-bold text-primary">Data Review ART</h6>
    </div>
  </div>
  <div class="card-body" style="font-size: 15px;">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <div class="row">
    
  </div>
         
          <thead style="background-color: #ddd;">
          <tr class="text-center">    
              <th>Nama Art</th>
              <th>Nama Master</th>
              <th>Nomor Order</th>
              
              <th>Rating</th>
              <th>Review</th>
              <th>Tanggal Dibuat</th>
          </tr>
        </thead>
             
              @foreach($review as $rev)               
        <tbody>
          <tr class="text-center">
              <td>{{$rev->order->art->name}}<span style="font-weight: bold;">&nbsp;(<a href="{{url('/art/profile/'.$rev->order->art->id)}}">{{$rev->order->art->user->username}}</a>)</span></td>
              <td>{{$rev->order->masters->name}}<span style="font-weight: bold;">&nbsp;(<a href="{{url('/master/profile/'.$rev->order->masters->id)}}">{{$rev->order->masters->user->username}}</a>)</span></td>
              <td>{{$rev->order->nomor_order}}</td>
              <td>{{$rev->rating}}</td>
              <td>{{$rev->review}}</td>
              <td>{{\Carbon\Carbon::parse($rev->updated_at)->format('d-m-Y H:i')}}</td>
              
          </tr>
          </tbody>
          @endforeach
      </table>

    </div>
  </div>
</div>
@stop