@extends('layouts.master')
@section('top-main')
    

@endsection
@section('main')

<div class="container">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

    <h1 class="h3 mb-3  text-gray-800">Gudang</h1>


            </div>
                        <nav class="mb-2">
                              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link o active" >Gudang</a>
                                <a class="nav-item nav-link text-inf" href="/belanja">Belanja</a>
                                <a class="nav-item nav-link text-inf " href="/pengeluaran">Pengeluaran</a>
                                <a class="nav-item nav-link text-inf" href="belanja/histori">Histori Belanja</a>
                                <a class="nav-item nav-link text-inf" href="pengeluaran/histori">Histori pengeluaran</a>
                                <a class="nav-item nav-link text-inf " href="/belanja/hutang"   >Hutang Pembelanjaan</a>
                                {{-- <a class="nav-item nav-link" id="nav-contact-tab" >Contact</a> --}}
                              </div>
                            </nav>
        <div class="row">
              {{-- <div class="col-xl-4 col-md-4 mb-4">
              <div class="card border-left-warning   shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning  text-uppercase mb-1">Modal</div>
                    </div>
                    <img class="" style="width:95px; position:absolute; bottom: 4px;  right: 10px;"  src="{{asset('unDraw/undraw_personal_finance_tqcd.svg')}}">               
                    
                </div>
            </div>
        </div>
    </div> --}}
    {{-- <div class="h5 mb-0 font-weight-bold text-gray-800">{{$karyawan->count()}} Orang</div> --}}
        </div>

        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="card shadow mb-4">
                    <div  class="card-header py-3 d-flex bg-success flex-row align-items-center justify-content-between"
                    >
                        <h6 class="m-0 font-weight-bold text-white">
                             Barang Di gudang
                        </h6>
                       
                    </div>

                    <div class="card-body">
                        
                        <div class="table-responsive">
                                        <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Barang</th>
                                                            <th>Harga </th>
                                                            <th>Tersedia</th>
                                                            {{-- <th>Jumlah Baku</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($gudang as $g)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                        <td><a href="/gudang/{{$g->id}}/detail">
                                                            {{$g->nama}}</a></td>      
                                                        <td>{{"Rp.".number_format($g->total_harga())}}</td>
                                                        <td>{{$g->tersedia()." ".$g->satuan->nama}}</td>
                                                        {{-- <td>{{$g->belanja->where('biaya_produksi_id',$g->id)->sum('tersedia')." ".$g->satuan->nama}}</td>       --}}
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-12">
                <div class="card shadow mb-4">
                    <div  class="card-header py-3 d-flex bg-success flex-row align-items-center justify-content-between"
                    >
                        <h6 class="m-0 font-weight-bold text-white">
                              Barang gudang
                        </h6>
                       
                    </div>

                    <div class="card-body">
                        
                        <div class="table-responsive">
                            <table class="table table-hover">
                                @if($produksi==null)
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Barang</th>
                                                            <th>Tersedia</th>
                                                            {{-- <th>Jumlah Baku</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <form
                                                        action="/gudang/store" method="POST"
                                                        class="input-group mb-3"
                                                        >
                                                        @csrf
                                                        <div class="input-group">
                                                         
                                                          <select name="produksi" class="form-control">
                                                              @foreach ($produksi->where('gudang',false) as $p)
                                                                  
                                                          <option value="{{$p->id}}">{{$p->nama}}</option>
                                                              @endforeach
                                                          </select>
                                                         
                                                               <div class="input-group-append ">
                                                                <button class="btn btn-sm  btn-success">Tambah</button>
                                                            </div>
                                                        </div>
                                                </form>
                                            </tbody>
                                            @endif
                                            </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        <!-- Button trigger modal -->

        <!-- Modal -->
        
    </div>
@endsection

@section('script')
 
@endsection
