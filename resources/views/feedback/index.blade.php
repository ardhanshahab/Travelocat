@extends('layouts.template')
@section('content')

<div class="container" style="width: auto; height: auto;">
    <div class="modal fade" id="loadingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-md-12 d-flex justify-content-between">
                        <h5 class="modal-title" id="exampleModalLabel">Pengumuman</h5>
                        {{-- <button type="button" class="btn-no" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                    </div>
                </div>
                <div class="modal-body" style="overflow-y: scroll; height:300px">
                    <h6>Terimakasih Telah berbelanja di Travelocat! Kami mohon untuk meminta waktu anda sebentar untuk survey E-commerce Travelocat</h6> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-custom" id="btn-yes" data-dismiss="modal">Ya</button>
                    <button type="button" class="btn btn-custom" id="btn-no" data-dismiss="modal">Tidak</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('feedback.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama:</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ auth()->user()->name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="komentar">Komentar:</label>
                            <textarea class="form-control" id="komentar" name="komentar" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="rating">Rating (1-5):</label>
                            <input type="number" class="form-control" id="rating" name="rating" min="1" max="5" required>
                        </div>
                        <h4>Pelayanan</h4>
                        <div class="row m-1">
                            <div class="col-lg-6">
                                <h2 class="h5">
                                    Memberikan Informasi yang mudah dimegerti dan tepat sasaran 
                                </h2>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="1" id="T1-1" name="T1">
                                        <label class="form-check-label" for="T1-1">Kurang</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="2" id="T1-2" name="T1">
                                        <label class="form-check-label" for="T1-2">Cukup</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="3" id="T1-3" name="T1">
                                        <label class="form-check-label" for="T1-3">Baik</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="4" id="T1-4" name="T1">
                                        <label class="form-check-label" for="T1-4">Baik Sekali</label>
                                    </div>
                                </div>
                                <hr class="mt-4">
                            </div>
                        </div>

                        <div class="row m-1">
                            <div class="col-lg-6">
                                <h2 class="h5">
                                    Penyambutan dan juga Pelayanan terhadap Konsumen
                                </h2>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="1" id="T2-1" name="T2">
                                        <label class="form-check-label" for="T2-1">Kurang</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="2" id="T2-2" name="T2">
                                        <label class="form-check-label" for="T2-2">Cukup</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="3" id="T2-3" name="T2">
                                        <label class="form-check-label" for="T2-3">Baik</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="4" id="T2-4" name="T2">
                                        <label class="form-check-label" for="T2-4">Baik Sekali</label>
                                    </div>
                                </div>
                                <hr class="mt-4">
                            </div>
                        </div>

                        <div class="row m-1">
                            <div class="col-lg-6">
                                <h2 class="h5">
                                    Kenyamanan pada saat berkunjung
                                </h2>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="1" id="R1-1" name="R1">
                                        <label class="form-check-label" for="R1-1">Kurang</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="2" id="R1-2" name="R1">
                                        <label class="form-check-label" for="R1-2">Cukup</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="3" id="R1-3" name="R1">
                                        <label class="form-check-label" for="R1-3">Baik</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="4" id="R1-4" name="R1">
                                        <label class="form-check-label" for="R1-4">Baik Sekali</label>
                                    </div>
                                </div>
                                <hr class="mt-4">
                            </div>
                        </div>
                        
                        <div class="row m-1">
                            <div class="col-lg-6">
                                <h2 class="h5">
                                    Keramahan Pegawai
                                </h2>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="1" id="R2-1" name="R2">
                                        <label class="form-check-label" for="R2-1">Kurang</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="2" id="R2-2" name="R2">
                                        <label class="form-check-label" for="R2-2">Cukup</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="3" id="R2-3" name="R2">
                                        <label class="form-check-label" for="R2-3">Baik</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="4" id="R2-4" name="R2">
                                        <label class="form-check-label" for="R2-4">Baik Sekali</label>
                                    </div>
                                </div>
                                <hr class="mt-4">
                            </div>
                        </div>
                        <div class="row m-1">
                            <div class="col-lg-6">
                                <h2 class="h5">
                                    Responsif dalam Pelayanan Online maupun Offline
                                </h2>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="1" id="S1-1" name="S1">
                                        <label class="form-check-label" for="S1-1">Kurang</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="2" id="S1-2" name="S1">
                                        <label class="form-check-label" for="S1-2">Cukup</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="3" id="S1-3" name="S1">
                                        <label class="form-check-label" for="S1-3">Baik</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="4" id="S1-4" name="S1">
                                        <label class="form-check-label" for="S1-4">Baik Sekali</label>
                                    </div>
                                </div>
                                <hr class="mt-4">
                            </div>
                        </div>

                        <div class="row m-1">
                            <div class="col-lg-6">
                                <h2 class="h5">
                                    Cara Menjawab Pertanyaan yang anda berikan
                                </h2>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="1" id="E1-1" name="E1">
                                        <label class="form-check-label" for="E1-1">Kurang</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="2" id="E1-2" name="E1">
                                        <label class="form-check-label" for="E1-2">Cukup</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="3" id="E1-3" name="E1">
                                        <label class="form-check-label" for="E1-3">Baik</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="4" id="E1-4" name="E1">
                                        <label class="form-check-label" for="E1-4">Baik Sekali</label>
                                    </div>
                                </div>
                                <hr class="mt-4">
                            </div>
                        </div>

                        <div class="row m-1">
                            <div class="col-lg-6">
                                <h2 class="h5">
                                    Keamanan Dalam Berbelanja
                                </h2>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="1" id="E2-1" name="E2">
                                        <label class="form-check-label" for="E2-1">Kurang</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="2" id="E2-2" name="E2">
                                        <label class="form-check-label" for="E2-2">Cukup</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="3" id="E2-3" name="E2">
                                        <label class="form-check-label" for="E2-3">Baik</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="4" id="E2-4" name="E2">
                                        <label class="form-check-label" for="E2-4">Baik Sekali</label>
                                    </div>
                                </div>
                                <hr class="mt-4">
                            </div>
                        </div>

                        <h4>Produk</h4>
                        <div class="row m-1">
                            <div class="col-lg-6">
                                <h2 class="h5">
                                   Kualitas Produk
                                </h2>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="1" id="A1-1" name="A1">
                                        <label class="form-check-label" for="A1-1">Kurang</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="2" id="A1-2" name="A1">
                                        <label class="form-check-label" for="A1-2">Cukup</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="3" id="A1-3" name="A1">
                                        <label class="form-check-label" for="A1-3">Baik</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="4" id="A1-4" name="A1">
                                        <label class="form-check-label" for="A1-4">Baik Sekali</label>
                                    </div>
                                </div>
                                <hr class="mt-4">
                            </div>
                        </div>
                        <div class="row m-1">
                            <div class="col-lg-6">
                                <h2 class="h5">
                                    Transparansi Informasi Produk
                                </h2>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="1" id="A2-1" name="A2">
                                        <label class="form-check-label" for="A2-1">Kurang</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="2" id="A2-2" name="A2">
                                        <label class="form-check-label" for="A2-2">Cukup</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="3" id="A2-3" name="A2">
                                        <label class="form-check-label" for="A2-3">Baik</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="4" id="A2-4" name="A2">
                                        <label class="form-check-label" for="A2-4">Baik Sekali</label>
                                    </div>
                                </div>
                                <hr class="mt-4">
                            </div>
                        </div>
                        
                        <div class="row m-1">
                            <div class="col-lg-6">
                                <h2 class="h5">
                                    Penataan Display Produk
                                </h2>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="1" id="S2-1" name="S2">
                                        <label class="form-check-label" for="S2-1">Kurang</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="2" id="S2-2" name="S2">
                                        <label class="form-check-label" for="S2-2">Cukup</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="3" id="S2-3" name="S2">
                                        <label class="form-check-label" for="S2-3">Baik</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="4" id="S2-4" name="S2">
                                        <label class="form-check-label" for="S2-4">Baik Sekali</label>
                                    </div>
                                </div>
                                <hr class="mt-4">
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#loadingModal').modal('show'); // Tampilkan modal sebelum memulai pemanggilan Ajax
        $('#btn-no').click(function(){
                window.location.href = '/';
            });
    });
</script>
@endsection