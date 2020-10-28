@extends('layouts.master')

@section('top-main')
<div class="header">
  <h2>Laporan</h2>
</div>

   <div class="row mt-3" >
               <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-success   shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Tanggal</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{date('d F Y',strtotime($tanggal))}} </div>
                    </div>
                    <img class="" style="width:120px; position:absolute; bottom: -3px;  right: 0px;"  src="{{asset('unDraw/undraw_successful_purchase_uyin.svg')}}">               

                  </div>
                </div>
              </div>
            </div>
               <div class="col-xl-4 col-md-6 mb-4"id="lunasi">
              <div class="card border-left-primary   shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" >Jumlah Pesanan</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="dibayar">{{($pesanan->count())}} Order</div>
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
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Harga</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.{{number_format($uang['total'])}}</div>
                    </div>
                    <img class="" style="width:120px; position:absolute; bottom: 0;  right: 10px;"  src="{{asset('unDraw/2.svg')}}">               
                  </div>
                </div>
              </div>
            </div>

          </div>    
@endsection
@section('main')
              <form action="/laporan/filter" method="POST">

    <div class="row">
        <div class="col-xl-12">

        <div class="card">
            <div class="card-header">Tanggal</div>
            <div class="card-body">
                <div class="row">
@csrf
                <div class="col-xl-6">
                    <div class="input-group">
                        <input type="date" name="mulai" class="form-control" value="{{$pengaturan_tanggal->mulai}}">
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="input-group">
                        <input type="date" name="tutup" class="form-control" value="{{$pengaturan_tanggal->tutup}}">
                        <div class="input-group-append">

                          <button class="btn btn-primary"><i class="fas fa-check"></i></button>
                        </div>
                    </div>
                </div>
              </div>
              
              
        </div>
    </div>
</div>
    </div>
</form>



<div class="row">
  <div class="col-xl-8">
    <div class="card">
          <div class="card-header bg-success text-white">
      Daftar Pesanan
    </div>
        <div class="card-body">
                  <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Pemesan</th>
                    <th scope="col">Jumlah Orderan</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($pesanan as $p)
                  <tr>
                  <th scope="row">{{$loop->iteration}}</th>
                  <td>{{$p->distributor->nama}}</td>
                  <td>{{$p->jumlah}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-xl-4">
          <div class="card">
            <div class="card-header bg-success text-white">
              Detail
            </div>
            <div class="card-body">
              <table>
                <tr>
                  <td>
                    <ul style="list-style:none;">
                      <li><h5>Order</h5></li>
                      <li>{{$pesanan->sum('jumlah')}}</li>
                    </ul>
                  </td>
                  <td>
                    <ul style="list-style:none;">
                      <li><h5>Baloan</h5></li>
                      <li>{{$uang['baloan']}}</li>
                    </ul>
                  </td>
                </tr>
                <tr>
                  <td>
                    <ul style="list-style:none;">
                      <li><h5>Rata - Rata</h5></li>
                      <li>{{$uang['rata_rata']}}</li>
                    </ul>
                  </td>
                </tr>
                <tr>
                           <td>
                    <ul style="list-style:none;">
                      <li><h5>Pemakaian</h5></li>
                      <li>Rp.{{number_format($uang['pemakaian'])}}</li>
                    </ul>
                  </td>
                </tr>
                <tr>
                  <td>
                    <ul style="list-style:none;">
                      <li><h5>Uang Masuk</h5></li>
                      <li>Rp.{{number_format($uang['masuk'])}}</li>
                    </ul>
                  </td>
                  <td>
                    <ul style="list-style:none;">
                      <li><h5>Uang Diluar</h5></li>
                      <li>Rp.{{number_format($uang['diluar'])}}</li>
                    </ul>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
  <div class="col-xl-8">
    <div class="card">
          <div class="card-header bg-success text-white">
      Daftar Pengeluaran 
    </div>
        <div class="card-body">
                  <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Bahan</th>
                    <th scope="col">Kuantitas</th>
                    <th scope="col">Nominal Uang</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($belanja as $b)
                  <tr>
                  <th scope="row">{{$loop->iteration}}</th>
                  <td>
                    {{$b->biaya_produksi->nama}}
                  </td>
                  <td>
                    {{$b->biaya_produksi->satuan?$b->kuantitas:0}} {{$b->biaya_produksi->satuan?$b->biaya_produksi->satuan->nama:''}}
                  </td>
                  <td>
                    Rp.{{number_format($b->harga)}}
                  </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-xl-4">
          <div class="card">
            <div class="card-header bg-success text-white">
              Detail
            </div>
            <div class="card-body">
              <table>
                <tr>
                  <td>
                    <ul style="list-style:none;">
                      <li><h5>Nominal Uang</h5></li>
                      <li>Rp.{{(number_format($belanja->sum('harga')))}}</li>
                    </ul>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>

@endsection