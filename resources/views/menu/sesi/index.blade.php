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
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Detail</a>
    <a class="nav-item nav-link" href="./adonan">Adonan</a>
    <a class="nav-item nav-link" href="./create">Buat Adonan</a>
    <a class="nav-item nav-link" href="./packing"> Packing</a>
  </div>
</nav>
@endsection
    @section('main')
    <div class="row">
  
        <div class="col-xl-7">
            <div class="card">
                <div class="card-header">
                Daftar Pesanan
            </div>
                    <div class="card-body">
                            <table class="table ">
                        <thead>
                            <tr class="bg-light">
                            <th scope="col">#</th>
                            <th scope="col">Pemesan</th>
                            <th scope="col">Jumlah Pesanan</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sesi->sesi_produk as $pesanan)
                            <tr >
                            <th scope="row">{{$loop->iteration}}</th>
                            <td><a href="/pesanan/{{$pesanan->pesanan->id}}/detail">{{$pesanan->pesanan->distributor->nama}}</a></td>
                            <td>{{$pesanan->pesanan->jumlah}}</td>
                            <td>Rp.{{number_format($pesanan->pesanan->total_harga())}}</td>
                            <td>
                              @if($pesanan->status>0)
                              @if($sesi->dibuat<$pesanan->pesanan->jumlah)     
                              <span class="badge badge-success">Sedang Dibuat</span>
                              @else
                              @if($sesi->dikemas>=$pesanan->pesanan->jumlah)
                              <form action="./{{$pesanan->pesanan->id}}/serahkan" method="POST">
                              <div class="input-group mb-3">
                                <input type="text" name="jumlah" class="form-control"  value="{{$pesanan->pesanan->jumlah-$pesanan->pesanan->diterima}}">
                                  <div class="input-group-append">
                                    <button class="btn btn-sm btn-primary" id="basic-addon2"><i class="fas fa-check"></i></button>
                                  </div>
                                </div>
                              </td>
                              @csrf
                              @method('post')
                              </form>
                              @else
                              <a><span class="badge badge-primary">Packing</span></a></td>
                              @endif
                              @endif
                              @else
                              <a><span class="badge badge-primary">Sudah Diterima</span></a>
                              @endif
                              </td>

                               

                            </tr>
                            @endforeach
                    <tr>
                      <td></td>
                      <td>Jumlah</td>
                    <td>{{$sesi->jumlah}}</td>
                    <td>Rp.{{number_format($sesi->harga)}}</td>
                    </tr>
                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="5">
                              <a href="./selesai" class="btn btn-primary ">Sesi Selesai</a>
                            </td>
                          </tr>
                        </tfoot>
                        </table>
                    </div>
                </div>   
        </div>
        <div class="col-xl-5  ">
            <div class="card">
                <div class="card-header">
                Karyawan
            </div>
                    <div class="card-body">
                            <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($karyawan as $k)                                
                            <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$k->karyawan->nama}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>   
        </div>
    </div>
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
  <div class="card-header">
    Pemakaian
  </div>
  <div class="card-body">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Kuantitas</th>
          <th scope="col">Harga</th>
        </tr>
      </thead>
      <tbody>
        @if($bahan!=null)
        @foreach ($bahan as $b)
        @foreach ($pemakaian[$b->biaya_produksi_id] as $pakai)
          <tr>
            <td>
              {{($pakai['nama'])}}
            </td>
            <td>
              {{array_sum($kuantitas[$b->biaya_produksi_id."_".$pakai['harga']]['jumlah'])}}
            </td>
            <td>
              {{number_format(array_sum($kuantitas[$b->biaya_produksi_id."_".$pakai['harga']]['harga']))}}

            </td>
            
            {{-- <td>
              {{$b->biaya_produksi->nama}}(Rp.{{number_format($pakai['harga_satuan'])}})
          </td>
            <td>
{{$kuantias[$b->biaya_produksi_id."_".$pakai['harga_satuan']]}}
            </td> --}}
              {{-- Rp.{{number_format(array_sum($pakai['harga']))}} --}}
          </tr>
        @endforeach
        @endforeach
        @endif

        {{-- @foreach ($sesi->buat_produk as $buat)
            @foreach ($buat->pemakaian as $pemakaian)
          <tr>
            <td>{{$pemakaian->belanja->biaya_produksi->nama}}(
            Rp.{{number_format($pemakaian->belanja->harga_satuan)}})</td>
            <td>{{$pemakaian->where(['belanja_id'=>$pemakaian->belanja_id,'sesi_id'=>$sesi->id])->sum('jumlah')}} {{$pemakaian->belanja->biaya_produksi->satuan->nama}}</td>
          <td>Rp.{{number_format($pemakaian->belanja->where('id',$pemakaian->belanja_id)->first()->harga_satuan * $pemakaian->j)}}</td>
          </tr>
          @endforeach
        @endforeach --}}
      </tbody>
      <tfoot>
        <tr>
        <td colspan='2'></td>
        <td>{{"Rp.".number_format($sesi->pemakaian->sum('harga'))}}</td>
        </tr>
      </foot>
    </table>
  </div>
</div>
        
      </div>
    </div>
    @endsection