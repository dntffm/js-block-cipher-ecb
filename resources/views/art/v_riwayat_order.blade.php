@extends('art.layouts.master')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/tab/templatemo-style.css')}}">
<!-- Intro Section -->
<section class="inner-intro bg-img light-color overlay-before parallax-background">
  <div class="container">
    <div class="row title">
      <div class="title_row">
        <h1 data-title="Service"><span>Riwayat Orderan Saya</span></h1>
        <div class="page-breadcrumb">
          <a href="{{url('/home')}}">Home</a>/ <span>Riwayat Orderan Saya</span>
        </div>

      </div>

    </div>
  </div>
</section>
@section('content')
@if(session('success'))
        <div class="alert alert-success" role="alert">
         {{session('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
       @endif
<div id="mission-section" class="ptb ptb-xs-180">
      <div class="container">
        <div class="row">
          <div class="col-md-45 col-lg-12 border text-center">
            <div class="about-block clearfix">
             
                <!-- Nav tabs -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="pesanan-tab" data-toggle="tab" href="#pesanan" role="tab" aria-controls="pesanan" aria-selected="false">Riwayat Order</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
   @if (isset($data_order) && count($data_order) > 0)
  <div class="tab-pane active" id="pesanan" role="tabpanel" aria-labelledby="pesanan-tab">
    <br>
      <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
          <thead class="dark-bg">
          <tr>
             <th>Nomor Order</th>
              <th>Nama Master</th>
              <th>Nama Paket</th>
              <th>Waktu Kerja</th>
              <th>Status</th>
          </tr>
        </thead>
              @foreach($data_order as $order)
        <tbody>
          <tr>
            <td>{{$order->nomor_order}}</td>
            <td>{{$order->nama_master}}</td>
              <td>{{$order->paket}}</td>
              <td>{{\Carbon\Carbon::parse($order->waktu_kerja)->format('H:i d-m-Y')}}</td>
              <td><button class='btn btn-success btn-sm'><i class="fa fa-check fa-fw" aria-hidden="true"></i>Selesai</button></td>
          </tr>
          </tbody>
          @endforeach
      </table>
  </div>
  @else()
  <div class="tab-pane" id="pesanan" role="tabpanel" aria-labelledby="pesanan-tab">belum ada data</div>
</div>
@endif
        </div>
       </div>
       </div>
        </div>
       </div>
      <script type="text/javascript">
      $('#myTab a').on('click', function (e) {
      e.preventDefault()
      $(this).tab('show')
      })
      </script>

@endsection