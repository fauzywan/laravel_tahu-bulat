@extends('layouts.master')
@section('top-main')
    <div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="breadcomb-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="breadcomb-wp">
									<div class="breadcomb-icon">
										<a href="/pesanan"><i class="notika-icon notika-edit"></i></a>
									</div>
									<div class="breadcomb-ctn">
										<h2> Buat Pesanan</h2>
										<p>Data <span class="bread-ntd">Pesanan yang sedang dibuat</span></p>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
								<div class="breadcomb-report">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
@endsection
@section('main')
<div class="row mg-t-30">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mg-tb-30">
                    <div class="contact-list">
                        <div class="contact-win">
                            <div class="contact-img">
                                <img src="img/post/1.jpg" alt="">
                            </div>
                            <div class="conct-sc-ic">
                               
                                {{-- <a class="btn waves-effect"data-toggle="tooltip" data-placement="right" title="" data-original-title="Ubah" href="#"><i class="notika-icon notika-edit"></i></a> --}}
                                <a class="btn waves-effect"data-toggle="tooltip" data-placement="right" title="" data-original-title="Hapus" style="background: #fb3131" href="#"><i class="notika-icon notika-trash"></i></a>
                                <a href="/sesi/{{$sesi->id}}/selesai"class="btn waves-effect"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Selesai" style="background: #466092" href="#"><i class="notika-icon notika-checked"></i></a>
                            </div>
                        </div>
                        <div class="contact-ctn">
                            <div class="contact-ad-hd">
								<h2>Sesi</h2>
                            <p class="ctn-ads">{{$sesi->tanggal}}</p>
							</div>
                            {{-- <p>Lorem ipsum dolor sit amete of the, consectetur adipiscing elitable. Vestibulum tincidunt.</p> --}}
                        </div>
                        <div class="social-st-list">
                            <div class="social-sn">
                                <h2>Pesanan:</h2>
                                <p>{{$sesi->sesi_produk->count()}}</p>
                            </div>
                            <div class="social-sn">
                                <h2>Jumlah Produk:</h2>
                            <p>{{$sesi->jumlah}} Buah</p>
                            </div>
                            <div class="social-sn">
                                <h2>Karyawan:</h2>
                            <p>{{$sesi->buat_produk->count()}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <form class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mg-tb-30" action="/sesi/{{$sesi->id}}/produk" method="POST">
                    @csrf
                  <div class="form-example-wrap">
                                <div class="cmp-tb-hd">
                                    <h2>Dibuat</h2>      
                                </div>  
                                          {{-- <div class="form-example-int">
                                    <div class="form-group">
                                        <label>Tanggal Pemakaian</label>
                                        <div class="nk-int-st">
                                            <input type="date" name="tanggal" class="form-control" placeholder="Qyt">
                                        </div>
                                    </div>
                                </div>
                                   --}}
                                          <div class="form-example-int">
                                    <div class="form-group">
                                        <label>Bahan</label>
                                        <div class="nk-int-st">
                                               <select name="karyawan" id="" class="form-control">
                                                @foreach ($karyawan as $k)
                                                <option value="{{$k->id}}">{{$k->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                      <div class="form-example-int">
                                    <div class="form-group">
                                        <label>Jumlah</label>
                                        <div class="nk-int-st">
                                            <input type="text" name="kuantitas" class="form-control" placeholder="Qyt">
                                        </div>
                                    </div>
                                </div>   
                                <div class="form-example-int mg-t-15">
                                    <button class="btn btn-success notika-btn-success waves-effect">Gabung</button>
                                </div>
                            </div>
                </form>
                <form class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mg-tb-30" action="/sesi/{{$sesi->id}}/pemakaian" method="post">
                @csrf
                @method('post')
                    <div class="form-example-wrap">
                                <div class="cmp-tb-hd">
                                    <h2>Pemakaian</h2>      
                                </div>  
                                           <div class="form-example-int">
                                  <div class="form-group">
                                      <label>Karyawan</label>
                                      <div class="nk-int-st">
                                             <select name="karyawan" id="" class="form-control">
                                              @foreach ($karyawan as $k)
                                              <option value="{{$k->id}}">{{$k->nama}}</option>
                                              @endforeach
                                          </select>
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
                                      <label>Bahan</label>
                                      <div class="nk-int-st">
                                      <select name="barang" id="" class="form-control FORM_ ">
                                              @foreach ($belanja as $b)
                                           @if ($b->tersedia !=0)                                   
                                              <option  class="FORM_ {{$b->tersedia}}" value="{{$b->id}}_{{$b->tersedia}}{{$b->gudang->biaya_produksi->satuan->nama}}">{{$b->gudang->biaya_produksi->nama}}({{number_format($b->harga_satuan)}})</option>
                                          @endif
                                              @endforeach
                                          </select>
                                      </div>
                                  </div>
                              </div>
                             
                              <div class="form-example-int">
                                 <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xm-12">
                                        <div class="form-group">
                                            <label>Kuantitas</label>
                                            <div class="nk-int-st">
                                                <input type="text" name="kuantitas" class="form-control" placeholder="Qyt">                                           
                                            </div>
                                        </div>
                                    </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xm-12">
                                               <label>tersedia</label>
                                            <div class="nk-int-st">
                                            <input type="text"  disabled class="form-control Tersedia" placeholder="Qyt">
                                                
                                            </div>
                                        </div>
                                </div>     
                                </div>   

                                <div class="form-example-int mg-t-15">
                                    <button class="btn btn-success notika-btn-success waves-effect">Gabung</button>
                                </div>
                            </div>
                </form>
</div>



<div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="normal-table-list">
                                <div class="basic-tb-hd">
                                    <h2>Daftar Pesanan</h2>
                                    {{-- <p>Basic example without any additional modification classes</p> --}}
                                </div>
                                <div class="bsc-tbl">
                                    <table class="table table-sc-ex">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Agen</th>
                                                <th>Jumlah Order</th>
                                                <th>Harga</th>
                                                <th>Total</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sesi->sesi_produk as $sesi_produk)
                                                
                                            <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td><a href="/pesanan/{{$sesi_produk->pesanan_id}}/detail">{{$sesi_produk->pesanan->distributor->nama}}</a></td>
                                                <td>{{$sesi_produk->pesanan->jumlah}}</td>
                                            <td>Rp.{{number_format($sesi_produk->pesanan->harga_satuan)}}</td>
                                            <td>Rp.{{number_format($sesi_produk->pesanan->harga)}}</td>
                                            <td>
                                            @if($sesi_produk->pesanan->status==0)
                                                Sudah Diambil
                                            @else
                                            <a href="/pesanan/{{$sesi_produk->pesanan_id}}/ambil">Ambil</a>
                                            @endif
                                            </td>
                                            <td><a href="/sesi/{{($sesi_produk->id)}}/{{$sesi->id}}/hapus" class="btn btn-sm btn-danger"><i class="notika-icon notika-trash"></i></a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2" style="text-align: center">Jumlah</td>
                                            <td>{{$sesi->jumlah}}</td>
                                                <td>Total</td>
                                            <td>Rp.{{number_format($sesi->harga)}}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
        </div>
</div>
<div class="row">
    <form class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mg-tb-30" action="/buat/{{$sesi->id}}/karyawan" method="POST">
            @csrf
          <div class="form-example-wrap">
                        <div class="cmp-tb-hd">
                            <h2>Tambah  Karyawan</h2>
                        </div>
                        <div class="form-example-int">
                            <div class="form-group">
                                <label></label>
                                <div class="nk-int-st">
                                    
                                    <select name="karyawan" id="" class="form-control">
                                        @foreach ($karyawan as $k)
                                        <option value="{{$k->id}}">{{$k->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int mg-t-15">
                            <button class="btn btn-success notika-btn-success waves-effect">Gabung</button>
                        </div>
                    </div>
                </form> 
</div>
<div class="row mg-tb-30">
    
     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="normal-table-list">
                                <div class="basic-tb-hd">
                                    <h2>Daftar Karyawan</h2>
                                    {{-- <p>Basic example without any additional modification classes</p> --}}
                                </div>
                                <div class="bsc-tbl">
                                    <table class="table table-sc-ex">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Dibuat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sesi->buat_produk as $buat_produk)
                                                
                                            <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$buat_produk->karyawan->nama}}</td>
                                            <td>{{$buat_produk->jumlah}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                           
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
        </div> 
       <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="normal-table-list">
                                <div class="basic-tb-hd">
                                    <h2>Pemakaian Bahan Baku</h2>
                                    {{-- <p>Basic example without any additional modification classes</p> --}}
                                </div>
                                <div class="bsc-tbl">
                                    <table class="table table-sc-ex">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Bahan</th>
                                                <th>Kuantitas</th>
                                            </tr>
                                        </thead>
                                        @foreach ($pemakaian as $pakai)

                                        @foreach (($pakai->where('belanja_id',$pakai->belanja_id)->get()) as $p)                                            
                                        <tbody>
                                            <td>{{$p->karyawan->nama}}</td>
                                            <td>{{$p->belanja->gudang->biaya_produksi->nama}}</td>
                                            <td>{{$p->jumlah}} {{$p->belanja->gudang->biaya_produksi->satuan->nama}}</td>
                                        </tbody>
                                        @endforeach

                                            @endforeach
                                            <tfoot>
                                            </tfoot>
                                            </table>
                                        </div>
                                    </div>
        </div>  
</div>
@endsection

@section('script')

<script>
    if(document.querySelectorAll('option').length>0){

        
        document.querySelector('.Tersedia').value=document.querySelector('option.FORM_').value.substr(2);
    }
const tersediaForm=[...document.querySelectorAll('option.FORM_')];
document.querySelector('select.FORM_').addEventListener('change',function(){
document.querySelector('.Tersedia').value=(this.value).substr(2);
})

</script>

@endsection