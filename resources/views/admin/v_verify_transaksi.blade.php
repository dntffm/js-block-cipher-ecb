@extends('admin.layouts.master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('admin/css/zoom.css')}}">
<div id="myModal1" class="modal1">
  <span class="close">&times;</span>
  <img class="modal1-content" id="img01">
  <div id="caption"></div>
</div>
  <ol class="breadcrumb">
    <li><i class="fa fa-home"></i><a href="{{url('/dashboard')}}">&nbsp;Home&nbsp;</a></li>
    <li>&#47;&nbsp;<i class="fa fa-users"></i>&nbsp;Verify Data Transaksi</li>
  </ol>
<div class="row">
</div>
<!-- Table -->
@if(session('gagal'))
<!-- Modal -->
<div class="alert alert-warning " role="alert">
  {{session('gagal')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="col-sm-12 col-md-6"> 
    <h6 class="m-0 font-weight-bold text-primary">verify transaksi</h6>
    </div>
  </div>
  <div class="card-body" style="font-size: 15px;">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <div class="row">
    <form  method="get" action="{{url('/verifytransaski')}}" role="search">
    <div class="col-sm-12 col-md-4">
      <div id="dataTable_filter" class="dataTables_filter">
        <label>Search:<input name="cari" type="text" class="form-control form-control-sm" placeholder="cari nomor pembayaran" aria-describedby="basic-addon2" ></label>
        <button class="btn btn-outline-info" type="submit" style="height: 2rem" >
          <i class="fas fa-search fa-sm"></i>
        </button>
      </div>
    </div>
    </form>
  </div>
          <?php $i = 1 ?>
          <thead style="background-color: #ddd;">
          <tr class="text-center">
             <th>Nomor</th>
              <th>nomor pembayaran</th>
              <th>nomor order</th>
              <th>Total Tagihan</th>
              <th>Bukti Pembayaran</th>
              <th>Status Pembayaran</th>
              <th>Tanggal Pembayaran</th>
              <th>tindakan</th>
          </tr>
        </thead>   
              @foreach($transaksi as $pembayaran)               
        <tbody>
          <tr class="text-center">
             <th>{{$i++}}</th>
              <td>{{$pembayaran->kode_pembayaran}}</td>
              <td>{{$pembayaran->order_art->nomor_order}}</td>
              <td>Rp {{$pembayaran->order_art->total}}</td>
              <td><img id="myImg" src="{{$pembayaran->getbukti()}}" alt="bukti transfer" style="width:100%;max-width:300px" />
                <a href="{{$pembayaran->getbukti()}}" style="width:50%;"><i class="fa fa-search-plus"></i></a>
              </td>
              <td>{{$pembayaran->statuspembayaran->statuspembayaran}}</td>
              <td>{{$pembayaran->created_at}}</td>
              
               <td>
                <button class='btn btn-primary' data-toggle="modal" data-target="#verifikasi"></i>verifikasi</button><br>

                  <div class="modal fade" id="verifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Peringatan !!</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" style="color: #f00;transform: translate(25px, -10px);">×</span>
            </button>
          </div>
          <div class="modal-body">“Apakah anda yakin untuk memverifikasi pembayaran order ini”</div>
          <div class="modal-footer">
                 <form action="{{url('/ditolak/'.$pembayaran->id)}}" method="post">
                  {{csrf_field()}}
                   <input type="number" name="id_statuspembayaran" value="4" readonly="" hidden="">            
                  
                <button class='btn btn-danger'></i>Tolak&nbsp;</button></form>
                <!-- <a class="btn btn-danger" href="{{url('/tolak_verif/'.$pembayaran->order_art->id)}}">Tolak</a> -->
           <form action="{{url('/konfirmasi/'.$pembayaran->id)}}" method="post">
                  {{csrf_field()}}
                  <input type="number" name="statuspembayaran" value="2" readonly="" hidden="">
                <button class='btn btn-primary' data-toggle="modal" data-target="#verifikasi"></i>Terima</button></form>
          </div>
        </div>
      </div>
    </div>
              </td>
          
          </tr>
          </tbody>
          @endforeach
      </table>

    </div>
  </div>
</div>

<script>
// Get the modal
var modal1 = document.getElementById("myModal1");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modal1Img = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal1.style.display = "block";
  modal1Img.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal1.style.display = "none";
}
</script>
@stop