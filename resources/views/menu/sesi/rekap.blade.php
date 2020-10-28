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
                      {{-- <div class="h5 mb-0 font-weight-bold text-gray-800">  {{($sesi->dibuat)}} Buah</div> --}}
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
                      {{-- <div class="h5 mb-0 font-weight-bold text-gray-800">  {{($sesi->jumlah-$sesi->dibuat)-$sesi->sesi_produk->sum('sedang_dibuat')}} Buah</div> --}}
                    </div>
                    <img class="" style="width:120px; position:absolute; bottom: 2px;  right: 0px;"  src="{{asset('unDraw/undraw_deliveries_131a.svg')}}">               
                  </div>
                </div>
              </div>
            </div>

    </div>
    <nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Rekap</a>
    <a class="nav-item nav-link" href="./sesi">Detail</a>
    <a class="nav-item nav-link" href="./adonan">Adonan</a>
    <a class="nav-item nav-link" href="./create">Buat Adonan</a>
    <a class="nav-item nav-link" href="./packing"> Packing</a>
  </div>
</nav>
@endsection
    @section('main')
    <div class="row">
  
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                Daftar Pesanan
            </div>
                    <div class="card-body ">
                      <div class=" table-bordered table-stripped">
                      <table class="table">
                        <thead>
                        <tr>

                          <th>Agen</th>
                          <th>Jumlah Order</th>
                          <th>Harga</th>
                          <th>Akomodasi</th>
                          <th>Total</th>
                          <th>Uang Masuk</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                          @foreach ($sesi->sesi_produk as $produk)
                          <td>
                            {{$produk->pesanan->distributor->nama}}
                            </td>  
                          <td>{{$produk->pesanan->jumlah ."  (".number_format($produk->pesanan->harga_satuan).")"}}</td>
                          <td>{{number_format($produk->pesanan->harga)}}</td>
                          <td>{{number_format($produk->pesanan->biaya_akomodasi)}}</td>
                          <td>{{number_format($produk->pesanan->total_harga())}}</td>
                          <td>{{number_format($produk->pesanan->total_harga()-$produk->pesanan->belumDibayar())}}</td>
                            @endforeach
                          </tr>

                        </tbody>
                            <tr>
                              <td>Jumlah</td>
                            <td>{{$sesi->jumlah}}</td>
                            <td></td>
                            <td></td>
                            <td>{{number_format($sesi->harga)}}</td>
                            <td></td>
                            </tr>
                            <tr>
                              <td>Jumlah Balo</td>
                            <td>{{$sesi->jumlah_balo()}}</td>
                            <td></td>
                            <td></td>
                            <td>{{number_format($sesi->harga_balo())}}</td>
                            <td></td>
                            </tr>
                            <tr>
                              <td>Rata - Rata</td>
                            <td>{{$sesi->rata_rata()}}</td>
                                  <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            </tr>
                            <tr>
                              <td> Laba</td>
                                  <td></td>
                                  <td></td>
                            <td></td>
                            <td>{{number_format($sesi->laba())}}</td>
                            <td></td>
                            </tr>
                      </table>
                      </div>

                      

                    </div>
                </div>   
        </div>
 
    </div>
    
    @endsection