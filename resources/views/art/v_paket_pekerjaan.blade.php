@extends('art.layouts.master')
@section('content')
<!-- Intro Section -->
<section class="inner-intro bg-img light-color overlay-before parallax-background">
  <div class="container">
    <div class="row title">
      <div class="title_row">
        <h1 data-title="Service"><span>Paket pekerjaan</span></h1>
        <div class="page-breadcrumb">
          <a href="/index">Home</a>/ <span>Paket Pekerjaan</span>
        </div>

      </div>

    </div>
  </div>
</section>
<!-- Intro Section -->
<!-- Service Section -->
<section class="padding ptb-xs-40">
  <div class="container">
    <div class="row pb-30 text-center">
      <div class="col-md-12">
        <div class="section-title_home">
          <h2>Paket Pekerjaan <span>Kami</span></h2>
        </div>
      </div>
    </div>

    <div class="row">
      @foreach($paket as $peka)
      <div class="col-md-6 col-lg-4 mb-30" style="padding:30px;">
        <div class="service_box" style="border: 1px solid #dedede;text-align:center;">
          <figure>
            <a href="#"><img src="{{asset('assets/images/service/img_1.jpg')}}" alt="" /></a>
          </figure>
          <div class="product-details">
            <h3 class="text-center"><a href="#">{{$peka->nama_paket}}</a></h3>
            <h4 class="text-color text-center">Rp {{$peka->harga_paket}}</h4>
            <p>
              {{$peka->deskripsi_paket}}
            </p>
            <div class="add-to-cart mb-20" >
              <a href="{{url('/paket_pekerjaan/'.$peka->id)}}" style="border: 3px solid #6e8900;"><i class="fa fa-eye"></i>&nbsp;Lihat Paket</a>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    {{$paket->links()}}
  </div>
</section>
@endsection
