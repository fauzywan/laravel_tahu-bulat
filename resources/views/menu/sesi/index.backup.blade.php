@extends('layouts.master')

@section('navbar')
    <a href="/pesanan">
        <i class=" btn-circle fas fa-arrow-left"></i>Back    
    </a>
    @endsection
@section('main')
<ul class="nav nav-tabs">
  <li class="nav-item ">
    <button class=" nav-link active" type="button" data-toggle="collapse" data-target="#home" aria-expanded="true" aria-controls="home">Menu Utama
        </button>
  </li>
  <li class="nav-item">
  </li>
  <li class="nav-item">
  <button class="btn nav-link  " type="button" data-toggle="collapse" data-target="#menu2" aria-expanded="false" aria-controls="menu2">
          Buat Adonan
        </button>
  </li>
  <li class="nav-item">
    <button class="btn nav-link  " type="button" data-toggle="collapse" data-target="#menu3" aria-expanded="false" aria-controls="menu3">
           Karyawan
        </button>
  </li>
  <li class="nav-item">
    <button class="btn nav-link  " type="button" data-toggle="collapse" data-target="#menu4" aria-expanded="false" aria-controls="menu4">
           Lainnya
        </button>
  </li>
</ul>
<div class="accordion" id="accordionExample">
  <div class="card">


        <div id="home" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                <div class="row mb-3">
                <div class="col-xl-5">
                    <div class="card text-center">
                        <div class="card-header text-white bg-success">
                            Pembuatan Pesanan
                        </div>
                        <div class="card-body">
                            <div class="row">
            <div class="col-11"></div>
                                <div class="d-flex justify-content-center" style="flex-direction:column;">              
                                    <a class="btn btn-sm btn-circle btn-danger mb-2" href="/sesi/{{$sesi->id}}/delete" ><i class="fas fa-fw fa-trash"></i></a>
                                    <a href="/sesi/{{$sesi->id}}/selesai"class="btn btn-sm btn-circle btn-success"><i class="fas fa-fw fa-check"></i></a>
                                </div>
                            </div>                                    
                                <h4>{{date('d F Y',strtotime($sesi->tanggal))}}</h4>
                                <div>
                                    <ul class="d-flex justify-content-center align-item-center" style="list-style:none;flex-direction:row">
                                        <li style="margin: 0 30px">Pesanan:<br>
                                        {{$sesi->sesi_produk->count()}}    
                                    </li>
                                    <li style="margin: 0 20px"> Dibuat:<br>
                                        {{$sesi->dibuat}}    
                                        
                                        </li>
                                    <li style="margin: 0 40px"> Karyawan:<br>
                                        {{$sesi->sesi_karyawan->count()}}    
                                        
                                        </li>
                                    
                                    </ul>
                                </div>
                            </div>
                    </div> 
                </div>
                <div class="col-xl-7">
                        <div class="card">
            <div class="card-header bg-success text-white">
                Daftar Pesanan
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Pemesan</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">harga</th>
                            <th scope="col">Ambil</th>
                            </tr>
                        </thead>
                                <tbody>
                                    @foreach ($sesi->sesi_produk as $sp)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$sp->pesanan->distributor->nama}}</td>
                                        <td>{{$sp->pesanan->jumlah}} Buah</td>
                                        <td>Rp.{{number_format($sp->pesanan->harga)}}</td>
                                        @if($sesi->dibuat>=$sp->pesanan->jumlah)
                                        <td><a href="/pesanan/{{$sp->pesanan_id}}/ambil" class="text-success">Ambil</a></td>
                                        @else
                                        <td>Sedang Dibuat</a></td>

                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                        <div class="card">
            <div class="card-header bg-success text-white">
                Pemakaian Bahan
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Bahan</th>
                            <th scope="col">Dipakai</th>
                            <th scope="col">harga</th>
                            </tr>
                        </thead>
                                <tbody>
                                    @foreach ($sesi->pemakaian as $p)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$p->belanja->gudang->biaya_produksi->nama}}</td>
                                        <td>{{$p->jumlah}} {{$p->belanja->gudang->biaya_produksi->satuan->nama}}</td>
                                        <td> Rp.{{number_format($p->belanja->harga*$p->jumlah)}}</td>
                                    
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                    <div class="col-xl-6">
                        <div class="card">
            <div class="card-header bg-success text-white">
                Daftar Karyawan
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Dibuat</th>
                            </tr>
                        </thead>
                                <tbody>
                                    @foreach ($sesi->sesi_karyawan as $sk)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$sk->karyawan->nama}}</td>
                                        <td>{{$sk->buat_produk->sum('jumlah')}} Buah</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
                </div>
        </div>
  </div>

  <div class="card">
 
    <div id="menu2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
<div class="card">
    <div class="card-header">Buat Adonan</div>
    <div class="card-body">
        
        <form action="/sesi/{{$sesi->id}}/bahan" method="POST" >                                    
                                                        @method('post')
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-4">

                                                                <input type="date" class="form-control input-sm"  name="tanggal" value="{{date('Y-m-d')}}">
                                                            </div>
                                                            <div class="col-4">
                                                                
                                                                <select name="karyawan"  class="form-control" name="tanggal">
                                                                    @foreach ($karyawan as $key) {
                                                                        @isset($karyawan->sesi_karyawan)
                                                                            
                                                                        @if ($key->sesi_karyawan->first()->status!=2)
                                                                        
                                                                        <option value="{{$key->id}}">{{$key->nama}}</option>
                                                                        @endif
                                                                        @endisset
                                                                     
                                                                      
                                                                        @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-4">
                                                                <input type="text" class="form-control input-sm Adonan" value="1" " name="adonan" >

                                                            </div>
                                                        </div>
                                                        <div class="row">

                
                                                        <div class="table-responsive mt-4">
                                                            <table class="table table-hover table-inbox notRedy">
                                                                <thead style="text-align:center">
                                                                    <th>#</th>
                                                                    <th>Bahan</th>
                                                                    <th>Kuantitas</th>
                                                                    <th>Opsi</th>
                                                                </thead>
                                                                <tbody class="add dropHere">
                                                                @foreach ($adonan as $a)
                                                                <tr>
                                                                    <td>{{$loop->iteration}}</td>
                                                                <td>
                                                                        <select name="bahan[]" class="form-control">
                                                                        <option value="{{$a->biaya_produksi->id}}">{{$a->biaya_produksi->nama}}</option>      
                                                                        </select>  
                                                                </td>
                                                                <td><input type="text" class="form-control" placeholder="Kuantitas" name="kuantitas[]" value="{{$a->kuantitas}}"></td>
                                                                <td class="remove text-right btn btn-sm btn-danger btn-sm "><i class="fas fa-trash remove"></i></td>                                                
                                                            </tr>
                                                                @endforeach
                                                        </tbody>
                                                    </table>
                                                        <button class="btn btn-success belanja Ambil_btn" type="submit">Ambil</button>
                                                    </form> 
                                                </div>
</div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
  <div class="card">
    <div id="menu3" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
          <div class="row">

          <div class="col-6">
          <div class="card">
              <div class="card-header bg-success text-white">
                  Karyawan
              </div>
              <div class="card-body">                
              <form class="" action="/sesi/{{$sesi->id}}/karyawan" method="POST">
                <div class="input-group mb-3">
                    @csrf
                    <select name="karyawan" id="KAryawan" class="form-control">
                        @foreach ($karyawan as $key) {
                        <option value="{{$key->id}}">
                               @if($key->sesi_karyawan->where('sesi_id',$sesi->id)->count()==0)
                               {{$key->nama}}
                               @endif
                               </option>
                            @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-success">Gabung</button>
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
  <div class="card">
    <div id="menu4" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
          <div class="row">
          <div class="col-6">
          <div class="card">
              <div class="card-header bg-success text-white">
                  Selesai Dibuat
              </div>
              <div class="card-body">    
                  <form class="" action="/sesi/{{$sesi->id}}/produk" method="POST">
                    @csrf             
                    <div class="form-group">
                        <label for="karyawan">Karyawan </label>
                        <select name="karyawan" class="form-control" id="karyawan">
                            @foreach ($sesi->sesi_karyawan as $k)
                                @if ($k->status==2)
                                <option value="{{$k->karyawan->id}}">{{$k->karyawan->nama}}</option>x
                            @endif
                            @endforeach
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Dibuat</label>
                        <input name="dibuat" type="text" class="form-control" id="jumlah" placeholder="jumlah Dibuat">
                    </div>
                    <button class="btn btn-success">Simpan</button>
                </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


@endsection

@section('main')
@section('script')
    
    
<script>
    $('.nav-link').click(function(){
        

            document.querySelector('button.active').classList.remove('active')
            this.classList.add('active')
            
        
        // if(document.querySelector('multi-collapse.collapse').classList[2]=='show'){

        // }
    });
    $('#home').collapse({
        toggle: false
    })
    const Adonan=document.querySelector('.Adonan');

let tables=document.getElementById('menu2').querySelector('table')
let kaliIni;
Adonan.addEventListener('keyup',function(){
    kaliIni=this.value
    if(this.value=="")
    {
        kaliIni=0;
    }
if(this.value>0){

    fetch(`/api/pengaturan/${kaliIni}/adonan`)
.then(adn=>adn.text())
.then(adn=>
{
    document.querySelector('.dropHere').innerHTML=adn
if(document.querySelectorAll('.dropHere .hidden').length>0){
    document.querySelector('.Ambil_btn').classList.add('hide')
    
}
else{

        document.querySelector('.Ambil_btn').classList.remove('hide')
    }
}
)
}
})
</script>
@endsection
@section('muin')
<script>
     if(document.querySelector('.Tersedia').querySelectorAll('option').length>0){

        
        document.querySelector('.Tersedia').value=document.querySelector('option.FORM_').value.substr(2);
    };
const tersediaForm=[...document.querySelectorAll('option.FORM_')];
document.querySelector('select.FORM_').addEventListener('change',function(){
document.querySelector('.Tersedia').value=(this.value).substr(2);
})



</script>

{{-- <script src="{{asset('js/mine/belanja/add.js')}}"></script>  --}}
@endsection