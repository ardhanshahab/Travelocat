@extends('layouts.template')
@section('content')
<div class="container" style="margin-top:70px;">
  <div class="row mt-4">
    <div class="col col-lg-8 col-md-8">
      @foreach($itemproduk->images as $index => $image)
      @if($index == 0)
        <img src="{{ \Storage::url($image->foto) }}" class="d-block w-100" alt="..." style="max-height: 750px; width: 100%; box-shadow: 5px 6px 6px 2px #e9ecef;">
      @else
        <img src="{{ asset('images/KOJO 1.png') }}" class="d-block w-100" alt="..." style="max-height: 750px; width: 100%;">
      @endif
      @endforeach
    </div>

<!-- Product -->
    <div class="col col-lg-4 col-md-4">
      <div class="row">
        <div class="col">
          <div class="card" style="border:none; background-color: #5755FE; box-shadow: 5px 6px 6px 2px #e9ecef;">
            <div class="card-body card-yellow">
              @if(count($errors) > 0)
              @foreach($errors->all() as $error)
                <div class="alert alert-warning">{{ $error }}</div>
              @endforeach
              @endif
              @if ($message = Session::get('error'))
                <div class="alert alert-warning">
                  <p>{{ $message }}</p>
                </div>
              @endif
              @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
              @endif
              <span class="small">{{ $itemproduk->kategori->nama_kategori }}</span>
              <div class="row">
              <div class="col">
              <h4 class="font-weight-bold">{{ $itemproduk->nama_produk }}</h4>
              </div>
              <!-- cek apakah ada promo -->
              <div class="col">
              @if($itemproduk->promo != null)
              <p>
                Rp. <del>{{ number_format($itemproduk->promo->harga_awal, 2) }}</del>
                <br />
                Rp. {{ number_format($itemproduk->promo->harga_akhir, 2) }}
              </p>
              @else
              <p>
                Rp. {{ number_format($itemproduk->harga, 2) }}
              </p>
              @endif
              </div>
              </div>
              <div class="row mt-4">
              <div class="col">
              <form action="{{ route('wishlist.store') }}" method="post">
                @csrf
                <input type="hidden" name="produk_id" value={{ $itemproduk->id }}>
                <button type="submit" class="btn btn-sm">
                @if(isset($itemwishlist) && $itemwishlist)
                  <i class="fas fa-heart"></i> Add to Wishlist
                @else
                  <i class="far fa-heart"></i> Add to Wishlist
                @endif
                </button>
              </form>
              </div>
              <div class="col" style="margin-top: -5px">
              <form action="{{ route('cartdetail.store') }}" method="POST">
                @csrf
                <input type="hidden" name="produk_id" value={{$itemproduk->id}}>
                <button class="btn btn-sm" type="submit" style="margin-top:5px;">
                  <i class="fa fa-shopping-cart"></i> Add to Cart
                  </button>
              </form>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
<!-- Description -->
      <div class="row mt-4">
        <div class="col">
          <div class="card" style="border-color:#5755FE; box-shadow: 5px 6px 6px 2px #e9ecef;">
            <div class="card-header" style="border:none; background-color: #5755FE;">
              <h5>Description</h5>
            </div>
            <div class="card-body">
              {{ $itemproduk->deskripsi_produk }}
            </div>
          </div>
        </div>
      </div>


<!-- Comment -->
      <div class="row mt-4">
        <div class="col">
          <div class="card" style="border-color:#5755FE; box-shadow: 5px 6px 6px 2px #e9ecef;">
            <div class="card-header" style="border:none; background-color: #5755FE;">
              <h5>Add Review</h5>
            </div>
            <div class="card-body">
              <form method="post" action="{{ route('comments.store') }}">
              @csrf
              <div class="form-group">
                <div class="rating" style="margin-left: 5px">
                  <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
                  <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> 
                  <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
                  <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
                  <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                  <img src="{{ asset('img/user1-128x128.jpg') }}" style="max-height: 40px;max-width: 40px;" class="user-img rounded-circle mr-2">
                </div>
              </div>
                <div class="form-group">
                  <textarea class="form-control" name="body"></textarea>
                  <input type="hidden" name="produk_id" value="{{ $itemproduk->id }}" />
                </div>
                <div class="form-group">
                    <input type="submit" class="btn-sm btn-outline-info py-0" style="font-size: 0.8em;" value="Submit" />
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- DisplayComment -->
  <div class="row mt-4">
    <div class="col">
      <div class="card" style="border-color:#5755FE; box-shadow: 5px 6px 6px 2px #e9ecef;">
        <div class="card-header" style="border:none; background-color: #5755FE;">
          <h5>Display Comment</h5>
        </div>
        <div class="card-body">
        @include('homepage.commentsDisplay', ['comments' => $itemproduk->comments, 'produk_id' => $itemproduk->id])
        </div>
      </div>
    </div>
  </div>
</div>
@endsection