@extends('layouts.master')
@section('main')
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Pesanan Hari ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data['pesanan_hari_ini']}} Pesanan</div>
                            </div>
                            <div class="col-auto">
                                 <img class="" style="width:100px; "  src="{{asset('unDraw/undraw_successful_purchase_uyin.svg')}}">               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pesanan Produk Hari Ini</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data['jumlah']}} Buah</div>
                            </div>
                            <div class="col-auto"><i class="fas fa-cash-register fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Keuangan Hari ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.{{($data['total_harga'])}}</div>
                            </div>
                            <div class="col-auto"><i class="fas fa-user-tie fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Uang Diluar</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.{{$data['uang_diluar']}}</div>
                            </div>
                            <div class="col-auto"><i class="fas fa-tags fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Status Toko</div>
                                
                                <div v-else class="h5 mb-0 font-weight-bold text-gray-800">Menerima pesanan</div>
                            </div>
                            <div class="col-auto"><i class="fas fa-store-alt fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Uang Masuk</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.{{$data['uang_masuk']}}</div>
                            </div>
                            <div class="col-auto"><i class="fas fa-database fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection