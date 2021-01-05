@extends('art.layouts.master')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/tab/templatemo-style.css')}}">
<!-- Intro Section -->
<section class="inner-intro bg-img light-color overlay-before parallax-background">
  <div class="container">
    <div class="row title">
      <div class="title_row">
        <h1 data-title="Service"><span>Orderan Saya</span></h1>
        <div class="page-breadcrumb">
          <a href="{{url('/home')}}">Home</a>/ <span>Orderan Saya</span>
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
       @if(session('gagal'))
        <div class="alert alert-warning" role="alert">
         {{session('gagal')}}
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
    <a class="nav-link active" id="pesanan-tab" data-toggle="tab" href="#pesanan" role="tab" aria-controls="pesanan" aria-selected="false">Tawaran Pekerjaan</a>
  </li>
  <!-- <li class="nav-item" role="presentation">
    <a class="nav-link" id="Pekerjaan-tab" data-toggle="tab" href="#Pekerjaan" role="tab" aria-controls="Pekerjaan" aria-selected="false">Pekerjaan Aktif</a>
  </li> -->
</ul>

<!-- Tab panes -->
<div class="tab-content">
   @if (isset($data_order) && count($data_order) > 0)
  <div class="tab-pane active" id="pesanan" role="tabpanel" aria-labelledby="pesanan-tab">
    <br>
      <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
          <thead class="dark-bg">
          <tr>
             <th>Nama master</th>
              <th>Nama Paket</th>
              <th>Total</th>
              <th>Status Penerimaan</th>
          </tr>
        </thead>
              @foreach($data_order as $order)
        <tbody>
          <tr>
            <td>{{$order->nama_master}}</td>
              <td>{{$order->paket}}</td>
              <td>Rp {{$order->harga}}</td>
              @if($order->sp == 3)
              <td> 
                <button class='btn btn-success btn-sm' data-toggle="modal" data-target="#verif"><i class="fa fa-check fa-fw" aria-hidden="true"></i>Terima&nbsp;</button></form><br><br>
                <!-- openmodal -->
                <div class="modal fade" id="verif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Peringatan !!</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">“Apakah anda yakin ingin menerima order ini?”</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">tidak</button>
            <form action="{{url('/terima/'.$order->id)}}" method="post">
                  {{csrf_field()}}
                  <input type="number" name="id_status_penerimaan" value="1" readonly="" hidden="">
                  <input type="text" name="status_kerja" value="2" readonly="" hidden="">
                  <input name="day_start" value="{{$order->tanggal_dibuat}}" hidden="">
                  <input name="day_over" value="{{$order->due_date}}" hidden="">
                  <input name="id_statuspembayaran" value="0" readonly="" hidden="">
                  <input name="id_order" value="{{$order->id}}" readonly="" hidden="">
            <button class="btn btn-primary" type="submit">Ya</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- end modal --> 
                <form action="{{url('/tolak/'.$order->id)}}" method="post">
                   <input type="number" name="id_status_penerimaan" value="2" readonly="" hidden="">
                  <input type="text" name="status_kerja" value="1" readonly="" hidden="">

                  {{csrf_field()}}
                  <input type="number" name="sp" value="2" readonly="" hidden="">
                <button class='btn btn-danger btn-sm'><i class="fa fa-close fa-fw" aria-hidden="true"></i>Tolak&nbsp;</button></form>
              </td>
              @elseif($order->sp == 1)
              <td> 
                <a class='btn btn-success btn-sm'><i class="fa fa-check fa-fw" aria-hidden="true"></i>Telah diterima&nbsp;</a></<
              </td>
              @else()
               <td> 
               
                <a class='btn btn-danger btn-sm'><i class="fa fa-close fa-fw" aria-hidden="true"></i>telah ditolak&nbsp;</button>
              </td>
              @endif
          </tr>
          </tbody>
          @endforeach
      </table>

  </div>
  @else
  <div class="tab-pane active" id="pesanan" role="tabpanel" aria-labelledby="pesanan-tab">belum ada tawaran dalam 24 jam terakhir</div>
  @endif
</div>
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