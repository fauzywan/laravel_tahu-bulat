@extends('layouts.master')
@section('top-main')
                <div id="alert"></div>
    
@endsection
    @section('main')

<div class="container">
    <h2><i class="fas fa-cog"></i> Pengaturan</h2>
</div>
    <ul class="nav nav-tabs">
        <li class="nav-item text-primary">
            <a class="nav-link"data-toggle="collapse" data-target="#One" aria-expanded="true" aria-controls="One">Tanggal </a>
        </li>
        <li class="nav-item text-primary">
            <a class="nav-link"data-toggle="collapse" data-target="#Three" aria-expanded="true" aria-controls="Three">Produk</a>
        </li>
        <li class="nav-item text-primary">
            <a class="nav-link "data-toggle="collapse" data-target="#Two" aria-expanded="true" aria-controls="collapseTwo">Bahan Baku</a>
        </li>
    </ul>

<div class="accordion" id="accordionExample">
  <div class="card">
        <div id="One" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                @if($profil==null || $profil->status==0)
<form action="/pengaturan/mulai" method="POST" class="row">
    <div class="col-xl-6">
        <div class="form-group">
            <labe>Mulai</label>
                <input type="date" name="mulai" class="form-control">
        </div>
    </div>
    <div class="col-xl-6">
        <div class="form-group">
            <labe>Selesai</label>
                <input type="date" name="selesai" class="form-control">
        </div>
    </div>@csrf

    <button type="submit" class="btn btn-primary btn-lg btn-block">Mulai Toko</button>
</form>

@else
<form action="/pengaturan/{{$pengaturan_tanggal->id}}/selesai" method="POST" class="row">
    <div class="col-xl-6">
        <div class="form-group">
            <labe>Mulai</label>
                <h3 class="non-hidden">{{date('d-m-Y ',strtotime($pengaturan_tanggal->mulai))}}</h3>
                <input type="date" class="hidden hiden form-control" name="mulai" value="{{date('Y-m-d', strtotime($pengaturan_tanggal->mulai . ' +1 year'))}}"></h3>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="form-group">
                <label>tutup</label>
                <h3 class="non-hidden">{{date('d-m-Y ',strtotime($pengaturan_tanggal->tutup))}}</h3>
                <input type="date" class="hidden hiden form-control" name="tutup" value="{{date('Y-m-d', strtotime($pengaturan_tanggal->tutup . ' +1 year'))}}"></h3>
            </div>
        </div>
        @csrf
        
        <button type="button" id="atur"  class="non-hidden  btn btn-success btn-lg btn-block">Minggu baru</button>
        @if($profil->status==2)
<button type="button" id="tutup_toko"  class=" hidden non-hidden  btn btn-danger btn-lg btn-block">Tutup toko</button>
<button type="button" id="buka_toko"  class="  btn btn-primary btn-lg btn-block">Buka toko</button>
@else
<button type="button" id="tutup_toko"  class="non-hidden  btn btn-danger btn-lg btn-block">Tutup toko</button>
<button type="button" id="buka_toko"  class="hidden  btn btn-primary btn-lg btn-block">Buka toko</button>
@endif
<div class="col-xl-6">
    
    <button type="submit" class="hiden btn btn-primary btn-lg btn-block hidden">Mulai</button>
</div>
<div class="col-xl-6">
    <button type="button" id="batal"  class="hiden btn btn-danger btn-lg btn-block hidden">Batal </button>
</div>
</form>


                @endif

                {{-- <div class="row">
                    
                    <div class="col-xl-4">

                <div class="card">
                            <div class="card-header bg-success text-white">
                                    Tanggal Penggajian 
                            </div>
                        <div class="card-body">
                            @if (isset($gaji->status) && $gaji->status==1)
                            <form class="row" action="/pengaturan/{{$gaji->id}}/gaji" method="POST">
                                    @method('put')
                                    @else
                                    <form class="row" action="/pengaturan/gaji" method="POST">
                                        @endif                    
                                        @csrf
                                        <div class="input-group mb-3">
                                            <input type="date" id="todo-input-text"  value="{{isset($gaji->tanggal)?$gaji->tanggal:date('y-m-d')}}" name="tanggal" class="form-control">
                                            <div class="input-group-append">
                                            <button class="btn btn-success">Atur</button>
                                        </div>
                                    </div>
                            </form> 
                    </div>
            </div>
</div>
<div class="col-xl-6">

                <div class="card">
                            <div class="card-header bg-success text-white">
                                    Tanggal Penggajian 
                            </div>
                        <div class="card-body">
                            @if (isset($gaji->status) && $gaji->status==1)
                            <form class="row" action="/pengaturan/{{$gaji->id}}/gaji" method="POST">
                                    @method('put')
                                    @else
                                    <form class="row" action="/pengaturan/gaji" method="POST">
                                        @endif                    
                                        @csrf
                                        <div class="input-group mb-3">
                                            <input type="date" id="todo-input-text"  value="{{isset($gaji->tanggal)?$gaji->tanggal:date('y-m-d')}}" name="tanggal" class="form-control">
                                            <div class="input-group-append">
                                            <button class="btn btn-success">Atur</button>
                                        </div>
                                    </div>
                            </form> 
                    </div>
            </div>
</div>

                </div> --}}

            </div>
        </div>
    </div>
        <div class="card">
            <div id="Two" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header bg-success text-white   text-white">
                                        Bahan Baku Digudang 
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-sc-ex">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Bahan</th>
                                                    <th>Jumlah Baku</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($biaya_produksi->where('gudang',1) as $bahan)
                                                @if ($bahan->kuantitas>0)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$bahan->nama}}</td>
                                                    <td>{{$bahan->kuantitas." ".$bahan->satuan->nama}}</td>
                                                </tr>
                                                @endif
                                                @endforeach
                                                <tr id="next_jumlah"></tr>
                                            </tbody>
                                            <tfoot>
                                                <form action="/produksi/baku" method="POST">
                                                    @csrf
                                                    <tr>
                                                        <td></td>
                                                            <td>
                                                                <select name="bahan"  class="form-control">
                                                                    @foreach ($biaya_produksi->where('gudang',1) as $biaya)
                                                                    <option value="{{$biaya->id}}">{{$biaya->nama}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td><input type="text" name="kuantitas" class="form-control" ></td>
                                                            <td><button class=" btn btn-success ">Atur</button></td>
                                                        </tr>
                                                    </form>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>      
                                </div>
                                <div class=" col-xl-6 col-md-4">
                                    <div class="card">
                                        <div class="card-header bg-success text-white   text-white">
                                            Bahan Baku Adonan 
                                        </div>
                                        <div class="card-body">
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
                                                                <td>{{$loop->iteration}}</td>
                                                            <td>{{$a->biaya_produksi->nama}}</td>
                                                            <td>{{$a->kuantitas." ".$a->biaya_produksi->satuan->nama}}</td>                      
                                                        </tr>
                                                        @endforeach
                                                        <tr id="next_bahan"></tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <form action="/pengaturan/bahan" method="POST">
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
                                                                <td><input type="text" name="kuantitas" class="form-control" ></td>
                                                                <td><button class=" btn btn-success ">Atur</button></td>
                                                            </tr>
                                                        </form>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>    
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">  
                        <div id="Three" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card-header bg-success text-white ">
                                                    Harga Satuan Produk 
                                        </div>
                                        <div class="card-body">
                                            <form action="/pengaturan/harga"method="POST">
                                                @csrf
                                                @method('put')
                                                <div class="input-group mb-3">
                                                    <input type="text" id="harga"  name="harga"   class="form-control" placeholder="Add new todo" value="{{$produk->harga}}">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-success">Atur</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card-header bg-success text-white ">
                                            Jumlah Peradonan 
                                        </div>
                                        <div class="card-body">
                                            <form action="/pengaturan/jumlah"method="POST">
                                            @csrf
                                            @method('put')
                                                <div class="input-group mb-3">
                                                <input type="text" id="jumlah" name="jumlah"   class="form-control" placeholder="Add new todo" value="{{$produk->jumlah}}">
                                                <div class="input-group-append">
                                                    <button class="btn btn-success">Atur</button>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>

@endsection
 @section('script')
                <script>
//                     document.getElementById('jumlah_btn').addEventListener('click',function(){
//                         fetch(`/api/sotong/${document.getElementById('jumlah').value}/jumlah`)
//                         .then(data=>data.json())
//                     .then(data=>{
//                         document.getElementById('jumlah').value=data
//                         document.getElementById('alert').innerHTML=`<div class="alert alert-success alert-dismissible" role="alert">
//                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="notika-icon notika-close"></i></span></button>Harga Satuam Sotong Telah diubah
//                             </div>`
//                     }
//                         )
// })
//                     document.getElementById('harga_btn').addEventListener('click',function(){
//                         fetch(`/api/sotong/${document.getElementById('harga').value}/harga`)
//                         .then(data=>data.json())
//                     .then(data=>{
//                                                document.getElementById('harga').value=data

//                         document.getElementById('alert').innerHTML=`<div class="alert alert-success alert-dismissible" role="alert">
//                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="notika-icon notika-close"></i></span></button>Harga Satuam Sotong Telah diubah
//                             </div>`
//                     }
//                         )
// })
    document.getElementById('batal').addEventListener('click',function(){
        [...document.querySelectorAll('.hiden')].map(a=>{
            a.classList.toggle('hidden')

        });
        [...document.querySelectorAll('.non-hidden')].map(a=>{
            a.classList.toggle('hidden')
        })
    });
    document.getElementById('atur').addEventListener('click',function(){
        [...document.querySelectorAll('.hiden')].map(a=>{
            a.classList.toggle('hidden')

        });
        [...document.querySelectorAll('.non-hidden')].map(a=>{
            a.classList.toggle('hidden')
        })

    });

document.getElementById('tutup_toko').addEventListener('click',function(){
fetch('/api/pengaturan/tutup')
.then(response=>{
this.classList.toggle('hidden');
document.getElementById('buka_toko').classList.toggle('hidden');

})
});
document.getElementById('buka_toko').addEventListener('click',function(){
fetch('/api/pengaturan/buka')
.then(response=>{
document.getElementById('tutup_toko').classList.toggle('hidden');

this.classList.toggle('hidden')
});
});
                </script>
            @endsection
