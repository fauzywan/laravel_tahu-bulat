@extends('layouts.master')
@section('top-main')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="normal-table-list mg-t-30">
                        <div class="basic-tb-hd">
                            <div class="breadcomb-list">
                                <div class="row">    
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="breadcomb-wp">
                                            <div class="breadcomb-icon">
                                            <a href="{{url('pesanan/create')}}"><i class="notika-icon notika-windows"></i></a>
                                            </div>
                                            <div class="breadcomb-ctn">
                                            <h2>Daftar  {{Str::ucfirst(Request::segment(1))}}</h2>
                                                <p>Menampilkan <span class="bread-ntd">data pesanan </span></p>
                                            </div>
                                        </div>
                                    </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="nk-int-mk sl-dp-mn tg-dp-mn">
                                            <label for="ts1" class="ts-label">Bayar Banyak</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                <div class="toggle-select-act fm-cmp-mg">
                                                    <div class="nk-toggle-switch">
                                                        <input id="ts1" type="checkbox" hidden="hidden" class="bayarBanyak">
                                                        <label for="ts1" class="ts-helper"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 form-multi hide" >
                                                <span  class="btn btn-success" style="background: #22DEB0">Bayar</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>  
                         
                        <div class="bsc-tbl-hvr  oVo">               
                            <table class="table table-hover pesanan-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Jumlah Pesanan</th>
                                        <th>Belum Dibayar</th>
                                        <th>Status Pesanan</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pesanan as $pesan)
                                        
                                    <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td id="pesanan-{{$pesan->id}}">{{$pesan->distributor->nama}}</td>
                                    <td>{{$pesan->jumlah}}</td>
                                    <td>{{$pesan->belumDibayar()}}</td>
                                    <td>
                                        {{-- <span>{{$pesan->sesi()}}</span> --}}
                                        <span></span>
                                    </td>
                                    <td>
                                  <span class="btn btn-sm btn-success waves-effect btn-credit" data-toggle="tooltip" data-placement="right" title="" data-original-title="Bayar"><i class="notika notika-icon notika-credit-card"  ></i></span>
                                  <span class="btn btn-sm btn-primary waves-effect" data-toggle="tooltip" data-placement="right" title="" data-original-title="Detail"><i class="notika notika-icon notika-more-button"></i></span>
                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>    
@endsection
@section('main')
                            <form class="bsc-tbl-hvr mVm hide" action="{{url('pesanan/banyak')}}" method="POST">
                                    @csrf
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Jumlah Pesanan</th>
                                                <th>Belum Dibayar</th>
                                                <th>Status Pesanan</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pesanan as $pesan)
                                                
                                            <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$pesan->distributor->nama}}</td>
                                            <td>{{$pesan->jumlah}}</td>
                                            <td>{{$pesan->belumDibayar()<=0?'':"Rp.".number_format($pesan->belumDibayar())}}</td>
                                            {{-- <td>{{$pesan->sesi( )}}</td> --}}
                                            <td>@if ($pesan->belumDibayar()!="Lunas")
                                                
                                                
                                                <div class="btn-group" role="group" aria-label="Basic example" style="display:inline">
                                                    <input type="text" class="form-control numberFormat" name="uang[]" value="{{number_format($pesan->belumDibayar())}}
                                                    ">
                                                    <input type="hidden" class="form-control pesananH" name="pesanan[]" value="{{$pesan->id}}">
                                                </div>
                                                @else
                                                Lunas   
                                                @endif
                                            </td>
                                            <td><span class="btn btn-sm btn-danger deLeTe"><i class="notika notika-icon notika-trash"></i></span></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </form>
                    </div>
                </div>
            </div>
        <form class="col-lg-4 col-md-4 col-sm-4 col-xs-12 formBayar" action="" method="POST">
            @csrf
                <div class="form-example-wrap mg-t-30">
                        <div class="cmp-tb-hd cmp-int-hd">
                            <h2>Bayar Pesanan</h2>
                        </div>
                        <div class="form-example-int form-horizental mg-t-15">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                        <label class="hrzn-fm">Pesanan</label>
                                    </div>
                                    <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                        <div class="nk-int-st">
                                                
                                            <select name="pesanan" id="" class="form-control">
                                                <option class="pesanan-option "></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                        <label class="hrzn-fm">Tanggal</label>
                                    </div>
                                    <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                        <div class="nk-int-st">
                                            <input type="date" class="form-control input-sm" name="tanggal">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int form-horizental mg-t-15">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                        <label class="hrzn-fm">Nominal uang</label>
                                    </div>
                                    <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                        <div class="nk-int-st">
                                            <input type="text" class="form-control input-sm numberFormat" name="uang" placeholder="Nominal Uang">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int mg-t-15">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                    <button class="btn btn-success notika-btn-success waves-effect hide">Bayar</button>
                                    <span class="btn btn-danger batal waves-effect hide">Batal</span>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
</div>
   
@endsection
@section('script')
    <script src="{{ asset('js/mine/rp.js') }}"></script>
    <script src="{{ asset('js/mine/bayarBanyak.js') }}"></script>
    <script src="{{ asset('js/mine/bayarSatu.js') }}"></script>
        
@endsection