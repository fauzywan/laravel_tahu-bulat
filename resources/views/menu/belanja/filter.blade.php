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
                <i class="float-right fas fa-filter" id="fillters" style="cursor:pointer"></i>
                Histori Pembelanjaan 
            </div>
            <div class="card-body">
                <form class="card" action="./filter" method="POST">
                    @csrf
                    <div class="container mb-3">

                    <div class="row filter-area">
                        <div class="col-xl-6">

                            
                            <div class="form-group">
                                <label for="mulai">Mulai</label>
                            <input type="date" class="form-control" di="mulai"name="mulai" value="{{date('Y-m-d',strtotime($mulai))}}">
                            </div>
                        </div>
                        <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="sampai">Sampai</label>
                                        <input type="date" class="form-control" id="sampai"name="sampai"  value="{{date('Y-m-d',strtotime($sampai))}}">
                                    </div>

                        </div>
                            <div class="row">
                                <div class="col-xl-12">
                                    
                                    <button type="submit" class="btn btn-primary">filter</button>
                                    <a href="./histori" class="btn btn-submit">Refresh</a>
                                </div>
                            </div>
                    </div>
                </div>
            </form>

                @foreach ($tanggal as $t)       
                <p style="border-bottom: 1px solid rgb(230, 229, 229)">
                    <a class="-info" data-toggle="collapse"  href="#collapose{{$loop->iteration}}" role="button" aria-expanded="false" aria-controls="collapose{{$loop->iteration}}">
                      {{date('d F Y',strtotime($t->created_at))}}
                      <i class="fas fa-plus float-right ml-3"></i>
                    <i style="float:right" >Rp.{{$t->where('created_at',date('Y-m-d',strtotime($t->created_at)))->sum('harga')}}</i>
                    </a>
                  </p>
                  <div class="collapse" id="collapose{{$loop->iteration}}">
                        <div class="card card-body row table-responsive">

                       @foreach ($t->distinct()->where('created_at',date('Y-m-d',strtotime($t->created_at)))->get('nomor_faktur') as $faktur)
                       <p style="border-bottom: 1px solid rgb(230, 229, 229)">
                    <a class="-info" data-toggle="collapse"  href="#collapose{{$faktur->nomor_faktur}}" role="button" aria-expanded="false" aria-controls="collapose{{$faktur->nomor_faktur}}">
                      Nomor Faktur {{$faktur->nomor_faktur}}
                      <i class="fas fa-plus float-right ml-3"></i>
                    <i style="float:right" >Rp.{{ number_format($faktur->where('nomor_faktur',$faktur->nomor_faktur)->sum('harga'))}}</i>
                                
                    </a>
                  </p> 
                   <div class="collapse" id="collapose{{$faktur->nomor_faktur}}">
                    <div class=" card-body row table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                    <th>Suplier</th>
                                    <th>barang</th>
                                    <th>Kuantitas</th>
                                    <th>harga Satuan</th>
                                    <th>Total Harga</th>

                            </tr>
                            @foreach ($faktur->where('nomor_faktur',$faktur->nomor_faktur)->get() as $barang)
                                  <tr>
                                   
                                    <td>{{$barang->suplier->nama}}</td>
                                    <td>{{$barang->gudang->biaya_produksi->nama}}</td>
                                    <td>{{$barang->kuantitas." ".$barang->gudang->biaya_produksi->satuan->nama}}</td>
                                    <td>Rp.{{number_format($barang->harga_satuan)}}</td>
                                    <td>Rp.{{number_format($barang->harga)}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4">Total</td>
                                <td>Rp.{{ number_format($faktur->where('nomor_faktur',$faktur->nomor_faktur)->sum('harga'))}}</td>
                            </tr>
                        </table>

                    </div>
                </div>
                       @endforeach
                        </div>

                  </div>
                  @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    
<script>
    const filter=document.getElementById('fillters');
    filter.addEventListener('click',function(){
            document.querySelector('.filter-area').classList.toggle('hidden')
        
    })
</script>
@endsection
