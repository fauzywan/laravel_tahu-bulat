@extends('layouts.master')
@section('top-main')
                <div id="alert"></div>
    
@endsection
@section('main')
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="add-todo-list notika-shadow mg-t-30">
                        <div class="realtime-ctn">
                            <div class="realtime-title">
                                <h2>Pengaturan Tanggal</h2>
                            </div>
                        </div>
                        <div class="card-box">
                            <div class="todoapp">
                                
                                <div id="todo-form">
                                    @if ($gaji->status==1)
                                    <form class="row" action="/pengaturan/{{$gaji->id}}/gaji" method="POST">
                                        @method('put')
                                        
                                        @else
                                        <form class="row" action="/pengaturan/gaji" method="POST">
                                       
                                        @endif
                                        
                                        @csrf
                                        <p>Tanggal Gajian  </p>
                                        <div class="col-sm-12 col-md-12 col-sm-12 col-xs-12 todo-inputbar">
                                            <div class="form-group todo-flex">               
                                            <input type="date" id="todo-input-text"  value="{{$gaji->tanggal}}" name="tanggal" class="form-control" placeholder="Add new todo">
                                            <button class="btn btn-primary" style="border-radius:0 10% 10% 0">Atur</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 mg-tb-30">
                    <div class="add-todo-list notika-shadow mg-t-30">
                        <div class="realtime-ctn">
                            <div class="realtime-title">
                                <h2>Harga  Sotong Satuan</h2>
                            </div>
                        </div>
                        <div class="card-box">
                            <div class="todoapp">      
                                <div id="todo-form">
                                    <div class="row">
                                        
                                        <div class="col-sm-12 col-md-12 col-sm-12 col-xs-12 todo-inputbar">
                                                    <div class="form-group todo-flex">               
                                                    <input type="text" id="SOTONG"    class="form-control" placeholder="Add new todo" value="{{$harga_satuan}}">
                                                    <button class="btn btn-primary" id="SOTONG_btn" style="border-radius:0 10% 10% 0">Atur</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="normal-table-list">
                                <div class="basic-tb-hd">
                                    <h2>Jumlah Baku Bahan Digudang</h2>
                                </div>
                               
                                <div class="bsc-tbl">
                                    <table class="table table-sc-ex">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Bahan</th>
                                                <th>Jumlah Baku</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($biaya_produksi as $bahan)
                                            @if ($bahan->kuantitas>0)
                                                
                                            <tr>
                                                <td>1</td>
                                            <td>{{$bahan->nama}}</td>
                                            <td>{{$bahan->kuantitas." ".$bahan->satuan->nama}}</td>
                                            
                                        </tr>
                                        @endif
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            {{-- {{dd($biaya_produksi-)}} --}}
                                            
                                        <form action="/produksi/baku" method="POST">
                                            @csrf
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <select name="bahan"  class="form-control">
                                                        
                                                        @foreach ($biaya_produksi as $biaya)
                                                        <option value="{{$biaya->id}}">{{$biaya->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="text" name="kuantitas" class="form-control" id=""></td>
                                                <td><button class=" btn btn-primary ">Atur</button></td>
                                            </tr>
                                        </form>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    {{-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="normal-table-list">
                            <div class="basic-tb-hd">
                                <h2>Jumlah Baku Pembuatan </h2>
                            </div>
                            <label for="">Sotong</label>            
                                    <div class="form-group todo-flex">   
                                        <input type="text" id="Sotong"    class="form-control" placeholder="Add new todo" value="{{$jumlah_baku->sotong==null?'':$jumlah_baku->sotong}}">
                                    <button class="btn btn-primary" id="SOTONG_btn" style="border-radius:0 10% 10% 0">Atur</button>
                                </div>
                            <div class="bsc-tbl">
                                <table class="table table-sc-ex">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Bahan</th>
                                            <th>Jumlah Baku</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        {{-- @if($jumlah_baku!=null)
                                            
                                        @foreach ($jumlah_baku->bahan as $bahan)
                                        <tr>
                                            <td>1</td>
                                            <td>{{$bahan}}</td>
                                        </tr>
                                        @endforeach
                                        @endif --}}
                                    </tbody>
                                    <tfoot>
                                        {{-- {{dd($biaya_produksi-)}} --}}
                                        
                                
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div> 
            </div>
                @endsection
            @section('script')
                <script>
                    document.getElementById('SOTONG_btn').addEventListener('click',function(){
                        fetch(`/api/sotong/${document.getElementById('SOTONG').value}`)
                        .then(data=>data.json())
                    .then(data=>{
                        document.getElementById('SOTONG').value=data.sotong
                        document.getElementById('alert').innerHTML=`<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="notika-icon notika-close"></i></span></button>Harga Satuam Sotong Telah diubah
                            </div>`
                    }
                        )
})
                </script>
            @endsection

            