<style type="text/css">
  .border{
    border-color: #ebebeb;
    border-style: solid;
    border-width: 0 1px 1px;
  }
  .dark-bg{
      background: rgb(127, 213, 248);
      }
</style>
<br><br><br>
@extends('art.layouts.master')
@section('content')
<!-- Modal -->
   

  <!-- Content -->
  <div id="mission-section" class="ptb ptb-xs-180">
      <div class="container">
         @if(session('message'))
          <div class="alert alert-success" role="alert">
          {{session('message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
      @endif
      @if(session('success'))
        <div class="alert alert-success" role="alert">
         {{session('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
      @endif
  <!-- End Modal -->
  <div class="row">
          <div class="col-md-12 col-lg-12 dark-bg our-vision light-color" style="background: rgb(50, 179, 232);">
            <div class="block-title v-line mb-35" style="border-color: #0F8CBF">
              <h2 class="row d-flex align-items-center">
                <span class="col-md-10">@<span></span>{{auth()->user()->username}}<span></span>'s Profile</span> 
                <a class="col-md-2" href="/profilku/setting/{{auth()->user()->id}}" style="font-size: 20px;"><i class="fa fa-cog mr4"></i>&nbsp;Edit Profile</a></h2>
              <p class="ml-15" style="text-decoration: underline;" data-color="mid">
               {{auth()->user()->role}}
              </p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 col-lg-12 border">
            <div class="about-block clearfix">
              <div class="fl width-25per box-shadow mt-15 mb-xs-15">
                <img class="img-responsive" src="{{auth()->user()->arts->getPhoto()}}" alt="Photo">
              </div>
              <div class="text-box pt-15 pb-0 pl-70 pl-xs-0 width-75per fl">
                <div class="box-title">
                   @if ( count($review) > 0)
                  <div class="star-rating">
                    <span>Rating: </span>
                    @for ($i = 0; $i < $count->nilai; $i++)     
                    <i class="fa fa-star"></i>
                    @endfor
                  </div>  
                  @else
                  <div class="star-rating">
                    <span>belum ada rating</span>
                  </div>  
                  @endif
                </div>
                  <h3>{{auth()->user()->arts->name}}</h3>
                   <div class="product-rating pull-right">
                  
                </div>
               
                <div class="text-content">
                  <h5><i class="fa fa-user"></i>&nbsp;Status: <span></span>{{auth()->user()->arts->status}}</h5>
                  <p><i class="fa fa-envelope"></i>&nbsp;Email: <span></span>{{auth()->user()->email}}</p>
                   <p><i class="fa fa-phone"></i>&nbsp;No HP: <span></span>{{auth()->user()->arts->nohp}}</p>
                   <hr>
                </div>
              </div>
              <div class="text-box pt-0 pb-15 pl-70 pl-xs-0 width-75per fl">
                <div class="box-title">
                <h3><i class="fa fa-map-marker"></i>&nbsp;ALAMAT : </h3>
                </div>
                <div class="text-content">
                  <p>Kode Pos: <span></span>
                    @if(auth()->user()->arts->kodepos == null)
                     ——
                    @else()
                   {{auth()->user()->arts->kodepos}}
                    @endif
                  </p>
                   <p>Kecamatan: <span></span>
                    @if(auth()->user()->arts->kecamatan == null)
                     ——
                    @else()
                   {{auth()->user()->arts->kecamatan}}
                    @endif
                  </p>
                   <p>Alamat: <span></span>
                    @if(auth()->user()->arts->alamat == null)
                     ——
                    @else()
                   {{auth()->user()->arts->alamat}}
                    @endif</p>
                </div>
              </div>
            </div>
          </div>
          <p>Bergabung: {{auth()->user()->created_at}}</p>
        </div>
        <div class="row ">
          <div class="col-md-12 col-lg-12 border xs-9">
            <h4 class="row d-flex align-items-center">
                <span class="col-md-10">Deskripsi</span> 
                 <button class="ButtonElement ng-star-inserted ml-65" type="button" data-color="secondary" data-display="inline" data-toggle="modal" data-target="#exampleModal"> Tambah Deskripsi </button></h4>
              <hr>
            <div _ngcontent-webapp-c34="" role="paragraph" class="NativeElement ng-star-inserted pb-60" data-color="dark" data-size="small" data-weight="normal" data-style="italic" data-line-break="false">
              <p>
                  @if(auth()->user()->arts->deskripsi == null)
                  tidak ada deskripsi informasi 
                  @else()
                 {{auth()->user()->arts->deskripsi}}
                  @endif
                </p>
            </div>

      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">Deskripsi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
         </div>
        <div class="modal-body">
        <form action="/profilku/deskripsi/{{auth()->user()->id}}" method="POST" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="form-group">
          <label for="formGroupExampleInput2" value="{{old('deskripsi')}}">Tambah Deskripsi</label>
          <textarea class="form-control" id="deskripsi" rows="3" name="deskripsi" >{{auth()->user()->arts->deskripsi}}</textarea>
        </div>
      <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">SIMPAN</button>
            </div>
          </form>
             </div>
          </div>
        </div>
         </div>
          </div>
        </div>
        <h5 ><a href="{{url('/riwayatorder')}}" style="color: #75c3e8">Lihat Riwayat Orderan</a></h5>
        <div class="row top-pad-50">
              <div class="col-md-12">
                <div role="tabpanel">
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="nav-item">
                      <a href="#messages" class="nav-link active" aria-controls="messages" class="nav-link" role="tab" data-toggle="tab">Review</a>
                    </li>
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                      <div class="item" style="background-color: #538e32;"><br/><hr/>
                         @if (isset($review) && count($review) > 0)
                        @foreach($review as $rev)
                        
                        <div class="post-meta" style="background-color:#e6e1e1;padding: 5px;margin: 15px;">
                          <!-- Author  -->
                          <span class="author"> <i class="fa fa-user"></i>&nbsp;{{$rev->username}}</span>
                          <!-- Meta Date -->

                          <span class="time" style="font-size: 10px"> <i class="fa fa-calendar"></i>&nbsp;{{$rev->buat}}</span>
                          <!-- Category -->

                          <div class="star-rating pull-right">
                            <span class="pull-right"> 
                            @for ($i = 0; $i < $rev->rating; $i++)
                            @if ($i < $rev->rating)
                            <span class="fa fa-star"></span>
                            @else
                            <span class="fa fa-star"></span>
                            @endif
                            @endfor</span>
                          </div>
                          <h5>
                          {{$rev->review}}
                          </h5>
                        </div>
                      
                      <hr />
                      @endforeach
                      @else()
                      <div class="post-meta" style="background-color:#e6e1e1;padding: 5px;margin: 15px;"><p>Belum ada Review</p></div><hr/>
                      @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <hr />
      </div>

    </div>
@endsection