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
<link rel="stylesheet" type="text/css" href="{{asset('admin/css/zoom.css')}}">
<div id="myModal1" class="modal1">
  <span class="close">&times;</span>
  <img class="modal1-content" id="img01">
  <div id="caption"></div>
</div>
  <ol class="breadcrumb">
    <li><i class="fa fa-home"></i><a href="{{url('/dashboard')}}">&nbsp;Home&nbsp;</a></li>
    <li>&#47;&nbsp;<i class="fa fa-users"></i>&nbsp;Data Transaksi</li>
  </ol>
<div class="row">
</div>
<!-- Table -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="col-sm-12 col-md-6"> 
    <h6 class="m-0 font-weight-bold text-primary">data transaksi</h6>
    </div>
  </div>
  <div class="card-body" style="font-size: 15px;">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <div class="row">
    <form  method="get" action="{{url('/datatransaksi')}}" role="search">
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
              <th>Bukti Pembayaran</th>
              <th>Tanggal Pembayaran</th>
              <th>Status Pembayaran</th>
          </tr>
        </thead>   
              @foreach($transaksi as $pembayaran)               
        <tbody>
          <tr class="text-center">
             <th>{{$i++}}</th>
              <td>{{$pembayaran->kode_pembayaran}}</td>
              <td>{{$pembayaran->order_art->nomor_order}}</td> 
              <th><img id="myImg" src="{{$pembayaran->getbukti()}}"  alt="bukti transfer" style="width:100%;max-width:300px;" />
                   <a href="{{$pembayaran->getbukti()}}" style="width:50%;"><i class="fa fa-search-plus"></i></a>
              </th> 
              <td>{{$pembayaran->created_at}}</td>
               <td> 
                <div class='btn btn-danger btn-sm'>&nbsp;gagal</div>
              </td>
          
          </tr>
          </tbody>
          @endforeach
      </table>

    </div>
  </div>
</div>
<script type="text/javascript">
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