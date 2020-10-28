@extends('layouts.master')
@section('top-main')
                <div id="alert"></div>
    
@endsection
@section('main')
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 ">
        <div class="add-todo-list notika-shadow mg-t-30">
            <div class="realtime-ctn">
                <div class="realtime-title">
                    <h2>Harga Produk Satuan</h2>
                </div>
            </div>
            <div class="card-box">
                <div class="todoapp">      
                    <div id="todo-form">
                        <div class="row">     
                            <div class="col-sm-12 col-md-12 col-sm-12 col-xs-12 todo-inputbar">
                                        <div class="form-group todo-flex">               
                                        <input type="text" autocomplete="off" id="harga"  class="form-control" placeholder="Add new todo" value="{{$produk->harga}}">
                                        <button class="btn btn-primary" id="harga_btn" style="border-radius:0 10% 10% 0">Atur</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 ">
        <div class="add-todo-list notika-shadow mg-t-30">
            <div class="realtime-ctn">
                <div class="realtime-title">
                    <h2>Jumlah  Produk Peradonan</h2>
                </div>
            </div>
            <div class="card-box">
                <div class="todoapp">      
                    <div id="todo-form">
                        <div class="row">                   
                            <div class="col-sm-12 col-md-12 col-sm-12 col-xs-12 todo-inputbar">
                                        <div class="form-group todo-flex">               
                                        <input type="text" autocomplete="off" id="jumlah"    class="form-control" placeholder="Add new todo" value="{{$produk->jumlah}}">
                                        <button class="btn btn-primary" id="jumlah_btn" style="border-radius:0 10% 10% 0">Atur</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
</div>
<div class="row mg-tb-30">
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
                            <td class="jumlah_baku_{{$bahan->id}}">{{$bahan->kuantitas." ".$bahan->satuan->nama}}</td>
                        </tr>
                        <tr id="next_jumlah_baku"></tr>
                        @endif
                        @endforeach
                        <tr id="next_jumlah"></tr>
                        </tbody>
                        <tfoot>
                            {{-- {{dd($biaya_produksi-)}} --}}
                        {{-- <form action="/produksi/baku" method="POST">
                            @csrf --}}
                            <tr>
                                <td></td>
                                <td>
                                    <select name="bahan"  id="jumlah_baku"class="form-control">
                                        
                                        @foreach ($biaya_produksi as $biaya)
                                        <option value="{{$biaya->id}}">{{$biaya->nama}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="text" autocomplete="off" name="kuantitas" id="kuantitas_jumlah_baku" class="form-control" ></td>
                                <td><button class=" btn btn-primary" id="jumlah_baku_btn">Atur</button></td>
                            </tr>
                        {{-- </form> --}}
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="normal-table-list">
            <div class="basic-tb-hd">
                <h2>Bahan Baku Adonan</h2>
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
                        @foreach ($adonan as $a)
                    <tr>
                            <td>1</td>
                    <td class="bahan_baku_{{$a->biaya_produksi->id}}">{{$a->biaya_produksi->nama}}</td>
                        <td>{{$a->kuantitas." ".$a->biaya_produksi->satuan->nama}}</td>                      
                    </tr>
                        @endforeach
                        <tr id="next_bahan"></tr>
                    </tbody>
                    <tfoot>
                        {{-- {{dd($biaya_produksi-)}} --}}      
                    {{-- <form action="/pengaturan/bahan" method="POST"> --}}
                        {{-- @csrf --}}
                        <tr>
                            <td></td>
                            <td>
                                <select name="bahan"  id="bahan_baku"class="form-control">                            
                                    @foreach ($biaya_produksi as $biaya)
                                    <option value="{{$biaya->id}}">{{$biaya->nama}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="text" autocomplete="off" name="kuantitas" id="kuantitas_bahan_baku" class="form-control" ></td>
                            <td><button class=" btn btn-primary " id="bahan_baku_btn">Atur</button></td>
                        </tr>
                    {{-- </form> --}}
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
                @endsection
            @section('script')
                <script>
                    document.getElementById('bahan_baku_btn').addEventListener('click',function(){
                        fetch(`/api/pengaturan/${document.getElementById('bahan_baku').value>0?document.getElementById('bahan_baku').value:0}/${document.getElementById('kuantitas_bahan_baku').value>0?document.getElementById('kuantitas_bahan_baku').value:0}/bahan`)
                        .then(data=>data.json())
                    .then(data=>{
                        if(data.status==1)
                        {
                              
                            document.getElementById('next_bahan').innerHTML=`<tr>
                                <td>${document.getElementById('next_bahan').parentElement.querySelectorAll('tr').length}</td>
                                <td class="bahan_baku_${document.getElementById('bahan_baku').value}">${data.bahan}</td>
                                <td>${data.jumlah}</td>
                                </tr>`
                                document.getElementById('next_bahan').id="before_"
                    document.getElementById('before_').parentNode.insertRow().id="next_bahan";
                    document.getElementById('before_').removeAttribute('id')
                            }else{
                              document.querySelector(`.bahan_baku_${document.getElementById('bahan_baku').value}`).parentNode.children[2].textContent=data.jumlah

                            }
                         

                       
                    }
                        )
})
                    document.getElementById('jumlah_baku_btn').addEventListener('click',function(){
                        fetch(`/api/pengaturan/${document.getElementById('jumlah_baku').value>0?document.getElementById('jumlah_baku').value:0}/${document.getElementById('kuantitas_jumlah_baku').value>0?document.getElementById('kuantitas_jumlah_baku').value:0}/jumlah`)
                        .then(data=>data.json())
                    .then(data=>{
                        if(data.status>0)
                        {
                            if(document.querySelector(`.jumlah_baku_${document.getElementById('jumlah_baku').value}`)==null){
                                document.getElementById('next_jumlah_baku').innerHTML=`
                                <tr>
                                <td>${document.getElementById('next_jumlah_baku').parentElement.querySelectorAll('tr').length-1}</td>
                            <td>${data.bahan}</td>
                            <td class="jumlah_baku_${document.getElementById('jumlah_baku').value}">${data.jumlah}</td>
                        </tr>`
                        document.getElementById('next_jumlah_baku').id="next_jmlh";
                        document.getElementById('next_jmlh').parentNode.insertRow().id="next_jumlah_baku"
                         document.getElementById('next_jmlh').removeAttribute('id')
                            }
                                document.querySelector(`.jumlah_baku_${document.getElementById('jumlah_baku').value}`).textContent=data.jumlah
                           

                        }else{
                               
                            if(document.querySelector(`.jumlah_baku_${document.getElementById('jumlah_baku').value}`)!=null){
                            document.querySelector(`.jumlah_baku_${document.getElementById('jumlah_baku').value}`).parentElement.remove();

                            }

                        }
                    }
                        )
})
                    document.getElementById('jumlah_btn').addEventListener('click',function(){
                        fetch(`/api/sotong/${document.getElementById('jumlah').value}/jumlah`)
                        .then(data=>data.json())
                    .then(data=>{
                        document.getElementById('jumlah').value=data
                        document.getElementById('alert').innerHTML=`<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="notika-icon notika-close"></i></span></button>Harga Satuam Sotong Telah diubah
                            </div>`
                    }
                        )
})
                    document.getElementById('harga_btn').addEventListener('click',function(){
                        fetch(`/api/sotong/${document.getElementById('harga').value}/harga`)
                        .then(data=>data.json())
                    .then(data=>{
                                               document.getElementById('harga').value=data

                        document.getElementById('alert').innerHTML=`<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="notika-icon notika-close"></i></span></button>Harga Satuam Sotong Telah diubah
                            </div>`
                    }
                        )
})

                </script>
            @endsection