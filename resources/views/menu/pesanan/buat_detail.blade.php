@extends('layouts.master')
@section('top-main')
    <div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="breadcomb-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="breadcomb-wp">
									<div class="breadcomb-icon">
										<i class="notika-icon notika-form"></i>
									</div>
									<div class="breadcomb-ctn">
										<h2>Form Examples</h2>
										<p>Welcome to Notika <span class="bread-ntd">Admin Template</span></p>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
								<div class="breadcomb-report">
									<button data-toggle="tooltip" data-placement="left" title="" class="btn waves-effect" data-original-title="Download Report"><i class="notika-icon notika-sent"></i></button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
@endsection
@section('main')
<div class="row mg-t-30">
  <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="contact-list sm-res-mg-t-30">
                        <div class="contact-win">
                            <div class="contact-img">
                                <img src="img/post/2.jpg" alt="">
                            </div>
                            <div class="conct-sc-ic">                          
                            <a class="btn waves-effect" href="/buat/{{$produk->id}}/edit"><i class="notika-icon notika-edit waves-effect" data-toggle="tooltip" data-placement="left" title="" data-original-title="Edit"></i></a>          
                                <a class="btn waves-effect" href="#"><i class="notika-icon notika-trash waves-effect" data-toggle="tooltip" data-placement="left" title="" data-original-title="Hapus"></i></a>
                            
                            </div>
                        </div>
                        <div class="contact-ctn">
							<div class="contact-ad-hd">
                            <h2>{{$produk->pesanan->distributor->nama}}</h2>
                            <p class="ctn-ads">{{$produk->pesanan->distributor->alamat}}</p>
                            <p class="ctn-ads">{{date('d F Y',strtotime($produk->pesanan->tanggal))}}</p>
							</div>
                            <p></p>
                        </div>
                        <div class="social-st-list">
                            <div class="social-sn">
                                <h2>Pesanan:</h2>
                            <p>{{$produk->pesanan->jumlah}} Buah</p>
                            </div>
                         
                            <div class="social-sn">
                                <h2>Status:</h2>
                                <p>@if ($produk->pesanan->status==1)
                                        Belum di buat
                                    @elseif($produk->pesanan->status==2)
                                    Sedang dibuat
                                    @else
    Sudah dibuat
                                        
                                @endif</p>

                            </div>
                            
                        </div>
                        <hr>
                <a class="btn btn-success" href="/buat/{{$produk->id}}/selesai">Selesai</a>
                    </div>
                </div>
            <form class="col-lg-5 col-md-5 col-sm-5 col-xs-12" action="/pemakaian/{{$produk->id}}/store" method="POST">
                @csrf
                @method('post')
        <div class="form-example-wrap">
                        <div class="cmp-tb-hd">
                        <h2>Penggilingan dan Pencetakan</h2>
                        <p>{{$produk->karyawan()}}</p>
                        </div>
                        <div class="form-example-int">
                            <div class="form-group">
                                <label>Biaya Produksi</label>
                                <div class="nk-int-st">
                                    <select name="barang" id="" class="form-control">
                                        @foreach ($produksi as $p)
                                    <option value="{{$p->id}}">{{$p->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int">
                            <div class="form-group">
                                <label>Kuantitas</label>
                                <div class="nk-int-st">
                                    <input type="text" name="kuantitas" class="form-control" placeholder="Qyt">
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int">
                            <div class="form-group">
                                <label>Tanggal Pemakaian</label>
                                <div class="nk-int-st">
                                    <input type="date" name="tanggal" class="form-control" placeholder="Qyt">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-example-int">
                            <div class="form-group">
                                <button class="btn btn-sm btn-success">Pakai</button>
                            </div>
                        </div>
                    </div>
    </form>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="form-example-wrap">
                        <div class="cmp-tb-hd">
                            <h2></h2>
                            <p></p>
                        </div>
                        <div class="form-example-int">
                            <h2>Biaya Produksi</h2>
                           <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Biaya</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($produk->pemakaian as $pemakaian)
                                    <tr>
                                            
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$pemakaian->biaya_produksi->nama}}</td>
                                    <td>{{$pemakaian->jumlah ." "  .$pemakaian->biaya_produksi->satuan->nama}}</td>
                                    </tr> 
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                 
                    </div>
    </div>
</div>
@endsection
@section('foot-main')
    
@endsection