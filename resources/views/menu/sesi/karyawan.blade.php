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
                      {{-- <div class="h5 mb-0 font-weight-bold text-gray-800">{{($sesi->sedang_dibuat())}} Buah</div> --}}
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
    <a class="nav-item nav-link" id="nav-home-tab"  href="./sesi" >Detail</a>
    <a class="nav-item nav-link"href="./adonan">Buat Adonan</a>
    <a class="nav-item nav-link active">Tambah Karyawan</a>
  </div>
</nav>
@endsection