@extends('layouts.master')
@section('navbar')
    <a href="/karyawan" class="text-decoration-none">
        <i class=" btn-circle fas fa-arrow-left"></i>Back    
    </a>
    @endsection
@section('top-main')
    <h1 class="h3 mb-4   text-gray-800 ">Detail Karyawan</h1>
            <nav class="mb-2">
                              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                              <a class="nav-item nav-link " href="./detail"  >Profil</a>
                              <a class="nav-item nav-link active">Meminjam</a>
                    
                            </nav>
<div class="row">
           <div class="col-xl-4 col-md-6 mb-4">
          <div class="card border-left-success   shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">peminjaman</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$karyawan->nama}}</div>
            </div>
            <img class="" style="width:120px; position:absolute; width: 75px; bottom: -1px;  right:10px;"  src="{{asset('unDraw/undraw_receipt_ecdd.svg')}}">               
            
              </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-4 col-md-6 mb-4"id="lunasi" style="cursor: pointer">
        <div class="card border-left-primary   shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Hutang Belum Dibayar</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="dibayar">Rp.{{number_format($belum_dibayar)}}</div>
                    </div>
                    <img class="" style="width:120px; position:absolute; bottom: 0;  right: 10px;"  src="{{asset('unDraw/undraw_pay_online_b1hk.svg')}}">               
                    
                </div>
            </div>
        </div>
    </div>  
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-danger   shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Peminjaman</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{($karyawan->peminjaman->where('status',1)->count())}}</div>
                    </div>
                   
                    <img class="" style="width:110px; position:absolute; bottom: 0;  right: 0px;"  src="{{asset('unDraw/2.svg')}}">               
                </div>
            </div>
          </div>
        </div>
    </div>
@endsection
@section('main')
          <div class="row">
              <div class="col-xl-6 col-md-6">
                  <div class="card mb-3">
                      <div class="card-header bg-success text-white">
                          Detail
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Meminjam</th>
                                        <th scope="col">Belum Dibayar</th>
                                        {{-- <th scope="col">Bayar</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($karyawan->peminjaman as $peminjaman)
                                    <tr>
                                        <th scope="row">1</th>
                                    <td>{{date('d F Y',strtotime($peminjaman->tanggal))}}</td>
                                    <td>Rp.{{number_format($peminjaman->hutang)}}</td>
                                    <td>Rp.{{number_format($peminjaman->hutang-$peminjaman->transaksi_peminjaman->sum('nominal_uang'))}}</td>
                                        {{-- <td><button type="submit" class="btn btn-sm btn-success">Bayar</button></td> --}}
                                    </tr>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-8">
                <div class="card mb-3">
                    <div class="card-header bg-success text-white">
                        Bayar Peminjaman
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="tanggal">Tanggal Peminjaman</label>
                                <input type="date" class="form-control numberFormat" name="pinjam" id="tanggal" value="{{$terakhir->tanggal}}">
                            </div>
                            <div class="form-group">
                                <label for="uang">Nominal Uang</label>
                                <input type="text" class="form-control numberFormat" name="uang" id="uang">
                            </div>
                            <div class="form-group">
                                <label for="tanggal">Tanggal Transaksi</label>
                                <input type="date" class="form-control numberFormat" name="tanggal" id="tanggal" value="{{date('Y-m-d')}}">
                            </div>
                            <button type="submit" style="float:right" class="btn btn-success">Bayar</button>
                        </form>
                        <div class="" >
                            {{-- <a href="/pesanan" class="btn btn-danger" >Tidak Sekarang</a> --}}
                        </div>
            </div>
        </div>
    </div>
</div>
              
              
@endsection
@section('script')
    <script src="{{ asset('js/mine/rp.js') }}"></script>

@endsection