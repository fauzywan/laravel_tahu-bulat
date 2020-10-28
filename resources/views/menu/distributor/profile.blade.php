@extends('layouts.master')
@section('navbar')
    <a href="./distributor">
        <i class=" btn-circle fas fa-arrow-left"></i>Back    
    </a>
@endsection
@section('top-main')
    {{-- <div class="row">
        <div class="col-xl-4 col-md-4 col-sm-12 col-xs-12 mb-3">
              <div class="card border-left-danger   shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Hutang Pada distributor</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.{{number_format($hutang)}} </div>
                    </div>
                    <img class="" style="width:120px; position:absolute; bottom: -3px;  right: 0px;"  src="{{asset('unDraw/undraw_successful_purchase_uyin.svg')}}">               

                  </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
@section('main')
<div class="row">
    
    <div class="col-6">
        <div class="card">
      <div class="card-header">
        Profile
    </div>
<form class="card-body"method="POST" action="/distributor/{{$distributor->id}}/update">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Konsumen </label>
                        <input type="text" name="nama" class="form-control" id="pemilik" value="{{$distributor->nama}}" >
                           
                        </div>

                    </div>
                </div>
                @method('put')

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Pemilik </label>
                        <input type="text" name="pemilik" class="form-control" id="pemilik" value="{{$distributor->pemilik}}" >
                           
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nomor Telepon</label>
                        <input type="text"name="telepon" class="form-control" id="nomor" value="{{$distributor->telepon}}">     
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Alamat</label>
                    <textarea class="
                    form-control" name="alamat" id="" cols="50" rows="3">{{$distributor->alamat}}</textarea>
                    </div>
                </div>
            </div>
                    <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
     <div class="col-6 ">
        <div class="card">
      <div class="card-header">
        Hutang Perusahaan
      </div>
      <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Nominal Uang</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($distributor->belanja->where('hutang',1) as $r)
                            
                        <tr>
                            <th scope="row">1</th>
                            <td>{{date('d F Y',strtotime($r->created_at))}}</td>
                            <td>{{$r->harga-($r->transaksi_belanja->sum('nominal_uang'))}}</td>
                        </tr>
                        @endforeach
<tr>
    <td colspan="2">Jumlah</td>
<td>Rp.{{number_format($hutang)}}</td>
</tr>
                    </tbody>
                </table>
          </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
      <div class="card-header">
        RIwayat Pembelanjaa
      </div>
      <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Kuantitas</th>
                        <th scope="col">Harga</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($distributor->belanja as $r)
                            
                        <tr>
                            <th scope="row">1</th>
                            <td>{{date('d F Y',strtotime($r->created_at))}}</td>
                            <td>{{$r->kuantitas}}</td>
                            <td>{{$r->harga}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                    <tr>
                        <td colspan="2">Total</td>
                    <td>{{$distributor->belanja->sum('kuantitas')}}</td>
                    <td>{{$distributor->belanja->sum('harga')}}</td>
                    </tr>
                </table>
          </div>
        </div>
    </div>

</div>
    
@endsection