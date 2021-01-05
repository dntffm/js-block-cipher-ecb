@extends('admin.layouts.master')
@section('content')
<ol class="breadcrumb">
        <li><i class="fa fa-home"></i><a href="/dashboard">&nbsp;Home&nbsp;</a></li>
        <!-- <li>&#47;&nbsp;<i class="fa fa-users"></i>&nbsp;Data ART</li> -->
      </ol>
     <div class="container-fluid">

          <!-- 404 Error Text -->
          <div class="text-center">
            <div class="error mx-auto" data-text="404">404</div>
            <p class="lead text-gray-800 mb-5">Fitur belum tersedia</p>
            <p class="text-gray-500 mb-0">Tunggu di Sprint berikutnya</p>
            <a href="/dashboard">&larr; kembali ke Dashboard</a>
          </div>

        </div>
@endsection