@extends('layouts.master')

@section('top-main')
<h1 class="h3 mb-3   text-gray-800">Biaya Produksi</h1>

<nav class="mb-2">
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link text-primary" href="/karyawan"  >Karyawan</a>
    <a class="nav-item nav-link active"   >Biaya Produksi</a>
    <a class="nav-item nav-link text-primary" href="/suplier"  >Suplier</a>
    <a class="nav-item nav-link text-primary" href="/distributor">Konsumen</a>
    {{-- <a class="nav-item nav-link" id="nav-contact-tab" >Contact</a> --}}
  </div>
</nav>


        
      {{-- <div class="row">
          <div class="col-xl-4 col-md-4 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Bahan Baku</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                    </div>
                    <img class="" style="width:90px; position:absolute; bottom: 0;  right: 10px;"  src="{{asset('unDraw/undraw_personal_finance_tqcd.svg')}}">               

                  </div>
                </div>
              </div>
            </div>
          <div class="col-xl-4 col-md-4 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Biaya Operasional</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.</div>
                    </div>
                    
                        
                        <img class="" style="width: 100px;  " src="{{asset('unDraw/undraw_payments_21w6.svg')}}">               
                  </div>
                </div>
              </div>
            </div>
      </div> --}}
@endsection  
@section('main')

<div class="row">

  <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 mg-t-30">
<div class="card">
  <div class="card-header bg-success text-white">
    Biaya Produksi
  </div>

  <div class="card-body">

    <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Daftar</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Tambah</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">   <div class="bsc-tbl-hvr">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Uraian</th>
                        <th>Volume</th>
                        <th>Satuan</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody id="disini">
                    @foreach ($produksi as $p)            
                    <tr >
                    <td>{{$loop->iteration}}</td>
                    <td><a href="/produksi/{{$p->id}}/detail">{{Str::ucfirst(Str::lower($p->nama))}}</a       ></td>
                    <td>{{$p->kuantitas}}</td>
                    <td>{{isset($p->satuan->nama)?$p->satuan->nama:''}}</td>
                    <td><a href="/produksi/{{$p->id}}/delete" class="badge badge-danger"><i class="fas fa-fw fa-trash"></i></a></td>        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div></div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <form action="/produksi/store" method="POST" class=" ">
                                @method('post')
                                @csrf
                                <div class="form-group">
                                            <div class="row mb-3 mt-3">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Jenis</label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <select  class="form-control " name="jenis" >
                                                <option value="1">Bahan Baku</option>
                                                <option value="2">Biaya Operasional</option>
                                                <option value="3">Lainnya</option>
                                                </select>
                                        </div>
                                    </div>   
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Nama</label>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" class="form-control" name="nama" placeholder="Nama">
                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                               <select name="satuan" id="" class="form-control input-sm">
                                                   @foreach ($satuan as $s)
                                               <option value="{{$s->id}}">{{$s->nama}}</option>
                                                   @endforeach
                                               </select>
                                        </div>                                        
                                    </div>
                                    {{-- <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Jumlah Baku</label>
                                            <span class="edit"></span>
                                            
                                        </div>  
                              
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" name="kuantitas" placeholder="Jumlah baku barang">
                                            </div>
                                        </div>
                                  
                                    </div>     --}}
                                </div>                    
                        <div class="form-example-int mg-t-15">
                            <div class="row">
                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                    <button  type="submit" class="btn btn-success notika-btn-success waves-effect">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>            
             </div>
           </div>
           </div>
  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 mg-t-30">

<div class="card">
  <div class="card-header bg-success text-white">
     Satuan
  </div>
  <div class="card-body">
      
    <form action="/satuan/store" method="POST"  class="input-group mb-3">
                        @csrf
                            <input
                            autocomplete="off"   
                            type="text"
                                class="form-control"
                                placeholder="satuan"
                                name="nama">
                            <div class="input-group-append">
                                <button
                                    class="btn btn-sm btn-success"
                                >
                                    Tambah
                                </button>
                            </div>
                        </form>
  <div class="bsc-tbl-hvr">
                       <table class="table table-hover">
                           <thead>
                               <tr>
                                   <th>#</th>
                                   <th>Satuan</th>
                                   <th>Opsi</th>
                               </tr>
                           </thead>
                           <tbody>
                               @foreach ($satuan as $s)            
                               <tr>
                               <td>{{$loop->iteration}}</td>
                               <td>{{$s->nama}}</td>
                               <td><a href="/satuan/{{$s->id}}/delete" class="badge badge-danger"><i class="fas fa-fw fa-trash"></i></a></td>            
                               </tr>
                               @endforeach
                           </tbody>
                       </table>
                    </div>
  </div>
</div>
</div>
    
</div>

@endsection                

@section('script')
    {{-- <script src="{{ asset('js/mine/produksi.js') }}"></script> --}}
@endsection