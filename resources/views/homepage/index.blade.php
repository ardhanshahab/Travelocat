@extends('layouts.template')
@section('content')
<div class="container" style="width: auto; height: auto;">
  
 <div class="row">
      <div class="col-md-12">
        <div class="p-5 mb-4 bg-body-tertiary rounded-3">
          <div class="container-fluid py-5">
            <div class="row">
              <div class="col-md-4">
                <img src="{{ asset('images/cimot.svg') }}" alt="eumot" style="height: 250px">
              </div>
              <div class="col-md-8">
                <h1 class="display-5 fw-bold">Travelocat</h1>
                <p class="col-md-8 fs-4">Selamat datang di website Travelocat.</p>
                <a class="btn btn-primary btn-lg" href="{{ URL::to('product') }}">Lihat Produk</a>
              </div>
            </div>
          </div>
        </div>
      </div>
 </div>
 <div class="col-md-12">
  <h5>Notifikasi</h5>
  <div class="card">
    <div class="card-body">
      <ul class="list-group">
        {{-- {{ $notifications }} --}}
        @forelse($notifications as $notification)
            <li class="list-group-item {{ $notification->read ? '' : 'font-weight-bold' }}">
                @if ($notification->tipe == '0')
                  {{ $notification->message }}
                      <a href="/pembayaran" class="btn btn-sm btn-secondary">Pembayaran</a>
                      <a href="{{ route('invoice',  $notification->message) }}" class="btn btn-sm btn-secondary">Lihat Invoice</a>

                @elseif ($notification->tipe == '1')
                {{ $notification->message }}
                <form action="{{ route('sampai.store', $notification->message) }}" method="POST" class="d-inline">
                  @csrf
                  <button type="submit" class="btn btn-sm btn-secondary">Konfirmasi Penerimaan</button>
                </form>
                @else
                {{ $notification->message }}
                @endif
                @if (!$notification->read)
                    <form action="{{ route('notifications.read', $notification->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-warning">Tandai telah dibaca</button>
                    </form>
                @endif
                
            </li>
        @empty
            <li class="list-group-item">Tidak ada notifikasi</li>
        @endforelse
      </ul>
    </div>
  </div>
</div>

  <!-- kategori -->
  <div class="card" style="padding: 20px; background-color: #A0DEFF; border:none;">
    <div class="bg-transparent">
      <h2 class="text-center" style="font-weight:bold; margin-bottom: 20px;">Kategori Produk</h2>
      <div class="btn-group d-flex flex-wrap shadow-none mt-1 ms-2">
        @foreach($itemkategori as $kategori)
        <a style="width: 150px; font-size: 13px; font-weight:bold; font-family: 'Poppins', sans-serif;" href="{{ URL::to('category/'.$kategori->slug_kategori) }}" class="btn mt-1 mx-2 rounded">
          {{ $kategori->nama_kategori }}
        </a>
        @endforeach
      </div>
    </div>
  </div>
  <!-- end kategori -->

  <!-- produk Promo-->

  <div class="row mt-4">
    <div class="col-12 mb-4">
      <h2 class="text-left" style="font-weight:bold;">Promo Hari Ini</h2>
    </div>
    @foreach($itempromo as $promo)
    <div class="col-md-4">
      <div class="card mb-4" style="box-shadow: 5px 6px 6px 2px #e9ecef;">
        <div style="height: 190px; max-width: 270px; display: flex; align-items: center; margin: auto;">
          <a href="{{ URL::to('product/'.$promo->produk->slug_produk) }}">
            <img src="{{ $promo->produk->foto ? asset('assets/produk/' . $promo->produk->foto) : asset('images/bag.jpg') }}" alt="{{ $promo->produk->nama_produk }}" class="card-img-top" style="max-height: 190px; width: 100%;">
          </a>
        </div>
        <div class="card-body" style="border:none; background-color: #5AB2FF;">
          <div class="row mt-4">
            <div class="col">
              <a class="text-decoration-none" style="color: black;">
                <p class="card-text h4">
                  <strong>{{ $promo->produk->nama_produk }}</strong>
                </p>
              </a>
            </div>
            <div class="col-auto">
              <p>
                <del>Rp. {{ number_format($promo->harga_awal, 2) }}</del><br />
                Rp. {{ number_format($promo->harga_akhir, 2) }}
              </p>
            </div>
          </div>
          <div class="row mt-4">
            <div class="col">
              <a class="btn" href="{{ URL::to('product/'.$promo->produk->slug_produk) }}">
                Detail
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>

  <!-- end produk promo -->

  <!-- produk Terbaru-->
  <div class="row mt-4">
    <div class="col-12 mb-4">
      <h2 class="text-left" style="font-weight:bold;">Produk</h2>
    </div>
    @foreach($itemproduk as $produk)
    <div class="col-md-4">
      <div class="card mb-4" style="box-shadow: 5px 6px 6px 2px #e9ecef; height: 400px;">
        <div style="height: 200px; max-width: 500px; display: flex; align-items: center; margin: auto;">
          <a href="{{ URL::to('product/'.$produk->slug_produk) }}">
            <img src="{{ $produk->foto ? asset('assets/produk/' . $produk->foto) : asset('images/bag.jpg') }}" alt="{{ $produk->nama_produk }}" class="card-img-top" style="max-height: 190px; width: 100%;">
          </a>
        </div>
        <div class="card-body" style="border:none; background-color: #5AB2FF;">
          <div class="row mt-4">
            <div class="col">
              <a class="text-decoration-none" style="color: black;">
                <p class="card-text h4">
                  <strong>{{ $produk->nama_produk }}</strong>
                </p>
              </a>
            </div>
            <div class="col-auto">
              <p>
                Rp. {{ number_format($produk->harga, 2) }}
              </p>
            </div>
          </div>
          <div class="row mt-4">
            <div class="col">
              <a class="btn" href="{{ URL::to('product/'.$produk->slug_produk) }}">
                Detail
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <!-- end produk terbaru -->
   <!-- carousel-->
   <h2>Testimonials</h2>
    <div id="myCarousel" class="carousel slide my-2" data-ride="carousel">
      <!-- Carousel indicators -->
      <ol class="carousel-indicators">
        @foreach($itemfeedback as $index => $feedback)
          <li data-target="#myCarousel" data-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
        @endforeach
      </ol>   

      <!-- Wrapper for carousel items -->
      <div class="carousel-inner">
        @foreach($itemfeedback as $index => $feedback)
          <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
            <div class="img-box"><img src="/examples/images/clients/1.jpg" alt=""></div>
            <p class="testimonial">{{ $feedback->komentar }}</p>
            <p class="overview">{{ $feedback->user->name }}</p>
          </div>       
        @endforeach
      </div>

      <!-- Carousel controls -->
      <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <i class="fa fa-angle-left"></i>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <i class="fa fa-angle-right"></i>
        <span class="sr-only">Next</span>
      </a>
    </div>

</div>
<style>
    .carousel {
    padding: 0 70px;
  }
  .carousel .carousel-item {
    color: #999;
    font-size: 14px;
    text-align: center;
    overflow: hidden;
    min-height: 290px;
  }
  .carousel .carousel-item .img-box {
    width: 135px;
    height: 135px;
    margin: 0 auto;
    padding: 5px;
    border: 1px solid #ddd;
    border-radius: 50%;
  }
  .carousel .img-box img {
    width: 100%;
    height: 100%;
    display: block;
    border-radius: 50%;
  }
  .carousel .testimonial {
    padding: 30px 0 10px;
  }
  .carousel .overview {	
    font-style: italic;
  }
  .carousel .overview b {
    text-transform: uppercase;
    color: #7AA641;
  }
  .carousel-control-prev, .carousel-control-next {
    width: 40px;
    height: 40px;
    margin-top: -20px;
    top: 50%;
    background: none;
  }
  .carousel-control-prev i, .carousel-control-next i {
    font-size: 68px;
    line-height: 42px;
    position: absolute;
    display: inline-block;
    color: rgba(0, 0, 0, 0.8);
    text-shadow: 0 3px 3px #e6e6e6, 0 0 0 #000;
  }
  .carousel-indicators {
    bottom: 0px;
  }
  .carousel-indicators li, .carousel-indicators li.active {
    width: 12px;
    height: 12px;
    margin: 1px 3px;
    border-radius: 50%;
    border: none;
  }
  .carousel-indicators li {	
    background: #999;
    border-color: transparent;
    box-shadow: inset 0 2px 1px rgba(0,0,0,0.2);
  }
  .carousel-indicators li.active {	
    background: #555;		
    box-shadow: inset 0 2px 1px rgba(0,0,0,0.2);
  }
</style>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection
