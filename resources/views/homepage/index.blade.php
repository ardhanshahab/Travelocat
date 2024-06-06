@extends('layouts.template')
@section('content')
<div class="container" style="width: auto; height: auto;">
 
  <!-- kategori -->
  <div class="card" style="padding: 20px; background-color: #5755FE; border:none;">
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
            <img src="{{ $promo->produk->foto ? \Storage::url($promo->produk->foto) : asset('images/bag.jpg') }}" alt="{{ $promo->produk->nama_produk }}" class="card-img-top" style="max-height: 190px; width: 100%;">
          </a>
        </div>
        <div class="card-body" style="border:none; background-color: #FF71CD;">
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
        <div class="card-body" style="border:none; background-color: #FF71CD;">
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
       <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
       <li data-target="#myCarousel" data-slide-to="1"></li>
       <li data-target="#myCarousel" data-slide-to="2"></li>
     </ol>   
     <!-- Wrapper for carousel items -->
     <div class="carousel-inner">
       <div class="carousel-item active">
         <div class="img-box"><img src="/examples/images/clients/1.jpg" alt=""></div>
         <p class="testimonial">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante. Idac bibendum scelerisque non non purus. Suspendisse varius nibh non aliquet.</p>
         <p class="overview"><b>Paula Wilson</b>, Media Analyst</p>
       </div>
       <div class="carousel-item">
         <div class="img-box"><img src="/examples/images/clients/2.jpg" alt=""></div>
         <p class="testimonial">Vestibulum quis quam ut magna consequat faucibus. Pellentesque eget nisi a mi suscipit tincidunt. Utmtc tempus dictum risus. Pellentesque viverra sagittis quam at mattis. Suspendisse potenti. Aliquam sit amet gravida nibh, facilisis gravida odio.</p>
         <p class="overview"><b>Antonio Moreno</b>, Web Developer</p>
       </div>
       <div class="carousel-item">
         <div class="img-box"><img src="/examples/images/clients/3.jpg" alt=""></div>
         <p class="testimonial">Phasellus vitae suscipit justo. Mauris pharetra feugiat ante id lacinia. Etiam faucibus mauris id tempor egestas. Duis luctus turpis at accumsan tincidunt. Phasellus risus risus, volutpat vel tellus ac, tincidunt fringilla massa. Etiam hendrerit dolor eget rutrum.</p>
         <p class="overview"><b>Michael Holz</b>, Seo Analyst</p>
       </div>
     </div>
     <!-- Carousel controls -->
     <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
       <i class="fa fa-angle-left"></i>
     </a>
     <a class="carousel-control-next" href="#myCarousel" data-slide="next">
       <i class="fa fa-angle-right"></i>
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
