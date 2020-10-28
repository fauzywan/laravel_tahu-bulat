@extends('layouts.master')
@section('top-main')
        <h1 class="h3 mb-3 text-gray-800"> Hutang</h1>
        <nav class="mb-2">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link text-inf" href="./">Hutang Pembelanjaan</a>
                <a class="nav-item nav-link text-inf active">Pinjam</a>
            </div>
        </nav>
@endsection
@section('main')
    
<div class="row">
    <div class="col-xl-12 col-md-12 col-sm-12 col-xs-12">
        <form  method="POST" action="/peminjaman/store" class="card">
            <div class="card-header bg-primary text-white">
                Peminjaman
            </div>
            <div class="card-body">
          <div class="row">
              <div class="col-xl-4 col-md-4">
@csrf
                  <div class="form-group">
                      <label for="exampleInputPassword1">karyawan</label>
                      <select name="karyawan" class="form-control">
                          @foreach ($karyawan as $k)
                          <option value="{{$k->id}}">{{$k->nama}}</option>
                          @endforeach
                        </select> 
                    </div> 
              </div>
              
              <div class="col-xl-4 col-md-4">
                 <div class="form-group">
                      <label for="exampleInputPassword1">Tanggal Meminjam</label>
                 <input type="date" autocomplete="off" name="tanggal" class="form-control" value="{{date('Y-m-d')}}">
                    </div> 
              </div>
              <div class="col-xl-4 col-md-4">
                 <div class="form-group">
                      <label for="exampleInputPassword1">Nominal Uang</label>
                      <input type="text" autocomplete="off" name="uang" class="form-control numberFormat">
                    </div> 
              </div>
                    <button  class="btn btn-primary">Pinjam</button>
                </div>
            </div>
            
        </form>
    </div>
</div>
@endsection
@section('script')
    <script src="{{ asset('js/mine/rp.js') }}"></script>
@endsection