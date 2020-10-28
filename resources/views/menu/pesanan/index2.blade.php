@extends('layouts.not_sidebar')
@section('top-main')
    <h1 class="h3 mb-3  ext-gray-800"> Pesanan</h1>
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Daftar Pesanan</a>
    <a class="nav-item nav-link" href="/pesanan/bayar">Bayar Pesanan</a>
    <a class="nav-item nav-link" href="/pesanan/create">Tambah Pesanan</a>
    <a class="nav-item nav-link" href="/pesanan/laporan">Laporan</a>
  </div>
</nav>

<div class="row mt-3">
<div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success   shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Pesanan</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pesanan->count()}} </div>
            </div>
            <img class="" style="width:120px; position:absolute; bottom: -3px;  right: 0px;"  src="{{asset('unDraw/undraw_deliveries_131a.svg')}}">               

            </div>
        </div>
        </div>
    </div>
<div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Sedang Dibuat</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$sedang_dibuat->count()}} </div>
            </div>
            <img class="" style="width:120px; position:absolute; bottom: 3px;  right: 10px;"   src="{{asset('unDraw/undraw_detailed_analysis_xn7y.svg')}}">               

            </div>
        </div>
        </div>
    </div>
<div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Belum Dibuat</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pesanan->where('status',1)->count()}} </div>
            </div>
            <img class="" style="width:120px; position:absolute; bottom: 3px;  right: 10px;"   src="{{asset('unDraw/2.svg')}}">               

            </div>
        </div>
        </div>
    </div>
</div>
@endsection
@section('main')
    <div class="row">   
        <div class="col-md-5">
            
              <div class="card  sedang_dibuat">
            <div class="card-header bg-success text-white">Sedang Dibuat </div>
                <div class="card-body  table-responsive">
                        <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Pesanan</th>
                                        <th>Jumlah Pesanan</th>
                                        <th>opsi</th>
                                    </tr>
                                </thead>
                            <tbody>
                                 @foreach ($sedang_dibuat as $sedang)
                                    <tr>
                                    <td >{{$sedang->inisial!=""?$sedang->inisial:$sedang->ditributor->nama}}</td>
                                    <td >{{$sedang->jumlah}} Buah</td>
                                    <td ><a href="/pesanan/{{$sedang->id}}/sesi" class="">Detail</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
       <div class="card hidden buat_pesanan" id="tabel2" >
            <div class="card-header bg-success text-white" >Buat Pesanan</div>
                    <form  action="/pesanan/sesi" method="POST" class="card-body ">
                        <input type="text" name="init" placeholder="Inisialisasi Pesanan" class="form-control hidden INISIAL" >
                        <input type="date" name="tanggal" class="form-control" value="{{date('Y-m-d')}}">
                        <div class=" table-responsive">
                        <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Pesanan</th>
                                            <th>Jumlah Pesanan</th>
                                            <th>opsi</th>
                                        </tr>
                                     </thead>
                                        <tbody class="form">
                                                @csrf
                                                @method('post')
                                        </tbody>
                                            <tr>
                                                <td><button class="btn btn-sm btn-success ">Buat</button></td>
                                            </tr>                               
                                </table>
                            </div>    

                            </form>
                    </div>
        </div>
        <div class="col-md-7">
            
                <div class="card">
            <div class="card-header bg-success text-white mb-3" >Daftar Pesanan</div
                >
                <div class="row">
                    <div class="col-5" style="margin-left:10px ">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input checkedIn" id="customSwitch1" >
                            <label class="custom-control-label mb-3" for="customSwitch1">Buat Pesanan</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <select name="" id="SELECT_DATE" class="form-control">
                            <option value="1">Tampilkan Semua</option>
                            @foreach ($tanggal as $t)
                            <option value="{{$t->tanggal}}">{{date('d F Y',strtotime($t->tanggal))  }}</option>        
                            @endforeach
                        </select>           
                    </div>
                </div>

            <div class="card-body table-responsive">
                        <table class="table  table-hover data" id="tabel">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Pesanan</th>
                                        <th>Tanggal </th>
                                        <th >Pesanan</th>
                                        <th>Keuangan</th>
                                        <th>opsi</th>
                                    </tr>
                                </thead>
                                <tbody class="FORM">
                                 @foreach ($pesanan as $pesan)
                                <tr class="{{$pesan->status==1?'activein':'hidenin'}} {{$pesan->id}} dateable" id="data_{{$pesan->id}}">
                                            <td>{{$loop->iteration}}</td>

                                        <td >{{$pesan->distributor->nama}}</td>
                                <td class="{{$pesan->tanggal}} showAll">{{date('d F Y',strtotime($pesan->tanggal))}}</td>
                                <td class="hidden"></td>        
                                <td >{{$pesan->jumlah}}</td>
                                        <td >{{$pesan->belumDibayar()==0?'Lunas':'Rp.'.number_format($pesan->belumDibayar())}}</td>
                                        <td class="opsi">
                                            
                                        <a class="btn btn-sm btn-circle btn-info" href="/pesanan/{{$pesan->id}}/detail"><i class="fas  fa-info fas-more-button"></i></a>
                                        <span class="btn btn-circle btn-sm btn-primary  hidden plus-ultra" "><i class="fas fa-plus"></i></span>
                                        <a href="/pesanan/{{$pesan->id}}/detele" class="btn btn-sm btn-circle btn-danger hapus" onclick="return confirm('Yakin Menghapus Ini ?')"><i class="fas fa-cirlce fa-trash !sampah!"></i></a>
                                    </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
        </div>
    </div>
@endsection
@section('script')
<script src="{{ asset('js/mine/rp.js') }}"></script>
<script src="{{ asset('js/mine/pesanan/index.js') }}"></script>
<script>
    const selek=document.getElementById('SELECT_DATE');
let tanggal
    selek.addEventListener('change',function(){
        tanggal=this.value;
        if(tanggal!=1){
            (document.querySelectorAll('.sembunyi').length>0==true)
                  if(document.querySelectorAll('.sembunyi').length>0){
                [...document.querySelectorAll('.sembunyi')].map(
                    t=>{
                        t.classList.remove('sembunyi')
                        t.parentNode.classList.remove('hidden')
                }
                    )
            }

            [...document.querySelectorAll('.FORM tr.dateable')].
            filter(trr=>{      
          return  trr.children[2].classList[0]!=tanggal && trr.classList[2]!='datenonable'})
            .map(trr=>{
                    trr.classList.add('hidden')
                    trr.children[2].classList.add('sembunyi')}
        )
        }else{
         [...document.querySelectorAll('.FORM tr')].filter(trr=>trr.classList[2]=='dateable').map(trr=>{
             trr.classList.remove('hidden')
             trr.children[2].classList.remove('sembunyi')})
        }
        });

  document.addEventListener('keydown',function(e){
    if(e.key=="b" && e.ctrlKey){
        document.location.href="/pesanan/bayar";
    }
})

    // document.querySelector('.checkedIn').checked;
    //     document.addEventListener('keydown',function(e){
    //         if(e.key=="m")   
    //         {
    //                 if(!document.querySelector('.checkedIn').checked){
    //                     document.querySelector('.checkedIn').checked=true;
    //                             document.querySelector('.sedang_buat').classList.remove('hidden');
    //     document.querySelector('.form_data').classList.add('hidden');

    //     if (document.querySelectorAll('.form tr').length > 0) {
    //         [...document.querySelectorAll('.form tr')].map(tr => tr.remove())
    //     }
    //     [...document.querySelectorAll('.opsi')].map(ops => {
    //         if (ops.parentNode.classList[0] != 'activein') {
    //             ops.parentNode.classList.add('hidden')
    //         }
    //         ops.children[0].classList.add('hidden');
    //         ops.children[1].classList.remove('hidden');
    //     });
    //                 }
    //                 else{
    //                     document.querySelector('.checkedIn').checked=false;
    //                       document.querySelector('.form_data').classList.remove('hidden');
    //     document.querySelector('.sedang_buat').classList.add('hidden');
    
    //     [...document.querySelectorAll('.opsi')].map(ops => {
    
    //         if (ops.parentNode.classList[0] != 'activein') {
    //             ops.parentNode.classList.remove('hidden')
    //         }
    //         ops.children[0].classList.remove('hidden')
    //         ops.children[1].classList.add('hidden')
    //     });
    //                     [...document.querySelectorAll('.hiddennIn')].map(hid => {
    //         hid.classList.replace('hiddennIn', 'activein')
    //     });
                        
    //                 }
                
    //         }
            
    //     });
    //     </script>
   
@endsection