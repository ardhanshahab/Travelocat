@extends('layouts.template')
@section('content')

<div class="container" style="width: auto; height: auto;">
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
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="komentar">Komentar:</label>
                            <textarea class="form-control" id="komentar" name="komentar" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="rating">Rating:</label>
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
                        
                        
                        
                        
                        
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection