@extends('layouts.template')
@section('content')
<div class="container d-flex flex-column justify-content-center align-items-center" style="height:100vh;">
  <div class="row">
    <div class="d-flex flex-column align-items-center">
      <h2>Pembayaran</h2>
      <br>
      <div class="col-md-12 d-flex flex-column align-items-center">
        <h5>Transfer via Shopeepay</h5>
        <img src="{{ asset('images/qris.jpeg') }}" alt="QRIS" width="300px">
        <h5 class="my-4">Transfer via Bank</h5>
        <p>Mandiri :</p>
        <p>Seabank :</p>
        <p>Jika sudah membayar, harap whatsapp admin dan sebutkan no invoice nya terimakasih!</p>
      </div>
    </div>
  </div>
</div>

@endsection
