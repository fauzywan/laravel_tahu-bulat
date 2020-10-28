@extends('layouts.master')
@section('top-main')
<div class="row">
{{-- <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="form-element-list mg-t-30">
                        <div class="cmp-tb-hd">
                            		<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="breadcomb-wp">
									<div class="breadcomb-icon">
                                    <a href="{{url('pesanan')}}"><i class="notika-icon notika-windows"></i></a>
									</div>
									<div class="breadcomb-ctn">
                                    <h2>Buat  {{Str::ucfirst(Request::segment(1))}}</h2>
                                    <p>Memasukan data pesanan </p>
                                    </div>
								</div>
                            </div>
					</div>        
                </div>
                </div> --}}
                    </div>
<form class="col-lg-12 col-md-12 col-sm-12 col-xs-12" action="{{url('buat/store')}}" method="post">
                    <div class="form-element-list mg-t-30">
                        <div class="cmp-tb-hd">
                            		<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="breadcomb-wp">
									<div class="breadcomb-icon">
                                    <a href="{{url('pesanan')}}"><i class="notika-icon notika-windows"></i></a>
									</div>
									<div class="breadcomb-ctn">
                                    <h2>Buat  {{Str::ucfirst(Request::segment(1))}}</h2>
                                    <p>Memasukan data pesanan </p>
                                    </div>
								</div>
                            </div>
					</div>        
                </div>
@endsection
@section('main')

                @csrf
                @method('post')
                        <div class="row">
                         <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-avable"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <select name="nama" id="" class="form-control">
                                        <option value="{{$pesanan->id}}">{{$pesanan->distributor->nama}}</option>                           
                                        </select>
                                    </div>
                                </div>
                            </div>  
                          
                         <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-calendar"></i>
                                    </div>
                                    <div class="nk-int-st">      
                                    <input type="date" name="tanggal" id="" class="form-control" value="{{$pesanan->tanggal}}">
                                    </div>
                                </div>
                            </div>  
                        </div>
                        
         
                        <div class="row">
                         <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-draft"></i>
                                    </div>
                                    <div class="nk-int-st">
                                    <select name="karyawan_1" id="" class="form-control">
                                        <option value="" hidden>Karyawan 1</option>
                                        @foreach ($karyawan as $k)
                                   
                                    <option value="{{$k->id}}">{{$k->nama}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                            </div>  
                         <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-draft"></i>
                                    </div>
                                    <div class="nk-int-st">
                                      <select name="karyawan_2" id="" class="form-control">
                                          <option value="" hidden> Karyawan 2</option>
                                        @foreach ($karyawan as $k)
                                   
                                    <option value="{{$k->id}}">{{$k->nama}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                         </div>
                        </div>
               <div class="row">
                         <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-dollar"></i>
                                    </div>
                                    <div class="nk-int-st">
                                    <input type="text" class="form-control kuantitas-input" name="kuantitas" placeholder="Jumlah Tahu" value="{{$pesanan->jumlah}}">
                                    </div>
                                </div>
                            </div>  
                         <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-dollar"></i>
                                    </div>
                                    <div class="nk-int-st">
                                    <input type="text" class="form-control numberFormat harga-input" name="harga" placeholder="Harga satuan" value="{{number_format($pesanan->harga_satuan)}}">
                                    </div>
                                </div>
                         </div>
                        </div>
                        <div class="row">
                         <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-dollar"></i>
                                    </div>
                                    <div class="nk-int-st">
                                    <input type="text" class="form-control total-input"  name="total" placeholder="Total harga" value="{{number_format($pesanan->harga)}}">
                                    </div>
                                </div>
                            </div>  
                        </div>
                        <div class="row">
                         <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                 <button class="btn btn-success" >Mulai</button>
                                </div>
                            </div>  
                        </div>
                        
                          
@endsection
@section('foot-main')
</div>
</form>
</div>
<script src="{{ asset('js/mine/tolha.js') }}"></script>
<script src="{{ asset('js/mine/rp.js') }}"></script>
@endsection