@extends('layouts.master')
@section('top-main')
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <a class="nav-item nav-link" href="/penggajian/potongan"> Home</a>
      <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Detail</a>
  </div>
</nav>
@endsection
@section('main')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                Potongan Gaji
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Nominal Uang</th>
                            <th>Deskripsi</th>
                        </tr>
                        @foreach ($karyawan as $k)
                                <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$k->karyawan->nama}}</td>
                                <td>{{$k->keterangan}}</td>
                                <td>Rp.{{number_format($k->nominal_uang)}}</td>
                                </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
    