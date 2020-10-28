@extends('layouts.master')
@section('navbar')
    <a href="/pesanan" class="text-decoration-none">
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
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Tanggal Pesanan</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{date('d F Y',strtotime($pesanan->tanggal))}}</div>
                    </div>
                    <img class="" style="width:120px; position:absolute; bottom: -3px;  right: 0px;"  src="{{asset('unDraw/2.svg')}}">               

                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-primary   shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Harus Dibayar</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.{{number_format($pesanan->harga+$pesanan->biaya_akomodasi)}}</div>
                    </div>
                    <img class="" style="width:120px; position:absolute; bottom: -3px;  right: 0px;"  src="{{asset('unDraw/undraw_Mobile_pay_re_sjb8.svg')}}">               
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-danger   shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Belum Dibayar</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.{{number_format(($pesanan->harga+$pesanan->biaya_akomodasi)-$pesanan->transaksi_pesanan->sum('nominal_uang'))}}</div>
                    </div>
                    <img class="" style="width:120px; position:absolute; bottom: -3px;  right: 0px;"  src="{{asset('unDraw/undraw_credit_card_payment_12va.svg')}}">               
                  </div>
                </div>
              </div>
            </div>
    </div>
@endsection
@section('main')
    <nav class="">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link  active"  data-toggle="collapse" id="col-1"data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Detail</a>
            <a class="nav-item nav-link text-primary collapsed" id="col-2" data-toggle="collapse" data-target="#collapseBayar" aria-expanded="false" aria-controls="collapseBayar">Bayar</a>
        </div>
        </nav>
<div class="accordion" id="accordionExample">
  <div class="card">
    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
        <div class="row ">
          <div class="col-xl-4 col-md-5 " >
            <div class="card" ">
              <div class="card-body">
                <h5 class="card-title">{{$pesanan->distributor->nama}}</h5>
                    @if($pesanan->distributor->alamat!='-')
                    <small class="card-text">{{$pesanan->distributor->alamat}}</small>
                    <br>
                    @endif
                    @if($pesanan->distributor->telepon!='0')
                    <small class="card-text">{{$pesanan->distributor->telepon}}</small>
                    @endif
              </div>
              <div class="table-responsive">

                <table class="table table-stripped">
                  <tr>
                    <td>Status</td>
                    <td>
                      <b>:
                    @if($pesanan->status==1)
                    Belum Dibuat
                    @elseif($pesanan->status==2)
                    Sedang Dibuat
                    @else
                    Sudah Diterima
                    @endif
                    </b>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Jumlah Pesanan :
                    </td>
                    <td>
                      <b>:{{$pesanan->jumlah}} Buah</b>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Harga Satuan 
                      <td>
                        <b>:Rp.{{number_format($pesanan->harga_satuan)}}</b>
                      </td>
                    </td>
                  </tr>
                  <tr>
                    <td>Harga</td>
                    <td>
                       <b>:Rp.{{number_format($pesanan->harga)}}</b>
                    </td>
                  </tr>
                  <tr>
                    <td>Biaya  Akomodasi </td>
                    <td>:<b>Rp.{{number_format($pesanan->biaya_akomodasi)}}</b></td>
                  </tr>
                </table>
              </div>

              </div>
            </div>
            <div class="col-xl-8 col-md-12 col-sm-12 col-xs-12  ">
              <div class="card">
                <h5 class="card-header">Pemakaian Bahan</h5>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Suplier</th>
                        <th scope="col">Kuantitas</th>
                        <th scope="col">Harga Satuan</th>
                        <th scope="col">Harga</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="offset-xl-4 col-xl-8 col-md-12 col-sm-12 col-xs-12 mb-5">
              <div class="card">
                <h5 class="card-header">Transaksi Pesanan</h5>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Nominal uang</th>
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
    </div>
  <div class="card">
    <div id="collapseBayar" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
                      <div class="col-xl-12 col-md-8">
        <div class="card mb-3">
            <div class="card-header bg-success text-white">
                Bayar Pesanan
            </div>
            <div class="card-body">
                <form action="/pesanan/{{$pesanan->id}}/transaksi" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="uang">Nominal Uang</label>
                        <input type="text" class="form-control numberFormat" name="uang" id="uang">
                    </div>
       
                    <div class="form-group">
                        <label for="tanggal">Tanggal Transaksi</label>
                    <input type="date" class="form-control numberFormat" name="tanggal" id="tanggal" value="{{date('Y-m-d')}}">
                    </div>
       
                    <button type="submit" style="float:right" class="btn btn-success">Bayar</button>
                </form><div class="" >

                </div>
            </div>
        </div>
    </div>
      </div>
    </div>
  </div>
  @endsection
  @section('script')
<script src="{{asset('js/mine/rp.js')}}"></script>
      <script>
        document.getElementById('col-1').addEventListener('click',function(){
          if(this.classList[3]!='active'){

this.classList.toggle('active')
document.getElementById('col-2').classList.toggle('active')
          }
        });
        document.getElementById('col-2').addEventListener('click',function(){
this.classList.toggle('active')
document.getElementById('col-1').classList.toggle('active')
        });
      </script>
  @endsection