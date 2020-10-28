@extends('layouts.master')
@section('top-main')

@endsection
@section('main')
    
@endsection
@section('main')
<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="breadcomb-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="breadcomb-wp">
									<div class="breadcomb-icon">
                                    <a href="/pesanan"><i class="notika-icon notika-form"></i></a>
									</div>
									<div class="breadcomb-ctn">
										<h2>Detail Pesanan</h2>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
                
                <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="invoice-wrap">
                        <div class="invoice-img">
                        <h2>{{$pesanan->distributor->nama}}</h2>
                            {{-- <img src="img/logo/logo.png" alt=""> --}}
                        </div>
                        <div class="invoice-hds-pro">
                            </div>
                        <div class="row mg-tb-10"> 
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="margin: 0  0 15px 0">
                                <div class="invoice-hs date-inv sm-res-mg-t-30 tb-res-mg-t-30 tb-res-mg-t-0">
                                    <span>Status Pesanan </span>
                                    <h2> @if ($pesanan->sesi()==true)
                                        <span>{{$pesanan->sesi()->status==1?'Sedang dibuat':'Sudah dibuat'}}</span>
                                        @else
                                        <span>Belum Dibuat</span>
                                        @endif</h2>
                                    </div>
                                </div>
                        
                             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="invoice-hs">
                                    <span>Tanggal Pesanan</span>
                                <h2>{{date('d F Y',strtotime($pesanan->tanggal))}}</h2>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="invoice-hs date-inv sm-res-mg-t-30 tb-res-mg-t-30 tb-res-mg-t-0">
                                    <span>Nomor Telepon</span>
                                <h2>{{$pesanan->distributor->telepon}}</h2>
                                </div>
                            
                        </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="invoice-hs date-inv sm-res-mg-t-30 tb-res-mg-t-30 tb-res-mg-t-0">
                                    <span> Alamat</span>
                                <h2 style="font-weight: 400; font-size: 12px;">{{$pesanan->distributor->alamat}}</h2>
                                </div>
                            
                            </div>
                        </div>
                        
                        <div class="row mg-tb-10"> 
                                      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="invoice-hs wt-inv sm-res-mg-t-30 tb-res-mg-t-30 tb-res-mg-t-0">
                                    <span>Jumlah Pesanan</span>
                                <h2>{{$pesanan->jumlah}} Buah</h2>
                                </div>
                            </div>         
                           
                                          
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="invoice-hs wt-inv sm-res-mg-t-30 tb-res-mg-t-30 tb-res-mg-t-0">
                                    <span>Harga</span>
                                <h2>{{'Rp.'.number_format($pesanan->harga)}}</h2>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="invoice-hs wt-inv sm-res-mg-t-30 tb-res-mg-t-30 tb-res-mg-t-0">
                                    <span>Biaya Akomodasi</span>
                                <h2>{{'Rp.'.number_format($pesanan->biaya_akomodasi )}}</h2>
                                </div>
                            </div>
                           @if($pesanan->belumDibayar()==0)
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 belumDibayar" style="cursor: pointer">
                               
                                <div class="invoice-hs wt-inv sm-res-mg-t-30 tb-res-mg-t-30 tb-res-mg-t-0">
                                    <span>Status Keuangan</span>
                                <h2>Lunas</h2>
                            </div>
                            </div>
                            @else
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 belumDibayar" style="cursor: pointer">
                                <div class="invoice-hs gdt-inv sm-res-mg-t-30 tb-res-mg-t-30 tb-res-mg-t-0 ">
                                    <span>Belum Dibayar</span>
                                    <h2>Rp.{{number_format($pesanan->belumDibayar())}}</h2>
                                <span class="color:white">tekan untuk membayar</span>

                                </div>
                            </div>
                            @endif
                        </div>
                            <div class="row">
                            </div>
                        <div class="row">   
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5  FormBayar hide">
                                <div class="contact-list ">
                                    <div class="breadcomb-list">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="breadcomb-wp">
                                                            <div class="breadcomb-icon">
                                                                <i class="notika-icon notika-dollar"></i>
                                                            </div>
                                                            <div class="breadcomb-ctn">
                                                                <h2>Bayar</h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                       @csrf
                                @method('post')
                                            <div class="form-example-wrap">
                                                <div class="cmp-tb-hd">
                                                    
                                                </div>
                                                <form  action="/pesanan/{{$pesanan->id}}/bayar" method="POST">
                                                    @csrf
                                                        <div class="form-group ic-cmp-int">
                                                            <div class="form-ic-cmp">
                                                                <i class="notika-icon notika-calendar"></i>
                                                            </div>
                                                            <div class="nk-int-st">
                                                                <input type="date"  class="form-control" name="tanggal">
                                                            </div>
                                                        </div>
                                                <div class="form-example-int mg-t-15">
                                                        <div class="form-group ic-cmp-int float-lb form-elet-mg">
                                                            <div class="form-ic-cmp">
                                                                <i class="notika-icon notika-dollar"></i>
                                                            </div>
                                                            <div class="nk-int-st">
                                                                <input type="text" class="form-control numberFormat" name="uang">
                                                            </div>
                                                            <div class="form-ic-cmp">
                                                                <i class="notika-icon notika-credit-card"></i>
                                                            </div>
                                                        </div>
                                                </div>
                                                
                                                <div class="form-example-int mg-t-15">
                                                    <button class="btn btn-success notika-btn-success waves-effect">Bayar</button>
                                                </div>
                                            </form>
                                            </div>
                    </div>
                </div>
</div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="invoice-sp">
                                    <h3>Transaksi  Pesanan</h3>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tanggal</th>
                                                <th>Nominal uang</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pesanan->transaksi_pesanan as $transaksi) 
                                            <tr>               
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{date('d F Y',strtotime($transaksi->tanggal))}}</td>
                                            <td>Rp.{{number_format($transaksi->nominal_uang)}}</td>
                                            </tr>
                                            @endforeach
                             </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
  
            @endsection
            @section('script')
                
        <script src="{{ asset('js/mine/js.js') }}">

            </script>
            <script>
                const belumDibayar=document.querySelector('.belumDibayar');
                belumDibayar.addEventListener('click',function(){

                    if(document.querySelector('.FormBayar').classList[document.querySelector('.FormBayar').classList.length-1]=='hide'){
                        document.querySelector('.FormBayar').classList.remove('hide');
                        
                    }else{
                        document.querySelector('.FormBayar').classList.add('hide');

                    }
                })
            </script>
            @endsection