<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" /> --}}
    <link rel="icon" href="{{ asset('images/logo.svg') }}" type="image/icon type">
    <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
</head>
<body>   
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="invoice-title">
                                <h4 class="float-end font-size-15"> {{ $data->no_invoice }}
                                    @if ($data->status_pembayaran == 'sudah')
                                        <span class="badge bg-success font-size-12 ms-2">Paid</span>
                                    @else
                                        <span class="badge bg-danger font-size-12 ms-2">Unpaid</span>
                                    @endif
                                </h4>
                                <div class="mb-4">
                                <h2 class="mb-1 text-muted">Travelocat</h2>
                                </div>
                                <div class="text-muted">
                                    <p class="mb-1">Bandung</p>
                                    <p class="mb-1"><i class="uil uil-envelope-alt me-1"></i> sales@travelocat.com</p>
                                    <p><i class="uil uil-phone me-1"></i> +628 9537 1984510</p>
                                </div>
                            </div>
        
                            <hr class="my-4">
        
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="text-muted">
                                        <h5 class="font-size-16 mb-3">Pesanan Untuk:</h5>
                                        <h5 class="font-size-15 mb-2">{{ $itemuser->name }}</h5>
                                        <p class="mb-1">{{ $alamat->alamat }}</p>
                                        <p class="mb-1">{{ $itemuser->email }}</p>
                                        <p>{{ $itemuser->phone }}</p>
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-sm-6">
                                    <div class="text-muted text-sm-end">
                                        <div>
                                            <h5 class="font-size-15 mb-1">No INV:</h5>
                                            <p>{{ $data->no_invoice }}</p>
                                        </div>
                                        <div class="mt-4">
                                            <h5 class="font-size-15 mb-1">Tanggal INV:</h5>
                                            <p>{{ $data->created_at }}</p>
                                        </div>
                                        <div class="mt-4">
                                            <h5 class="font-size-15 mb-1">No Order:</h5>
                                            <p>#{{ $data->id }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                            
                            <div class="py-2">
                                <h5 class="font-size-15">Order</h5>
        
                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap table-centered mb-0">
                                        <thead>
                                            <tr>
                                                <th style="width: 70px;">No.</th>
                                                <th>Item</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Discount</th>
                                                <th class="text-end" style="width: 120px;">Total</th>
                                            </tr>
                                        </thead><!-- end thead -->
                                        <tbody>
                                            @foreach ($data->detail as $p)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>
                                                    <div>
                                                        <h5 class="text-truncate font-size-14 mb-1">{{ $p->produk->nama_produk }}</h5>
                                                        {{-- <p class="text-muted mb-0">{{ $p->produk->harga }}</p> --}}
                                                    </div>
                                                </td>
                                                <td>Rp. {{ $p->harga }}</td>
                                                <td>{{ $p->qty }}</td>
                                                <td>Rp. {{ $p->diskon }}</td>
                                                <td class="text-end">Rp. {{ $p->subtotal }}</td>
                                            </tr>
                                            @endforeach
                                            
                                            <tr>
                                                <th scope="row" colspan="4" class="text-end">Sub Total</th>
                                                <td class="text-end"></td>
                                                <td class="text-end">Rp. {{ $data->total }}</td>
                                            </tr>
                                            <!-- end tr -->
                                            <tr>
                                                <th scope="row" colspan="4" class="border-0 text-end">
                                                    Shipping Charge :</th>
                                                <td class="text-end"></td>

                                                <td class="border-0 text-end">Rp. {{ $data->ongkir }}</td>
                                            </tr>
                                            <!-- end tr -->
                                            <tr>
                                                <th scope="row" colspan="4" class="border-0 text-end">Total</th>
                                                <td class="text-end"></td>
                                                @php
                                                    $total = $data->total + $data->ongkir;
                                                @endphp
                                                <td class="border-0 text-end">Rp. <h5 class="m-0 fw-semibold">{{ $total }}</h5></td>
                                            </tr>
                                            <!-- end tr -->
                                        </tbody><!-- end tbody -->
                                    </table><!-- end table -->
                                </div><!-- end table responsive -->
                                <div class="d-print-none mt-4">
                                    <div class="float-end">
                                        <a href="javascript:window.print()" class="btn btn-success me-1"><i class="fa fa-print"></i></a>
                                        {{-- <a href="#" class="btn btn-primary w-md">Send</a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->
            </div>
    </div>
</body>
</html>