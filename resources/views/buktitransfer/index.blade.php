@extends('layouts.dashboard')
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col col-lg-8 col-md-8 mb-2">
      <div class="card">
        <div class="card-header d-flex">
          {{-- {{$tf}} --}}
          <h3 class="card-title">Bukti Transfer </h3>
          <a href="{{ route('transaksi.index') }}" class="btn btn-sm btn-danger mx-4">Tutup</a>

        </div>
        <div class="card-body">
          @if (!$tf)

              <form action="{{ route('buktitransfer.store') }}" method="post" enctype="multipart/form-data" class="form-inline">
                  @csrf
                  <div class="form-group mb-2">
                      <label for="foto" class="sr-only">Upload Bukti Transfer</label>
                      <input type="file" name="foto" id="foto" class="form-control" required>
                  </div>
                  <div class="form-group mb-2">
                      <input type="hidden" name="no_invoice" value="{{ $itemorder->no_invoice }}">
                      <input type="hidden" name="user_id" value="{{ $itemuser->id }}">
                  </div>
                  <div class="form-group mb-2">
                      <button type="submit" class="btn btn-primary">Upload</button>
                  </div>
              </form>
          @else
              <div class="mb-3">
                  <h3>Gambar Bukti Transfer</h3>
                          <img src="{{ asset('storage/buktitransfers/' . $tf->foto) }}" alt="Bukti Transfer" class="img-fluid" width="500px">              
                </div>
          @endif

        </div>
        <div class="card-footer">
          {{-- <a href="{{ route('buktitransfer.index', [$itemorder->cart->no_invoice, $itemorder->cart->user_id]) }}" class="btn btn-sm btn-success">Bukti Transfer</a>
          <a href="{{ route('invoices', [$itemorder->cart->no_invoice, $itemorder->cart->user_id]) }}" class="btn btn-sm btn-primary">Lihat Invoice</a>
          <a href="{{ route('transaksi.index') }}" class="btn btn-sm btn-danger">Tutup</a> --}}
        </div>
      </div>
    </div>
    <div class="col col-lg-4 col-md-4">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data {{$itemorder->no_invoice}}</h3>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>
                    No
                  </th>
                  <th>
                    Kode
                  </th>
                  <th>
                    Nama
                  </th>
                  <th>
                    Harga
                  </th>
                  <th>
                    Diskon
                  </th>
                  <th>
                    Qty
                  </th>
                  <th>
                    Subtotal
                  </th>
                </tr>
              </thead>
              <tbody>
              @foreach($itemorder->detail as $detail)
                <tr>
                  <td>
                  {{ $loop->iteration }}
                  </td>
                  <td>
                  {{ $detail->produk->kode_produk }}
                  </td>
                  <td>
                  {{ $detail->produk->nama_produk }}
                  </td>
                  <td class="text-right">
                  {{ number_format($detail->harga, 2) }}
                  </td>
                  <td class="text-right">
                  {{ number_format($detail->diskon, 2) }}
                  </td>
                  <td class="text-right">
                  {{ $detail->qty }}
                  </td>
                  <td class="text-right">
                  {{ number_format($detail->subtotal, 2) }}
                  </td>
                </tr>
              @endforeach
                <tr>
                  <td colspan="6">
                    <b>Total</b>
                  </td>
                  <td class="text-right">
                    <b>
                    {{ number_format($itemorder->total, 2) }}
                    </b>
                  </td>
                </tr>
                {{-- <tr>
                  {{ $itemorder }}
                </tr> --}}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection