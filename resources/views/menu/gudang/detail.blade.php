@extends('layouts.master')
@section('navbar')
    <a href="/gudang" class="text-decoration-none">
        <i class=" btn-circle fas fa-arrow-left"></i>Back    
    </a>
@endsection
@section('main')

<div class="row">
    <div class="col-xl-4  col-md-5">
        <div class="card" style="width: 18rem;">
  {{-- <img src="..." class="card-img-top" alt="..."> --}}
  <div class="card-body">
    <h5 class="card-title">{{$gudang->nama}}</h5>
  <small class="card-text">Bahan Baku</small>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Tersedia :{{$gudang->tersedia()}} {{Str::lower($gudang->satuan->nama)}}</li>
    <li class="list-group-item">Total :Rp.{{number_format($gudang->total_harga())}}</li>
    {{-- <li class="list-group-item"></li> --}}
  </ul>
  <div class="card-body">
    {{-- <a href="#" class="card-link">Card link</a>
    <a href="#" class="card-link">Another link</a> --}}
  </div>
</div>
    </div>
   
<div class="col-xl-8 col-md-5">
            <div class="card">
  <h5 class="card-header">Detail Ketersediaan</h5>
  <div class="card-body">
    
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
      
      @foreach ($gudang->belanja->where('status',1) as $g)
      <tr>
      <td>{{$loop->iteration}}</td>
          <td>{{$g->suplier->nama}}</td>
      <td>{{$g->kuantitas}} {{$g->biaya_produksi->satuan->nama}}</td>
      <td>Rp.{{number_format($g->harga_satuan)}}</td>
      <td>Rp.{{number_format($g->harga)}}</td>
    </tr>
        @endforeach

  </tbody>
</table>
</div>

  </div>
</div>
</div>

<div class="row">
    <div class="col-xl-4"></div>
<div class="col-xl-8">
       <div class="card">
  <h5 class="card-header">Pemakaian</h5>
  <div class="card-body">
    
    <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Kuantitas</th>
      <th scope="col">Tanggal</th>
      <th scope="col">kuantitas</th>
      <th scope="col">Harga</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($gudang->belanja->where('status',1) as $g)
        @foreach ($g->pemakaian as $p)
            <tr>
            <td>{{$p->karyawan}}</td>
            <td>{{$p->tanggal}}</td>
            </tr>
        @endforeach
        @endforeach

  </tbody>
</table>
</div>

  </div>
</div>
</div>

@endsection