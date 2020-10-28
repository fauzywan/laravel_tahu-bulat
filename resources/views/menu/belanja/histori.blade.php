@extends('layouts.master')
@section('navbar')
    <a href="/belanja">
        <i class=" btn-circle fas fa-arrow-left"></i>Back    
    </a>
@endsection
@section('top-main')
  <nav class="mb-2">
                              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link o" href="/gudang">Gudang</a>
                                <a class="nav-item nav-link text-inf " href="/belanja">Belanja</a>
                                <a class="nav-item nav-link text-inf active">Histori Belanja</a>
                                <a class="nav-item nav-link text-inf " href="/belanja/hutang"   >Hutang Pembelanjaan</a>
                                {{-- <a class="nav-item nav-link" id="nav-contact-tab" >Contact</a> --}}
                              </div>
                            </nav>
@endsection
@section('main')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header bg-success text-white" >
                Histori Pembelanjaan
            </div>
            <div class="card-body">
                @foreach ($tanggal as $t)       
                <p style="border-bottom: 1px solid rgb(230, 229, 229)">
                    <a class="-info" data-toggle="collapse"  href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                      {{date('d F Y',strtotime($t->created_at))}}
                        <i class="fas fa-plus float-right"></i>
                    </a>
                  </p>
                  <div class="collapse" id="collapseExample">
                        <div class="card card-body row table-responsive">

                        <div class="col-xl-12 col-md-12 col-xs-12">
                        <table class="table  table-bordered">
                            <thead>
                                <tr>    <td>#</td>
                                    <td>Suplier</td>
                                    <td>Pembelanjaan</td>
                                    <td>Kuantitas</td>
                                    <td>Harga Satuan</td>
                                    <td>Total Harga</td>
                                </thead>
                            </tr>
                            
                            <tbody>
                                {{-- @foreach ($t->where('created_at',date('Y-m-d',strtotime($t->created_at))) as $ta) --}}
                                
                                @foreach ($t->where('created_at',date('Y-m-d',strtotime($t->created_at)))->get() as $t)
                                <tr>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>{{$t->suplier->nama}}</td>
                                    <td>{{$t->gudang->biaya_produksi->nama}}</td>
                                    <td>{{$t->kuantitas." ".$t->gudang->biaya_produksi->satuan->nama}}</td>
                                    <td>Rp.{{number_format($t->harga_satuan)}}</td>
                                    <td>Rp.{{number_format($t->harga)}}</td>
                                </tr>
                                @endforeach
                            <tr>
                                <td colspan="5"><h4 class="float-right">Total</h4></td>
                                <td>
                                    <h4>
                                        Rp.{{number_format($t->where('created_at',date('Y-m-d',strtotime($t->created_at)))->get()->sum('harga'))}}
                                    </h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                        </div>

                  </div>
                  @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
@section('main')
<div class="row">  
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="widget-tabs-int tab-ctm-wp ">
                <div class="tab-hd">
                    <div class="breadcomb-wp">
                        <div class="breadcomb-icon">
                            <a href="/belanja"><i class="notika-icon notika-edit"></i></a>
                        </div>
                        <div class="breadcomb-ctn">
                            <h2>Riwayat Pembelanjaan</h2>
                        </div>
                    </div>
                </div>
            <div class="widget-tabs-list">    
                            <ul class="nav nav-tabs tab-nav-right">
                                <li class=""><a  href="/gudang">Gudang</a></li>
                                <li class=""><a href="/belanja">Belanja</a></li>
                                <li class="active"style="float: left"><a href="/belanja/histori" >Riwayat Pembelanjan</a></li>
                            </ul>
                <div class="tab-content tab-custom-st tab-ctn-right">
                    <div id="home2" class="tab-pane fade in active">
                        @foreach ($tanggal as $t)                                       
                        <div class="accordion-stn sm-res-mg-t-30">
                            <div class="panel-group" data-collapse-color="nk-green" id="accordionRed" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-collapse notika-accrodion-cus">
                                        <div class="panel-heading" role="tab">
                                            <h4 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordionGreen" href="#accordionGreen-{{$loop->iteration}}" aria-expanded="false">
                                                        {{date('d F Y',strtotime($t->created_at))}}
                                                    </a>
                                            </h4>
                                        </div>
                                        <div id="accordionGreen-{{$loop->iteration}}" class="collapse" role="tabpanel">
                                            <div class="panel-body">
                                                <table class="table table-cl">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>barang</th>
                                                            <th>Suplier</th>
                                                            <th>kuantitas</th>
                                                            <th>Harga satuan</th>
                                                            <th>Harga</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($t->where('created_at',date('y-m-d',strtotime($t->created_at)))->get() as $data)
                                                        <tr class="{{$data->hutang==true?'success':'active'}}">
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$data->gudang->biaya_produksi->nama}}</td>
                                                        <td>{{$data->suplier->nama}}</td>
                                                        <td>{{$data->kuantitas}}</td>
                                                        <td>{{"Rp.".number_format($data->harga_satuan)}}</td>
                                                        <td>{{"Rp.".number_format($data->harga)}}</td>
                                                        
                                                        </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td colspan="4"></td>
                                                            <td><b>Total</b></td>
                                                        <td>{{"Rp.".(number_format($t->where('created_at',date('y-m-d',strtotime($t->created_at)))->sum('harga')))}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                        </div>
                                    </div>
                            </div>   
                            </div>
                         </div>                            
                        @endforeach
                    </div>                            
                </div>
            </div>
        </div>        
   </div>    
</div>
@endsection