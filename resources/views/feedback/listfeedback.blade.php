@extends('layouts.dashboard')
@section('content')
<div class="container-fluid">
  <!-- table kategori -->
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Data Feedback</h4>
          <div class="card-tools">
            <a href="{{ route('feedback.create') }}" class="btn btn-sm btn-primary">
              Baru
            </a>
          </div>
        </div>
        <div class="card-body">
          {{-- <form action="#">
            <div class="row">
              <div class="col">
                <input type="text" name="keyword" id="keyword" class="form-control" placeholder="ketik keyword disini">
              </div>
              <div class="col-auto">
                <button class="btn btn-primary">
                  Cari
                </button>
              </div>
            </div>
          </form> --}}
        </div>
        <div class="card-body">
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
          @if(count($errors) > 0)
            @foreach($errors->all() as $error)
              <div class="alert alertwarning">{{ $error }}</div>
            @endforeach
          @endif
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th width="50px">No</th>
                  <th>Nama</th>
                  <th>Tangible 1</th>
                  <th>Tangible 2</th>
                  <th>Reability 1</th>
                  <th>Reability 2</th>
                  <th>Responsive 1</th>
                  <th>Responsive 2</th>
                  <th>Assurance 1</th>
                  <th>Assurance 2</th>
                  <th>Empaty 1</th>
                  <th>Empaty 2</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                {{-- {{ $feedbacks }} --}}
              @foreach($feedbacks as $kategori)
                <tr>
                <td>
                    {{ $loop->iteration }}
                </td>
                <td>
                    {{ $kategori->user->name }}
                </td>
                <td>
                    {{ $kategori->T1 }}
                </td>
                <td>
                    {{ $kategori->T2 }}
                </td>
                <td>
                    {{ $kategori->R1 }}
                </td>
                <td>
                    {{ $kategori->R2 }}
                </td>
                <td>
                    {{ $kategori->S1 }}
                </td>
                <td>
                    {{ $kategori->S2 }}
                </td>
                <td>
                    {{ $kategori->A1 }}
                </td>
                <td>
                    {{ $kategori->A2 }}
                </td>
                <td>
                    {{ $kategori->E1 }}
                </td>
                <td>
                    {{ $kategori->E2 }}
                </td>
                  {{-- <td>
                    <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-sm btn-primary mr-2 mb-2">
                      Edit
                    </a>
                    <form action="{{ route('kategori.destroy', $kategori->id) }}" method="post" style="display:inline;">
                      @csrf
                      {{ method_field('delete') }}
                      <button type="submit" class="btn btn-sm btn-danger mb-2">
                        Hapus
                      </button>                    
                    </form>
                  </td> --}}
                </tr>
              @endforeach
              </tbody>
            </table>
            <!-- untuk menampilkan link page, tambahkan skrip di bawah ini -->
            {{ $feedbacks->links() }}
          </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <th>Tangible</th>
                    <th>Reability</th>
                    <th>Responsive</th>
                    <th>Assurance</th>
                    <th>Empaty</th>
                </thead>
                <tbody>
                    <td>
                        {{ $tangible }}
                    </td>
                    <td>
                        {{ $reability }}
                    </td>
                    <td>
                        {{ $responsive }}
                    </td>
                    <td>
                        {{ $assurance }}
                    </td>
                    <td>
                        {{ $empaty }}
                    </td>
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection