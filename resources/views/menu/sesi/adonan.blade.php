@extends('layouts.master')

@section('navbar')
    <a href="/pesanan">
        <i class=" btn-circle fas fa-arrow-left"></i>Back    
    </a>
    @endsection
@section('top-main')
<div class="row mb-3">
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-success   shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Sedang Dibuat</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{($sesi->sedang_dibuat())}} Buah</div>
                    </div>
                    <img class="" style="width:120px; position:absolute; bottom: 1px;  right: 0px;"  src="{{asset('unDraw/undraw_deliveries_131a.svg')}}">               
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-primary  shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Sudah Dibuat</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">  {{($sesi->dibuat)}} Buah</div>
                    </div>
                    <img class="" style="width:120px; position:absolute; bottom: 2px;  right: 0px;"  src="{{asset('unDraw/undraw_deliveries_131a.svg')}}">               
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-danger  shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Belum Dibuat</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">  {{($sesi->jumlah-$sesi->dibuat)-$sesi->sesi_produk->sum('sedang_dibuat')}} Buah</div>
                    </div>
                    <img class="" style="width:120px; position:absolute; bottom: 2px;  right: 0px;"  src="{{asset('unDraw/undraw_deliveries_131a.svg')}}">               
                  </div>
                </div>
              </div>
            </div>

    </div>
  
    <nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
        @if($sesi->status==0)
    <a class="nav-item nav-link" href="./rekap">Rekap</a>
    @endif
    <a class="nav-item nav-link" id="nav-home-tab"  href="./sesi" >Detail</a>
    <a class="nav-item nav-link active" >Adonan</a>
    <a class="nav-item nav-link" href="./create">Buat Adonan</a>
    <a class="nav-item nav-link" href="./packing">Packing</a>
  </div>
</nav>


@endsection
@section('main')
<div class="row">
  <div class="col-xl-12">
    <div class="card">
  <div class="card-header">
    Featured
  </div>
  <div class="card-body">
    <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Adonan yang Dibuat</th>
      <th scope="col">Pengambil</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($adonan as $a)
    <tr>
    <th scope="row">{{$loop->iteration}}</th>
    <td>{{$a->balo}} ({{$jumlah_balo->jumlah *$a->balo}} Buah)</td>
    <td>{{$a->sesi_karyawan->where('jenis',1)->first()->karyawan->nama}}</td>
    <td><a href="/adonan/{{$a->id}}/detail">Detail</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
  </div>
</div>
  </div>
</div>
@endsection